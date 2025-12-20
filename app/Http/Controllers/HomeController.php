<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\ProductVariantController;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(Request $request)
    {
        $data['base_url'] = config('app.url');
        $data['banners'] = Banner::where('status', 1)->orderBy('order', 'asc')->get(['title', 'path', 'hyper_link']);
        $data['featured_products'] = ProductVariant::with(['product'])->where('is_featured', 1)->orderBy('updated_at', 'asc')->limit(10)->get();
        $data['best_sellings'] = ProductVariant::where('is_best_selling', 1)->orderBy('updated_at', 'asc')->limit(10)->get();
        return view('home', $data);
    }

    public function product(ProductVariant $productVariant)
    {
        $productName = $productVariant->product->name;
        $productNameArray = explode(' ', $productName);
        $data['product'] = ProductVariant::find($productVariant->id);
        $data['similar_products'] = ProductVariant::with('product')->whereHas('product', function ($q) use ($productNameArray, $productVariant) {
            $q->where('name', 'like', '%' . $productNameArray[0] .  '%')->where('id', '!=', $productVariant->product_id);
        })->limit(6)->get();
        return view('product', $data);
    }
    public function products()
    {
        return view('products');
    }

    public function lists(Request $request, $search)
    {
        $category = Category::where('slug', $search)->first();
        if ($category) {
            return $this->listsByCategory($category, $request);
        }

        if (Product::where('name', 'like', '%' . $search . '%')->exists()) {
            return $this->listsByProduct($search, $request);
        }

        abort(404);
    }

    private function listsByCategory(Category $category, $request)
    {
        $query = ProductVariant::with(['product.categories.category', 'rating'])->whereHas('product.categories.category', function ($q) use ($category) {
            $q->where('id', $category->id);
        });

        $query = $this->applySort($query, $request);

        $products = $query->paginate(20)->withQueryString();

        if ($request->ajax()) {
            return view('components.product-cards', [
                'products' => $products
            ])->render();
        }

        return view('listing', compact('products'));
    }

    private function listsByProduct($search, $request)
    {
        $query = ProductVariant::with(['product', 'rating'])->whereHas('product', function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%');
        });

        $query = $this->applySort($query, $request);

        $products = $query->paginate(20)->withQueryString();

        if ($request->ajax()) {
            return view('components.product-cards', [
                'products' => $products
            ])->render();
        }

        return view('listing', compact('products'));
    }

    private function applySort($query, Request $request)
    {
        return match ($request->sort) {
            'price-low-to-high' => $query->orderBy('price', 'asc'),
            'price-high-to-low' => $query->orderBy('price', 'desc'),
            'new-arrivals'      => $query->orderBy('created_at', 'desc'),
            'best-rated'        => $query->whereHas('rating', function ($q) {
                $q->orderBy('rating', 'desc');
            }),
            default             => $query->orderBy('id', 'asc'),
        };
    }

    // public function carts()
    // {
    //     return view('carts');
    // }
}

<?php

namespace App\Http\Controllers\API;

use App\Models\Brand;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class ApiController extends BaseController
{
    public function home()
    {
        $data['base_url'] = config('app.url');
        $data['categories'] = Category::get(['id', 'name', 'icon']);
        $data['brands'] = Brand::get(['id', 'name', 'logo']);

        $data['products'] = Product::with(['images' => function ($q) {
            $q->where('is_primary', true); // only primary image
        }, 'category', 'brand', 'variants'])
            ->where('is_active', true)
            ->take(20) // limit to 20 products
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'discount_price' => $product->discount_price,
                    'description' => $product->description,
                    'category' => [
                        'id' => $product->category->id,
                        'name' => $product->category->name
                    ],
                    'brand' => [
                        'id' => $product->brand->id,
                        'name' => $product->brand->name
                    ],
                    'image' => $product->images->first() ? asset('storage/' . $product->images->first()->path) : null,
                    'variants' => $product->variants,
                ];
            });
        return $this->sendResponse($data);
    }

    public function addToCart(Request $request)
    {
        $auth = Auth::user();

        $cart = Cart::firstOrCreate(
            ['user_id' => $auth->id]
        );

        CartItem::create([
            'cart_id' => $cart->id,

        ]);
    }

    public function products(Request $request)
    {
        $products = Product::with([
            'images' => function ($q) {
                $q->where('is_primary', true);
            },
            'category:id,name',
            'brand:id,name',
            'variants',
        ])
            ->where('is_active', true)
            ->paginate(10);


        // Transform paginated collection
        $products->getCollection()->transform(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'discount_price' => $product->discount_price,
                'description' => $product->description,
                'category' => $product->category ? [
                    'id' => $product->category->id,
                    'name' => $product->category->name,
                ] : null,
                'brand' => $product->brand ? [
                    'id' => $product->brand->id,
                    'name' => $product->brand->name,
                ] : null,
                'image' => $product->images->first()
                    ? asset('storage/' . $product->images->first()->path)
                    : null,
                'variants' => $product->variants,
            ];
        });

        return $this->sendResponse([
            'products' => $products->items(),
            'pagination' => [
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total(),
                'has_more' => $products->hasMorePages(),
            ],
        ]);
    }

    public function singleProduct(Request $request, $id)
    {
        try {

            $product = Product::with(['variants', 'comments.user', 'rating'])->find($id);

            return $this->sendResponse($product);
        } catch (Throwable $t) {
            return $this->sendError($t->getMessage());
        }
    }

    public function removeCartItem(Request $request, $id)
    {
        $cartItem = CartItem::find($id);

        if (!$cartItem) {
            return $this->sendError('Cart item not found', [], 404);
        }

        $cartItem->delete();

        return $this->sendResponse(null, 'Cart item removed successfully');
    }
}

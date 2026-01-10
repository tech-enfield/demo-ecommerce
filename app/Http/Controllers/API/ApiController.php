<?php

namespace App\Http\Controllers\API;

use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;

class ApiController extends BaseController
{
    public function home()
    {
        $data['base_url'] = config('app.url');
        $data['categories'] = Category::get(['id', 'name', 'icon']);
        $data['brands'] = Brand::get(['id', 'name', 'logo']);

        $data['products'] = Product::with(['images' => function ($q) {
            $q->where('is_primary', true); // only primary image
        }, 'category', 'brand'])
            ->where('is_active', true)
            ->take(20) // limit to 20 products
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'discount_price' => $product->discount_price,
                    'category' => [
                        'id' => $product->category->id,
                        'name' => $product->category->name
                    ],
                    'brand' => [
                        'id' => $product->brand->id,
                        'name' => $product->brand->name
                    ],
                    'image' => $product->images->first() ? asset('storage/' . $product->images->first()->path) : null,
                ];
            });
        return $this->sendResponse($data);
    }
}

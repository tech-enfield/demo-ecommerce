<?php

namespace App\Http\Controllers\API;

use App\Models\Banner;
use App\Models\Category;
use App\Models\ProductVariant;

class ApiController extends BaseController
{
    public function home() {
        $data['base_url'] = config('app.url');
        // $data['banners'] = Banner::where('status', 1)->orderBy('order', 'asc')->get(['title', 'path', 'hyper_link']);
        // $data['featured_products'] = ProductVariant::with(['product'])->where('is_featured', 1)->orderBy('updated_at', 'asc')->limit(10)->get();
        // $data['best_sellings'] = ProductVariant::where('is_best_selling', 1)->orderBy('updated_at', 'asc')->limit(10)->get();
        $data['categories'] = Category::get(['id','name', 'icon']);
        return $this->sendResponse($data);
    }
}

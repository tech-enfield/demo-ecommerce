<?php

namespace App\Http\Controllers\API;

use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductVariant;

class ApiController extends BaseController
{
    public function home() {
        $data['base_url'] = config('app.url');
        $data['categories'] = Category::get(['id','name', 'icon']);
        $data['brands'] = Brand::get(['id','name', 'logo']);
        return $this->sendResponse($data);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ProductImage::query();

        if ($request->filled('product_name')) {
            $query->whereHas('product', function ($pI) use ($request) {
                $pI->where('name', 'like', '%' . $request->query('product_name') . '%');
            });
        }

        $data = $query->paginate(10);
        // $data = ProductImage::paginate(10);
        $products = Product::get(['id', 'name']);
        $colors = Color::get(['id', 'name']);
        return view('admin.products.images.index', ['data' => $data, 'products' => $products, 'colors' => $colors]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product' => ['required'],
            'color' => ['required'],
            'images' => ['required', 'array'],
            'images.*' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'alt_text' => ['required', 'string'],
        ]);

        $product = Product::find($request->product);

        $alt_text_array = array_filter(array_map('trim', explode(';', $request->alt_text)));

        if (count($alt_text_array) !== count($request->images)) {
            return back()->withErrors([
                'alt_text' => 'Count of images and alt text did not match.'
            ]);
        }

        foreach ($request->file("images") as $index => $image) {
            $path = $image->store('products/' . $product->slug, 'public');

            $product->images()->create([
                'path' => $path,
                'color_id' => $request->color,
                'alt' => $alt_text_array[$index] ?? null,
                'sort_order' => $index + 1,
                'is_primary' => $index === 0,
            ]);
        }

        ProductColor::updateOrCreate(['product_id' => $request->product, 'color_id' => $request->color]);

        return redirect(route('admin.products.images.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductImage $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductImage $image)
    {
        $data = ProductImage::paginate(10);
        $products = Product::get(['id', 'name']);
        return view('admin.products.images.edit', ['data' => $data, 'products' => $products, 'product_image' => $image]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductImage $image)
    {
        dd($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductImage $image)
    {
        if ($image->path) {
            Storage::disk('public')->delete($image->path);
        }
        $image->delete();
        return redirect(route('admin.products.images.index'));
    }
}

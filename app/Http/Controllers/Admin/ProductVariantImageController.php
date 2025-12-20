<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductVariant;
use App\Models\ProductVariantImage;
use Illuminate\Http\Request;

class ProductVariantImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ProductVariantImage::query();

        if($request->filled('product_name'))
        {
            $query->whereHas('productVariant', function ($pI) use ($request) {
                $pI->where('name', 'like', '%' . $request->query('product_name') . '%');
            });
        }

        $data = $query->paginate(10);
        $products = ProductVariant::with('product')->get(['id', 'title', 'product_id']);
        // dd($products[0]);
        return view('admin.products.varaints.images.index', ['data' => $data, 'product_variants' => $products]);
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
            'images' => ['required', 'array'],
            'images.*' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'alt_text' => ['required', 'string'],
        ]);

        $product = ProductVariant::find($request->product);

        $alt_text_array = array_filter(array_map('trim', explode(';', $request->alt_text)));

        if (count($alt_text_array) !== count($request->images)) {
            return back()->withErrors([
                'alt_text' => 'Count of images and alt text did not match.'
            ]);
        }

        foreach ($request->file("images") as $index => $image) {
            $path = $image->store('products/' . $product->slug . "/variants/", 'public');

            $product->images()->create([
                'path' => $path,
                'alt' => $alt_text_array[$index] ?? null,
                'sort_order' => $index + 1,
                'is_primary' => $index === 0,
            ]);
        }

        return redirect(route('admin.products.variants.images.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductVariantImage $productVariantImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductVariantImage $productVariantImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductVariantImage $productVariantImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductVariantImage $productVariantImage)
    {
        //
    }
}

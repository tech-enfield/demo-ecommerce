<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductVariantAttributeRequest;
use App\Models\AttributeValue;
use App\Models\ProductVariant;
use App\Models\ProductVariantAttribute;
use Illuminate\Http\Request;

class ProductVariantAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ProductVariantAttribute::query();

        if($request->filled('product_variant_sku'))
        {
            $query->whereHas('productVariant', function($pVA) use ($request) {
                $pVA->where('sku', 'like', '%' . $request->query('product_variant_sku') . '%');
            });
        }

        $data = $query->paginate(10);
        $variants = ProductVariant::get(['id', 'sku']);
        $attributes = AttributeValue::get(['id', 'value']);
        return view('admin.products.varaints.attributes.index', ['data' => $data, 'variants' => $variants, 'attributes' => $attributes]);
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
    public function store(ProductVariantAttributeRequest  $productVariantAttributeRequest)
    {
        foreach($productVariantAttributeRequest->attribute_value_id as $attribute_value_id)
        {
            ProductVariantAttribute::updateOrCreate([
                'product_variant_id' => $productVariantAttributeRequest->variant_id,
                'attribute_value_id' => $attribute_value_id
            ]);
        }

        return redirect()->route('admin.products.variants.attributes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductVariantAttribute $productVariantAttribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductVariantAttribute $productVariantAttribute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductVariantAttribute $productVariantAttribute)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductVariantAttribute $productVariantAttribute)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductVariantRequest;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductVariant;
use App\Models\ProductVariantColor;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ProductVariant::with('product');

        if ($request->filled('product_name')) {
            $query->whereHas('product', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->query('product_name') . '%');
            });
        }

        $data = $query->paginate(10);
        $products = Product::select('id', 'name')->get();

        return view('admin.products.varaints.index', compact('data', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::select('id', 'name')->get();
        return view('admin.products.varaints.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductVariantRequest $request)
    {
        ProductVariant::create($request->validated());

        return redirect()
            ->route('admin.products.variants.index')
            ->with('success', 'Product Variant created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductVariant $variant)
    {
        return view('admin.products.varaints.show', compact('variant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductVariant $variant)
    {
        $products = Product::select('id', 'name')->get();
        return view('admin.products.varaints.edit', compact('variant', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductVariantRequest $request, ProductVariant $variant)
    {
        $variant->update($request->validated());

        return redirect()
            ->route('admin.products.variants.index')
            ->with('success', 'Variant updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductVariant $variant)
    {
        $variant->delete();

        return back()->with('success', 'Variant deleted successfully.');
    }

    /**
     * Assign color family view
     */
    public function assignColorFamily(ProductVariant $variant)
    {
        $colors = ProductColor::with('color')->where('product_id', $variant->product_id)->get();
        $assignedColors = ProductVariantColor::with(['productVariant.product', 'color'])
            ->where('product_variant_id', $variant->id)
            ->paginate(10);

        return view('admin.products.varaints.assign-color-family', [
            'variant' => $variant,
            'colors' => $colors,
            'assignedColors' => $assignedColors
        ]);
    }

    /**
     * Store assigned color
     */
    public function assignColorFamilyStore(Request $request)
    {
        ProductVariantColor::updateOrCreate(
            $request->only(['product_variant_id', 'color_id'])
        );

        return back()->with('success', 'Color assigned successfully.');
    }

    /**
     * Delete assigned color
     */
    public function assignColorFamilyDelete(ProductVariantColor $productVariantColor)
    {
        $productVariantColor->delete();
        return back()->with('success', 'Color removed successfully.');
    }
}

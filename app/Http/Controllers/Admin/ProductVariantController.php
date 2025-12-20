<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductVariantRequest;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductVariant;
use App\Models\ProductVariantColor;
use Complex\Functions;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ProductVariant::query();

        if($request->filled('product_name'))
        {
            $query->whereHas('product', function($pV) use ($request) {
                $pV->where('name', 'like', '%' . $request->query('product_name') . '%');
            });
        }

        $data = $query->paginate(10);
        $products = Product::get(['id', 'name']);
        return view('admin.products.varaints.index', ['data' => $data, 'products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::get(['id', 'name']);
        return view('admin.products.varaints.create', ['products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductVariantRequest $productVariantRequest)
    {
        ProductVariant::create($productVariantRequest->validated());

        return redirect(route('admin.products.variants.index'))->with('success', 'Product Variant created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductVariant $variant)
    {
        return view('admin.products.varaints.show',['variant' => $variant]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductVariant $variant)
    {
        return view('admin.products.varaints.edit', ['variant' => $variant]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductVariantRequest $productVariantRequest, ProductVariant $variant)
    {
        $variant->update($productVariantRequest->validated());

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

    public function assignColorFamily(ProductVariant $variant)
    {
        $data['variant'] = $variant;
        $data['color'] = ProductColor::with('color')->where('product_id', $variant->product_id)->get();
        $data['data'] = ProductVariantColor::with(['productVariant.product', 'color'])->paginate(10);
        return view('admin.products.varaints.assign-color-family', $data);
    }

    public function assignColorFamilyStore(Request $request){
        ProductVariantColor::updateOrCreate($request->only(['product_variant_id', 'color_id']));

        return back();
    }

    public function assignColorFamilyDelete(ProductVariantColor $productVariantColor){
        $productVariantColor->delete();
        return back();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ProductImport;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::with(['category', 'brand']);

        if ($request->filled('product_name')) {
            $query->where('name', 'like', '%' . $request->product_name . '%');
        }

        $data = $query->paginate(10);

        return view('admin.products.index', [
            'data' => $data,
            'categories' => Category::orderBy('name')->get(),
            'brands' => Brand::orderBy('name')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect(route('admin.products.index'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'is_active' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store(
                'products',
                'public'
            );
        }

        Product::create([
            'name' => $validated['name'],
            'category_id' => $validated['category_id'],
            'brand_id' => $validated['brand_id'] ?? null,
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'discount_price' => $validated['discount_price'] ?? null,
            'is_active' => $request->boolean('is_active'),
            'image' => $imagePath,
        ]);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $data = Product::paginate(10);
        return view('admin.products.show', ['data' => $data, 'product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $data = Product::paginate(10);
        return view('admin.products.edit', [
            'data' => $data,
            'product' => $product,
            'categories' => Category::orderBy('name')->get(),
            'brands' => Brand::orderBy('name')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'is_active' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = $product->image;

        // If new image uploaded
        if ($request->hasFile('image')) {

            // 🔥 Delete old image if exists
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            // Store new image
            $imagePath = $request->file('image')->store(
                'products',
                'public'
            );
        }

        $product->update([
            'name' => $validated['name'],
            'category_id' => $validated['category_id'],
            'brand_id' => $validated['brand_id'] ?? null,
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'discount_price' => $validated['discount_price'] ?? null,
            'is_active' => $request->boolean('is_active'),
            'image' => $imagePath,
        ]);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect(route('admin.products.index'));
    }

    public function assignCategory(Request $request)
    {
        $query = CategoryProduct::query();

        if ($request->filled('category_name')) {
            $query->whereHas('category', function ($category) use ($request) {
                $category->where('name', 'like', '%' . $request->query('category_name') . '%');
            });
        }

        $data = $query->paginate(10);
        // $data = CategoryProduct::paginate(10);
        $categories = Category::get(['id', 'name']);
        $products = Product::get(['id', 'name']);
        return view('admin.products.assign-product-to-categories', ['categories' => $categories, 'products' => $products, 'data' => $data]);
    }

    public function assignCategoryStore(Request $request)
    {
        foreach ($request->categories as $category) {
            CategoryProduct::updateOrCreate(['product_id' => $request->product, 'category_id' => $category]);
        }

        return redirect(route('admin.products.assign.category'));
    }

    public function deleteCategoryProductRelation(CategoryProduct $categoryProduct)
    {
        $categoryProduct->delete();
        return redirect(route('admin.products.assign.category'));
    }

    public function import()
    {
        $data = Product::paginate(10);
        return view('admin.products.import', ['data' => $data]);
    }

    public function importStore(Request $request, ProductImport $productImport)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xlsx,xls|max:20480', // max 20MB
        ]);

        $path = $request->file('file')->store('temp', 'public');

        $productImport->import('storage/' . $path);

        Storage::disk('public')->delete($path);
        return back();
    }

    public function export() {}
}

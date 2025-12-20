<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ProductImport;
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
        $query = Product::query();

        if ($request->filled('product_name')) {
            $query->where('name', 'like', '%' . $request->query('product_name') . '%');
        }

        $data = $query->paginate(10);
        // $data = Product::paginate(10);
        return view('admin.products.index', ['data' => $data]);
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
            // Basic info
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:products,slug'],
            'sku' => ['nullable', 'string', 'max:100', 'unique:products,sku'],
            'short_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],

            // SEO
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string'],
        ]);

        Product::create($validated);

        return redirect(route('admin.products.index'));
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
        return view('admin.products.edit', ['data' => $data, 'product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            // Basic info
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:products,slug,' . $product->id . ',id'],
            'sku' => ['nullable', 'string', 'max:100', 'unique:products,sku,' . $product->id . ',id'],
            'short_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],

            // SEO
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string'],
        ]);

        $product->update($validated);

        return redirect(route('admin.products.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
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

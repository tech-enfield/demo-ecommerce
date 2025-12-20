<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CategoryExport;
use App\Http\Controllers\Controller;
use App\Imports\CategoryImport;
use App\Models\Category;
use App\Models\CategoryRelation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Category::query();

        if ($request->filled('name')) {
            $query = $query->where('name', 'like', '%' . $request->name . '%');
        }

        $data = $query->paginate(10);
        $categories = Category::get(['id', 'name']);
        return view('admin.category.index', ['data' => $data, 'categories' => $categories]);
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
            'name'              => ['required', 'string', 'max:255'],
            'slug'              => ['nullable', 'string', 'max:255', 'unique:categories,slug'],
            'description'       => ['nullable', 'string'],
            'icon'              => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'image'             => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'meta_title'        => ['nullable', 'string', 'max:255'],
            'meta_description'  => ['nullable', 'string', 'max:500'],
            'meta_keywords'     => ['nullable', 'string', 'max:255'],
        ]);

        if ($request->hasFile('icon')) {
            $validated['icon'] = $request->file('icon')->store('category/icons', 'public');
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('category/images', 'public');
        }

        Category::create($validated);

        return redirect(route('admin.categories.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $data = Category::paginate(10);
        return view('admin.category.show', ['data' => $data, 'category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $data = Category::paginate(10);
        return view('admin.category.edit', ['data' => $data, 'category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name'              => ['required', 'string', 'max:255'],
            'slug'              => ['nullable', 'string', 'max:255', 'unique:categories,slug,' . $category->id . ',id'],
            'description'       => ['nullable', 'string'],
            'icon'              => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'image'             => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'meta_title'        => ['nullable', 'string', 'max:255'],
            'meta_description'  => ['nullable', 'string', 'max:500'],
            'meta_keywords'     => ['nullable', 'string', 'max:255'],
        ]);

        if ($request->hasFile('icon')) {
            if ($category->icon) {
                Storage::disk('public')->delete($category->icon);
            }
            $validated['icon'] = $request->file('icon')->store('category/icons', 'public');
        }

        if ($request->hasFile('image')) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $validated['image'] = $request->file('image')->store('category/images', 'public');
        }

        $category->update($validated);

        return redirect(route('admin.categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // if ($category->icon) {
        //     Storage::disk('public')->delete($category->icon);
        // }
        // if ($category->image) {
        //     Storage::disk('public')->delete($category->image);
        // }
        $category->delete();
        return redirect(route('admin.categories.index'));
    }

    public function assignParent(Request $request)
    {
        $query = CategoryRelation::query();
        if ($request->filled('parent_category')) {
            $query = $query->whereHas('parentCategory', function ($pC) use ($request) {
                $pC->where('name', 'like', '%' . $request->query('parent_category') . '%');
            });
        }

        $data = $query->paginate(10);
        $categories = Category::get(['id', 'name']);
        // $data = CategoryRelation::paginate(10);
        return view('admin.category.assign-category-to-parent-category', ['categories' => $categories, 'data' => $data]);
    }

    public function assignParentStore(Request $request)
    {
        foreach ($request->parent_categories as $parentCategory) {
            if ($parentCategory == $request->category) {
                continue;
            }
            CategoryRelation::updateOrCreate(['category_id' => $request->category, 'parent_category_id' => $parentCategory]);
        }

        return redirect(route('admin.categories.assign.parent'));
    }

    public function deleteRelation(CategoryRelation $categoryRelation)
    {
        $categoryRelation->delete();
        return redirect(route('admin.categories.assign.parent'));
    }

    public function import(Request $request)
    {
        $query = Category::query();

        if ($request->filled('name')) {
            $query = $query->where('name', 'like', '%' . $request->name . '%');
        }

        $data = $query->paginate(10);
        return view('admin.category.import', ['data' => $data]);
    }

    public function importCategory(Request $request, CategoryImport $categoryImport)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xlsx,xls|max:20480', // max 20MB
        ]);

        $path = $request->file('file')->store('temp', 'public');

        $categoryImport->import('storage/' . $path);

        Storage::disk('public')->delete($path);
        return back();
    }

    public function export(CategoryExport $categoryExport)
    {
        $categoryExport->export();
    }
}

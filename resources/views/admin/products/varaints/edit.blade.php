@extends('admin.layouts.app')

@section('title', '  Variant | Store 9Nepal Admin Dashboard')

@section('admin-content')
    <aside class="">
        <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/5">
            @include('admin.components.session')
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90 mb-4">
                Edit Product Variant
            </h3>

            <form action="{{ route('admin.products.variants.update', $variant->id) }}" method="POST">
                @csrf @method('PATCH')

                <div class="space-y-5">

                    <!-- Product Variant Name -->
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Product Variant <span class="text-error-500">*</span>
                        </label>
                         <input type="text"
                                value="{{ $variant->product->name }}" readonly
                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5
                       text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300
                       focus:outline-hidden focus:ring-3 focus:ring-brand-500/10
                       dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30
                       dark:focus:border-brand-800" />
                         <input type="text" id="product_id" name="product_id"
                                value="{{ old('product_id') ?? $variant->product_id }}" hidden
                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5
                       text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300
                       focus:outline-hidden focus:ring-3 focus:ring-brand-500/10
                       dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30
                       dark:focus:border-brand-800" />
                        <x-input-error :messages="$errors->get('product_id')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                        <!-- Product Title -->
                        <div class="lg:col-span-1">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Title <span class="text-error-500">*</span>
                            </label>
                            <input type="text" id="title" name="title" placeholder="Enter the title"
                                value="{{ old('title') ?? $variant->title }}"
                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5
                       text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300
                       focus:outline-hidden focus:ring-3 focus:ring-brand-500/10
                       dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30
                       dark:focus:border-brand-800" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- SKU -->
                        <div class="lg:col-span-1">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                SKU <span class="text-error-500">*</span>
                            </label>
                            <input type="text" id="sku" name="sku" placeholder="Enter the custom sku"
                                value="{{ old('sku') ?? $variant->sku }}"
                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5
                       text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300
                       focus:outline-hidden focus:ring-3 focus:ring-brand-500/10
                       dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30
                       dark:focus:border-brand-800" />
                            <x-input-error :messages="$errors->get('sku')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Short Description -->
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Short Description <span class="text-gray-500">(optional)</span>
                        </label>
                        <textarea name="short_description" rows="1"
                            class="dark:bg-dark-900 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5
                       text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300
                       focus:outline-hidden focus:ring-3 focus:ring-brand-500/10
                       dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30
                       dark:focus:border-brand-800">{{ old('short_description') ?? $variant->short_description }}</textarea>
                        <x-input-error :messages="$errors->get('short_description')" class="mt-2" />
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Description <span class="text-gray-500">(optional)</span>
                        </label>
                        <textarea name="description" rows="3"
                            class="dark:bg-dark-900 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5
                       text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300
                       focus:outline-hidden focus:ring-3 focus:ring-brand-500/10
                       dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30
                       dark:focus:border-brand-800">{{ old('description') ?? $variant->description }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

                        <!-- 🚀 Pricing -->
                        <div class="lg:col-span-1">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Price <span class="text-error-500">*</span>
                            </label>
                            <input type="number" step="0.01" name="price" value="{{ old('price') ?? $variant->price }}"
                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5
        text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300
        focus:outline-hidden focus:ring-3 focus:ring-brand-500/10
        dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30
        dark:focus:border-brand-800" />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>
                        <div class="lg:col-span-1">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Cost Price <span class="text-gray-500">(optional)</span>
                            </label>
                            <input type="number" step="0.01" name="cost_price" value="{{ old('cost_price') ?? $variant->cost_price }}"
                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5
        text-sm text-gray-800 shadow-theme-xs
        dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                            <x-input-error :messages="$errors->get('cost_price')" class="mt-2" />
                        </div>
                    </div>

                    <!-- 🚀 Inventory -->
                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                        <div class="lg:col-span-1">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Manage Stock
                            </label>
                            <select name="manage_stock"
                                class="w-full h-11 rounded-lg border border-gray-300 px-4 bg-transparent dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                                <option value="1" {{ $variant->manage_stock == 1 ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ $variant->manage_stock == 0 ? 'selected' : '' }}>No</option>
                            </select>
                            <x-input-error :messages="$errors->get('manage_stock')" class="mt-2" />
                        </div>

                        <div class="lg:col-span-1">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Stock Quantity
                            </label>
                            <input type="number" name="stock_quantity" value="{{ old('stock_quantity') ?? $variant->stock_quantity }}"
                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5
        text-sm text-gray-800 shadow-theme-xs
        dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                            <x-input-error :messages="$errors->get('stock_quantity')" class="mt-2" />
                        </div>

                        <div class="lg:col-span-1">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Stock Status
                            </label>
                            <select name="stock_status"
                                class="w-full h-11 rounded-lg border border-gray-300 px-4 bg-transparent dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                                <option value="in_stock" {{ old('stock_status') == "in_stock" || $variant->stock_status == "in_stock" ? 'selected' : '' }}>In Stock</option>
                                <option value="out_of_stock" {{ old('stock_status') == "out_of_stock" || $variant->stock_status == "out_of_stock" ? 'selected' : '' }}>Out of Stock</option>
                                <option value="on_backorder" {{ old('stock_status') == "on_backorder" || $variant->stock_status == 1 ? 'selected' : '' }}>On Backorder</option>
                            </select>
                            <x-input-error :messages="$errors->get('stock_status')" class="mt-2" />
                        </div>
                    </div>

                    <!-- 🚀 Physical Attributes -->
                    <div class="grid grid-cols-2 gap-4 lg:grid-cols-4">
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Weight
                                (kg)</label>
                            <input type="number" step="0.001" name="weight" value="{{ old('weight') ?? $variant->weight }}"
                                class="dark:bg-dark-900 dark:text-gray-100 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4" />
                            <x-input-error :messages="$errors->get('weight')" class="mt-2" />
                        </div>

                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Length
                                (mm)</label>
                            <input type="number" step="0.01" name="length" value="{{ old('length') ?? $variant->length }}"
                                class="dark:bg-dark-900 dark:text-gray-100 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4" />
                            <x-input-error :messages="$errors->get('length')" class="mt-2" />
                        </div>

                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Width
                                (mm)</label>
                            <input type="number" step="0.01" name="width" value="{{ old('width') ?? $variant->width }}"
                                class="dark:bg-dark-900 dark:text-gray-100 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4" />
                            <x-input-error :messages="$errors->get('width')" class="mt-2" />
                        </div>

                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Height
                                (mm)</label>
                            <input type="number" step="0.01" name="height" value="{{ old('height') ?? $variant->height }}"
                                class="dark:bg-dark-900 dark:text-gray-100 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4" />
                            <x-input-error :messages="$errors->get('height')" class="mt-2" />
                        </div>
                    </div>

                    <!-- 🚀 Status Flags -->
                    <div class="grid lg:grid-cols-4 gap-4">
                        <div class="flex items-center gap-2">
                            <input type="checkbox" name="is_active" value="{{ $variant->is_active }}" checked
                                class="rounded text-brand-500 dark:bg-gray-900" />
                            <label class="text-sm text-gray-700 dark:text-gray-400">Active</label>
                            <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="checkbox" name="on_sale" value="{{ $variant->on_sale }}" checked
                                class="rounded text-brand-500 dark:bg-gray-900" />
                            <label class="text-sm text-gray-700 dark:text-gray-400">On Sale</label>
                            <x-input-error :messages="$errors->get('on_sale')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="checkbox" name="is_featured" value="{{ $variant->is_featured }}"
                                class="rounded text-brand-500 dark:bg-gray-900" />
                            <label class="text-sm text-gray-700 dark:text-gray-400">Featured</label>
                            <x-input-error :messages="$errors->get('is_featured')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="checkbox" name="is_best_selling" value="{{ $variant->is_best_selling }}"
                                class="rounded text-brand-500 dark:bg-gray-900" />
                            <label class="text-sm text-gray-700 dark:text-gray-400">Best Selling</label>
                            <x-input-error :messages="$errors->get('is_best_selling')" class="mt-2" />
                        </div>
                    </div>


                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                        <div class="lg:col-span-1">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Sale Price <span class="text-gray-500">(optional)</span>
                            </label>
                            <input type="number" step="0.01" name="sale_price" value="{{ old('sale_price') ?? $variant->sale_price }}"
                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5
        text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300
        focus:outline-hidden focus:ring-3 focus:ring-brand-500/10
        dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30
        dark:focus:border-brand-800" />
                            <x-input-error :messages="$errors->get('sale_price')" class="mt-2" />
                        </div>

                        <div class="lg:col-span-1">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Sale Starts At
                            </label>
                            <input type="datetime-local" name="sale_starts_at" value="{{ old('sale_starts_at') ?? $variant->sale_starts_at }}"
                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5
            text-sm text-gray-800 shadow-theme-xs
            dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                            <x-input-error :messages="$errors->get('sale_starts_at')" class="mt-2" />
                        </div>

                        <div class="lg:col-span-1">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Sale Ends At
                            </label>
                            <input type="datetime-local" name="sale_ends_at" value="{{ old('sale_ends_at') ?? $variant->sale_ends_at }}"
                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5
            text-sm text-gray-800 shadow-theme-xs
            dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                            <x-input-error :messages="$errors->get('sale_ends_at')" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Publish
                            Date <span class="text-gray-500">(optional)</span></label>
                        <input type="datetime-local" name="published_at" value="{{ old('published_at') ?? $variant->published_at }}"
                            class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4
        dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                            <x-input-error :messages="$errors->get('published_at')" class="mt-2" />
                    </div>

                    <!-- 🚀 Meta Title -->
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Meta Title <span class="text-gray-500">(optional)</span>
                        </label>
                        <input type="text" name="meta_title" placeholder="Recommended: short & SEO-friendly title"
                            value="{{ old('meta_title') ?? $variant->meta_title }}"
                            class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5
                       text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300
                       focus:outline-hidden focus:ring-3 focus:ring-brand-500/10
                       dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30
                       dark:focus:border-brand-800" />
                        <x-input-error :messages="$errors->get('meta_title')" class="mt-2" />
                    </div>

                    <!-- 🚀 Meta Description -->
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Meta Description <span class="text-gray-500">(optional)</span>
                        </label>
                        <textarea name="meta_description" rows="3" placeholder="Short SEO description for search engines"
                            class="dark:bg-dark-900 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5
                       text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300
                       focus:outline-hidden focus:ring-3 focus:ring-brand-500/10
                       dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30
                       dark:focus:border-brand-800">{{ old('meta_description') ?? $variant->meta_description }}</textarea>
                        <x-input-error :messages="$errors->get('meta_description')" class="mt-2" />
                    </div>

                    <!-- 🚀 Meta Keywords -->
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Meta Keywords <span class="text-gray-500">(comma-separated)</span>
                        </label>
                        <input type="text" name="meta_keywords" placeholder="laptops, gaming laptop, budget laptop"
                            value="{{ old('meta_keywords') ?? $variant->meta_keywords }}"
                            class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5
                       text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300
                       focus:outline-hidden focus:ring-3 focus:ring-brand-500/10
                       dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30
                       dark:focus:border-brand-800" />
                        <x-input-error :messages="$errors->get('meta_keywords')" class="mt-2" />
                    </div>

                </div>

                <!-- Button -->
                <div class="pt-6">
                    <button
                        class="flex items-center justify-center w-full px-4 py-3 text-sm font-medium text-white transition
                   rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                        Edit Product Variant
                    </button>
                </div>
            </form>
        </div>
    </aside>
@endsection

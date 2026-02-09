@extends('admin.layouts.app')

@section('admin-content')
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <!-- LEFT SIDE FORM -->
        <aside class="lg:col-span-1">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/5">

                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90 mb-4">
                    Edit Product
                </h3>

                <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="space-y-5">

                        <!-- Product Name -->
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Name <span class="text-error-500">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Category -->
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Category <span class="text-error-500">*</span>
                            </label>
                            <select name="category_id" required
                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>

                        <!-- Brand -->
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Brand
                            </label>
                            <select name="brand_id"
                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm">
                                <option value="">No Brand</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}"
                                        {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Product Image
                            </label>
                            <input type="file" name="image" accept="image/*"
                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm">
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Description
                            </label>
                            <textarea name="description" rows="3"
                                class="dark:bg-dark-900 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm">{{ old('description', $product->description) }}</textarea>
                        </div>

                        <!-- Price -->
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Price <span class="text-error-500">*</span>
                            </label>
                            <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}"
                                required
                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm">
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>

                        <!-- Discount Price -->
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Discount Price
                            </label>
                            <input type="number" step="0.01" name="discount_price"
                                value="{{ old('discount_price', $product->discount_price) }}"
                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm">
                        </div>

                        <!-- Status -->
                        <div class="flex items-center gap-2">
                            <input type="checkbox" name="is_active" value="1"
                                {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                            <label class="text-sm text-gray-700 dark:text-gray-400">
                                Active
                            </label>
                        </div>

                    </div>

                    <div class="pt-6">
                        <button class="w-full px-4 py-3 text-sm font-medium text-white rounded-lg bg-brand-500">
                            Update Product
                        </button>
                    </div>
                </form>

            </div>

        </aside>

        <aside class="lg:col-span-1">
            <div
                class="overflow-hidden rounded-2xl border border-gray-200 bg-white px-4 pb-3 pt-4 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6">
                <div class="grid grid-cols-1 gap-4 mb-4 sm:grid-cols-3 sm:items-center">
                    <!-- Left: Title -->
                    <div class="col-span-1">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                            Products
                        </h3>
                    </div>

                    <!-- Right: Search Form -->
                    <form action="{{ route('admin.products.index') }}" method="GET"
                        class="col-span-1 sm:col-span-2 flex gap-2">
                        <input type="text" name="product_name" placeholder="Search by product name."
                            value="{{ old('product_name') ?? request('product_name') }}"
                            class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5
            text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300
            focus:outline-hidden focus:ring-3 focus:ring-brand-500/10
            dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30
            dark:focus:border-brand-800" />
                        <button
                            class="flex items-center justify-center px-3 text-sm font-medium text-white transition
            rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                            Search
                        </button>
                    </form>
                </div>

                <div class="w-full overflow-x-auto">
                    <table class="min-w-full">
                        <!-- table header start -->
                        {{-- <thead>
                            <tr class="border-gray-100 border-y dark:border-gray-800">
                                <th class="py-3">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            Name
                                        </p>
                                    </div>
                                </th>
                                <th class="py-3">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            Slug
                                        </p>
                                    </div>
                                </th>
                                <th class="py-3">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            SKU
                                        </p>
                                    </div>
                                </th>
                                <th class="py-3">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            Action
                                        </p>
                                    </div>
                                </th>
                            </tr>
                        </thead> --}}
                        <thead>
                            <tr class="border-gray-100 border-y dark:border-gray-800">
                                <th class="py-3">Name</th>
                                <th class="py-3">Category</th>
                                <th class="py-3">Brand</th>
                                <th class="py-3">Price</th>
                                <th class="py-3">Status</th>
                                <th class="py-3 text-right">Action</th>
                            </tr>
                        </thead>

                        <!-- table header end -->
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            @forelse ($data as $item)
                                <tr>
                                    <!-- Name -->
                                    <td class="py-3">
                                        <p class="font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                            {{ $item->name }}
                                        </p>
                                    </td>

                                    <!-- Category -->
                                    <td class="py-3">
                                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                            {{ $item->category?->name ?? '-' }}
                                        </p>
                                    </td>

                                    <!-- Brand -->
                                    <td class="py-3">
                                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                            {{ $item->brand?->name ?? '-' }}
                                        </p>
                                    </td>

                                    <!-- Price -->
                                    <td class="py-3">
                                        @if ($item->discount_price)
                                            <p class="text-theme-sm text-gray-800 dark:text-white/90">
                                                <span class="line-through text-gray-400">
                                                    Rs. {{ number_format($item->price, 2) }}
                                                </span>
                                                <span class="ml-1 font-semibold text-brand-500">
                                                    Rs. {{ number_format($item->discount_price, 2) }}
                                                </span>
                                            </p>
                                        @else
                                            <p class="text-theme-sm text-gray-800 dark:text-white/90">
                                                Rs. {{ number_format($item->price, 2) }}
                                            </p>
                                        @endif
                                    </td>

                                    <!-- Status -->
                                    <td class="py-3">
                                        @if ($item->is_active)
                                            <span
                                                class="px-2 py-1 text-xs font-medium rounded-full
                    bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">
                                                Active
                                            </span>
                                        @else
                                            <span
                                                class="px-2 py-1 text-xs font-medium rounded-full
                    bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400">
                                                Inactive
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Actions -->
                                    <td class="py-3 text-right">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('admin.products.show', $item->id) }}" title="View">
                                                👁️
                                            </a>

                                            <a href="{{ route('admin.products.edit', $item->id) }}" title="Edit">
                                                ✏️
                                            </a>

                                            <form action="{{ route('admin.products.destroy', $item->id) }}"
                                                method="POST">
                                                @csrf @method('DELETE')
                                                <button onclick="return confirm('Delete {{ $item->name }}?')"
                                                    title="Delete">
                                                    🗑️
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-6 text-center text-gray-500">
                                        No products found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                        {{-- <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            @if (count($data) == 0)
                                <tr>
                                    <td class="py-3 text-center" colspan="4">
                                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                            No Data Available
                                        </p>
                                    </td>
                                </tr>
                            @else
                                @foreach ($data as $item)
                                    <tr>
                                        <td class="py-3">
                                            <div class="flex items-center">
                                                <div class="flex items-center gap-3">
                                                    <div>
                                                        <p
                                                            class="font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                                            {{ $item->name }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3">
                                            <div class="flex items-center">
                                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                    {{ $item->slug }}
                                                </p>
                                            </div>
                                        </td>
                                        <td class="py-3">
                                            <div class="flex items-center">
                                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                    {{ $item->sku }}
                                                </p>
                                            </div>
                                        </td>
                                        <td class="py-3">
                                            <div class="flex items-center">
                                                <div class="text-gray-500 text-theme-sm dark:text-gray-400 flex gap-2">
                                                    <a href="{{ route('admin.products.show', $item->id) }}">
                                                        <button title="view {{ $item->name }}">
                                                            <svg class="fill-gray-900 dark:fill-gray-100" height="16"
                                                                width="16" version="1.1" id="Layer_1"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                viewBox="0 0 42 42" enable-background="new 0 0 42 42"
                                                                xml:space="preserve">
                                                                <path
                                                                    d="M15.3,20.1c0,3.1,2.6,5.7,5.7,5.7s5.7-2.6,5.7-5.7s-2.6-5.7-5.7-5.7S15.3,17,15.3,20.1z M23.4,32.4
                         C30.1,30.9,40.5,22,40.5,22s-7.7-12-18-13.3c-0.6-0.1-2.6-0.1-3-0.1c-10,1-18,13.7-18,13.7s8.7,8.6,17,9.9
                         C19.4,32.6,22.4,32.6,23.4,32.4z M11.1,20.7c0-5.2,4.4-9.4,9.9-9.4s9.9,4.2,9.9,9.4S26.5,30,21,30S11.1,25.8,11.1,20.7z" />
                                                            </svg>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('admin.products.edit', $item->id) }}">
                                                        <button title="edit {{ $item->name }}">
                                                            <svg class="fill-gray-900 dark:fill-gray-100" width="16"
                                                                height="16" viewBox="0 0 24 24"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M21,12a1,1,0,0,0-1,1v6a1,1,0,0,1-1,1H5a1,1,0,0,1-1-1V5A1,1,0,0,1,5,4h6a1,1,0,0,0,0-2H5A3,3,0,0,0,2,5V19a3,3,0,0,0,3,3H19a3,3,0,0,0,3-3V13A1,1,0,0,0,21,12ZM6,12.76V17a1,1,0,0,0,1,1h4.24a1,1,0,0,0,.71-.29l6.92-6.93h0L21.71,8a1,1,0,0,0,0-1.42L17.47,2.29a1,1,0,0,0-1.42,0L13.23,5.12h0L6.29,12.05A1,1,0,0,0,6,12.76ZM16.76,4.41l2.83,2.83L18.17,8.66,15.34,5.83ZM8,13.17l5.93-5.93,2.83,2.83L10.83,16H8Z" />
                                                            </svg>
                                                        </button>
                                                    </a>
                                                    <form action="{{ route('admin.products.destroy', $item->id) }}"
                                                        method="POST">
                                                        @csrf @method('DELETE')
                                                        <button title="delete {{ $item->name }}"
                                                            onclick="return confirm('Are you sure you want to delete {{ $item->name }} product?')">
                                                            <svg class="fill-gray-900 dark:fill-gray-100" width="16px"
                                                                height="16px" viewBox="-3 -2 24 24"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                preserveAspectRatio="xMinYMin" class="jam jam-trash">
                                                                <path
                                                                    d='M6 2V1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1h4a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-.133l-.68 10.2a3 3 0 0 1-2.993 2.8H5.826a3 3 0 0 1-2.993-2.796L2.137 7H2a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h4zm10 2H2v1h14V4zM4.141 7l.687 10.068a1 1 0 0 0 .998.932h6.368a1 1 0 0 0 .998-.934L13.862 7h-9.72zM7 8a1 1 0 0 1 1 1v7a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v7a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1z' />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody> --}}
                    </table>
                    <div class="mt-4">
                        {{ $data->links('vendor.pagination.tailwind') }}
                    </div>
                </div>
            </div>
        </aside>
    </div>
@endsection

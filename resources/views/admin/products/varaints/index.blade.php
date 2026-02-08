@extends('admin.layouts.app')

@section('title', 'Product Variants')

@section('admin-content')
<aside>
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white px-4 pb-3 pt-4 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6">
        <div class="flex flex-col gap-2 mb-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center justify-between w-full sm:w-auto">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Product Variants</h3>
                <a href="{{ route('admin.products.variants.create') }}">
                    <button class="bg-success-500 px-5 py-1 rounded-lg text-white sm:hidden">Create</button>
                </a>
            </div>

            <form action="{{ route('admin.products.variants.index') }}" method="GET" class="flex gap-2 w-full sm:w-auto">
                <input type="text" name="product_name" placeholder="Search by product's name."
                    value="{{ old('product_name', request('product_name')) }}"
                    class="h-12 w-full rounded-lg border px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                <button class="px-3 text-sm font-medium text-white bg-brand-500 rounded-lg hover:bg-brand-600">Search</button>
            </form>

            <a href="{{ route('admin.products.variants.create') }}">
                <button class="hidden sm:block bg-success-500 px-5 py-1 rounded-lg text-white">Create</button>
            </a>
        </div>

        <div class="w-full overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="border-gray-100 border-y dark:border-gray-800">
                        <th class="py-3"><p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Product Name</p></th>
                        <th class="py-3"><p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Size / Color</p></th>
                        <th class="py-3"><p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Stock</p></th>
                        <th class="py-3"><p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Action</p></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse ($data as $variant)
                        <tr>
                            <td class="py-3">{{ $variant->product->name }}</td>
                            <td class="py-3">
                                <span class="text-gray-500">{{ $variant->size ?? 'N/A' }} / {{ $variant->color ?? 'N/A' }}</span>
                            </td>
                            <td class="py-3">{{ $variant->stock }}</td>
                            <td class="py-3 flex gap-2">
                                <a href="{{ route('admin.products.variants.assign.color.family', $variant->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded">Color</a>
                                <a href="{{ route('admin.products.variants.edit', $variant->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>
                                <form action="{{ route('admin.products.variants.destroy', $variant->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-gray-500 py-3">No variants available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4">
                {{ $data->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>
</aside>
@endsection

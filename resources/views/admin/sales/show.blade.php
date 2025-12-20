@extends('admin.layouts.app')

@section('title', ' Sale | Store 9Nepal Admin Dashboard')

@section('admin-content')
    <aside class="">
        <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/5">

            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90 mb-4">
                Sale Details
            </h3>

            <div class="space-y-5">

                <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                    <!-- User Name -->
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-400">Sale Entered By</label>
                        <p class="mt-1 text-gray-900 dark:text-white/90">{{ $sale->saleEnteredBy->name }}</p>
                    </div>

                    <!-- Product Name -->
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-400">Product Name</label>
                        <p class="mt-1 text-gray-900 dark:text-white/90">{{ $sale->productVariant->product->name }}</p>
                    </div>
                </div>

                <!-- Title & SKU -->
                <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-400">Product Variant Title</label>
                        <p class="mt-1 text-gray-900 dark:text-white/90">{{ $sale->productVariant->title }}</p>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-400">Product Variant SKU</label>
                        <p class="mt-1 text-gray-900 dark:text-white/90">{{ $sale->productVariant->sku }}</p>
                    </div>
                </div>

                <!-- Stock and Quantity -->
                <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-400">Sale Quantity</label>
                        <p class="mt-1 text-gray-900 dark:text-white/90">{{ $sale->quantity }}</p>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-400">Remaining in stock</label>
                        <p class="mt-1 text-gray-900 dark:text-white/90">{{ $sale->productVariant->stock_quantity }}</p>
                    </div>
                </div>

                <!-- Prices -->
                <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-400">Sold For (NPR)</label>
                        <p class="mt-1 text-gray-900 dark:text-white/90">{{ $sale->sold_for }}</p>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-400">Selling Price (NPR)</label>
                        <p class="mt-1 text-gray-900 dark:text-white/90">{{ $sale->productVariant->price }}</p>
                    </div>
                </div>



            </div>

            <!-- BUTTONS -->
            <div class="pt-6 flex justify-end gap-3">
                @if (auth()->id() == $sale->sale_entry_by || auth()->user()->hasRole('super-admin'))
                    <a href="{{ route('admin.sales.edit', $sale->id) }}"
                        class="px-4 py-3 text-sm font-medium text-white bg-brand-500 rounded-lg hover:bg-brand-600">
                        Edit Sale
                    </a>
                @endif

                <a href="{{ route('admin.sales.index') }}"
                    class="px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 border rounded-lg">
                    Back
                </a>
            </div>

        </div>
    </aside>
@endsection

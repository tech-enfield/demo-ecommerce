@extends('admin.layouts.app')

@section('title', ' Variant Details | Store 9Nepal Admin Dashboard')

@section('admin-content')
<aside class="">
    <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/5">

        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90 mb-4">
            Product Variant Details
        </h3>

        <div class="space-y-5">

            <!-- Product Name -->
            <div>
                <label class="text-sm font-medium text-gray-700 dark:text-gray-400">Product</label>
                <p class="mt-1 text-gray-900 dark:text-white/90">{{ $variant->product->name }}</p>
            </div>

            <!-- Title & SKU -->
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                <div>
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-400">Title</label>
                    <p class="mt-1 text-gray-900 dark:text-white/90">{{ $variant->title }}</p>
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-400">SKU</label>
                    <p class="mt-1 text-gray-900 dark:text-white/90">{{ $variant->sku }}</p>
                </div>
            </div>

            <!-- Short Description -->
            <div>
                <label class="text-sm font-medium text-gray-700 dark:text-gray-400">Short Description</label>
                <p class="mt-1 text-gray-900 dark:text-white/90">{{ $variant->short_description ?? '—' }}</p>
            </div>

            <!-- Description -->
            <div>
                <label class="text-sm font-medium text-gray-700 dark:text-gray-400">Description</label>
                <p class="mt-1 text-gray-900 dark:text-white/90">{!! nl2br(e($variant->description)) ?: '—' !!}</p>
            </div>

            <!-- PRICING -->
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                <div>
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-400">Price</label>
                    <p class="mt-1 text-gray-900 dark:text-white/90">Rs. {{ $variant->price }}</p>
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-400">Cost Price</label>
                    <p class="mt-1 text-gray-900 dark:text-white/90">
                        {{ $variant->cost_price ? 'Rs. '.$variant->cost_price : '—' }}
                    </p>
                </div>
            </div>

            <!-- INVENTORY -->
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

                <div>
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-400">Manage Stock</label>
                    <p class="mt-1 text-gray-900 dark:text-white/90">{{ $variant->manage_stock ? 'Yes' : 'No' }}</p>
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-400">Stock Quantity</label>
                    <p class="mt-1 text-gray-900 dark:text-white/90">{{ $variant->stock_quantity }}</p>
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-400">Stock Status</label>
                    <p class="mt-1 text-gray-900 dark:text-white/90">{{ ucfirst(str_replace('_', ' ', $variant->stock_status)) }}</p>
                </div>
            </div>

            <!-- PHYSICAL ATTRIBUTES -->
            <div class="grid grid-cols-2 gap-4 lg:grid-cols-4">

                @php
                    $attrs = [
                        'Weight (kg)' => $variant->weight,
                        'Length (mm)' => $variant->length,
                        'Width (mm)'  => $variant->width,
                        'Height (mm)' => $variant->height,
                    ];
                @endphp

                @foreach($attrs as $label => $value)
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-400">{{ $label }}</label>
                        <p class="mt-1 text-gray-900 dark:text-white/90">{{ $value ?? '—' }}</p>
                    </div>
                @endforeach

            </div>

            <!-- STATUS FLAGS -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

                @php
                    $flags = [
                        'Active'       => $variant->is_active,
                        'On Sale'      => $variant->on_sale,
                        'Featured'     => $variant->is_featured,
                        'Best Selling' => $variant->is_best_selling,
                    ];
                @endphp

                @foreach($flags as $label => $value)
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-400">{{ $label }}</label>
                        <p class="mt-1 text-gray-900 dark:text-white/90">
                            {{ $value ? 'Yes' : 'No' }}
                        </p>
                    </div>
                @endforeach

            </div>

            <!-- SALE INFO -->
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

                @php
                    $saleInfo = [
                        'Sale Price'    => $variant->sale_price ? 'Rs. ' . $variant->sale_price : '—',
                        'Sale Starts At'=> $variant->sale_starts_at ?? '—',
                        'Sale Ends At'  => $variant->sale_ends_at ?? '—',
                    ];
                @endphp

                @foreach($saleInfo as $label => $value)
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-400">{{ $label }}</label>
                        <p class="mt-1 text-gray-900 dark:text-white/90">{{ $value }}</p>
                    </div>
                @endforeach

            </div>

            <!-- Publish -->
            <div>
                <label class="text-sm font-medium text-gray-700 dark:text-gray-400">Published At</label>
                <p class="mt-1 text-gray-900 dark:text-white/90">{{ $variant->published_at ?? '—' }}</p>
            </div>

            <!-- Meta -->
            <div>
                <label class="text-sm font-medium text-gray-700 dark:text-gray-400">Meta Title</label>
                <p class="mt-1 text-gray-900 dark:text-white/90">{{ $variant->meta_title ?? '—' }}</p>
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700 dark:text-gray-400">Meta Description</label>
                <p class="mt-1 text-gray-900 dark:text-white/90">{{ $variant->meta_description ?? '—' }}</p>
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700 dark:text-gray-400">Meta Keywords</label>
                <p class="mt-1 text-gray-900 dark:text-white/90">{{ $variant->meta_keywords ?? '—' }}</p>
            </div>

        </div>

        <!-- BUTTONS -->
        <div class="pt-6 flex justify-end gap-3">
            <a href="{{ route('admin.products.variants.edit', $variant->id) }}"
               class="px-4 py-3 text-sm font-medium text-white bg-brand-500 rounded-lg hover:bg-brand-600">
                Edit Variant
            </a>

            <a href="{{ route('admin.products.show', $variant->product_id) }}"
               class="px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 border rounded-lg">
                Back
            </a>
        </div>

    </div>
</aside>
@endsection

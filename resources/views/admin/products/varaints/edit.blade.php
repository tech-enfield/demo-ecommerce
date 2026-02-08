@extends('admin.layouts.app')

@section('admin-content')
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<aside class="lg:col-span-1">
    <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/5">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90 mb-4">Edit Product Variant</h3>

        <form action="{{ route('admin.products.variants.update', $variant->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="space-y-5">
                <!-- Product Select -->
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Product <span class="text-error-500">*</span>
                    </label>
                    <select id="productSelect" name="product_id" class="w-full h-11 rounded-lg border px-4 py-2.5 dark:bg-dark-900 dark:text-white/90">
                        <option value="">Select Product</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ old('product_id', $variant->product_id) == $product->id ? 'selected' : '' }}>
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('product_id')" class="mt-2" />
                </div>

                <!-- Size -->
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Size <span class="text-gray-500">(optional)</span>
                    </label>
                    <input type="text" name="size" value="{{ old('size', $variant->size) }}"
                        class="h-11 w-full rounded-lg border px-4 py-2.5 dark:bg-dark-900 dark:text-white/90"
                        placeholder="Enter size">
                    <x-input-error :messages="$errors->get('size')" class="mt-2" />
                </div>

                <!-- Color -->
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Color <span class="text-gray-500">(optional)</span>
                    </label>
                    <input type="text" name="color" value="{{ old('color', $variant->color) }}"
                        class="h-11 w-full rounded-lg border px-4 py-2.5 dark:bg-dark-900 dark:text-white/90"
                        placeholder="Enter color">
                    <x-input-error :messages="$errors->get('color')" class="mt-2" />
                </div>

                <!-- Stock -->
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Stock <span class="text-error-500">*</span>
                    </label>
                    <input type="number" name="stock" value="{{ old('stock', $variant->stock) }}" min="0"
                        class="h-11 w-full rounded-lg border px-4 py-2.5 dark:bg-dark-900 dark:text-white/90"
                        placeholder="Enter stock quantity">
                    <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                </div>
            </div>

            <!-- Button -->
            <div class="pt-6">
                <button type="submit" class="flex items-center justify-center w-full px-4 py-3 text-sm font-medium text-white bg-brand-500 rounded-lg hover:bg-brand-600">
                    Update Variant
                </button>
            </div>
        </form>
    </div>
</aside>

<!-- jQuery (required by Select2) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('#productSelect').select2({
        placeholder: "Select a product",
        width: "100%",
        allowClear: true
    });
});
</script>
@endsection

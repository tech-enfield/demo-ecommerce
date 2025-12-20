@extends('admin.layouts.app')

@section('title', 'Product | Store 9Nepal Admin Dashboard')

@section('admin-content')
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <!-- LEFT SIDE FORM -->
        <aside class="lg:col-span-1">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/5">

                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90 mb-4">
                    Create Product
                </h3>

                <form action="{{ route('admin.products.import.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="space-y-5">

                        <!-- Excel File -->
                        <div class="mb-4">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Excel File <span class="text-error-500">*</span>
                            </label>

                            <input type="file" name="file" id="file"
                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5
                       text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 cursor-pointer
                       focus:outline-hidden focus:ring-3 focus:ring-brand-500/10
                       dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30
                       dark:focus:border-brand-800">

                            <x-input-error :messages="$errors->get('file')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="pt-6">
                        <button
                            class="flex items-center justify-center w-full px-4 py-3 text-sm font-medium text-white transition
                   rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                            Import Products
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

                    <!-- Right: Export Button -->
                    <div class="col-span-1 sm:col-span-2 flex justify-end">
                        <a href="{{ route('admin.products.export') }}">
                            <button
                                class="flex items-center gap-2 px-4 py-2 text-sm font-medium
                   text-white bg-brand-500 rounded-md shadow hover:bg-brand-600
                   transition">
                                Export / Download
                            </button></a>
                    </div>
                </div>

                <div class="w-full overflow-x-auto">
                    <table class="min-w-full">
                        <!-- table header start -->
                        <thead>
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
                        </thead>
                        <!-- table header end -->

                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
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
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $data->links('vendor.pagination.tailwind') }}
                    </div>
                </div>
            </div>
        </aside>
    </div>
@endsection

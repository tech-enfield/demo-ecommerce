@extends('admin.layouts.app')

@section('title', 'Assign Category To Parent Category')

@section('admin-content')
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <!-- Select2 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <aside class="lg:col-span-1">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/5">

                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90 mb-4">
                    Assign Category To Parents
                </h3>

                <form action="{{ route('admin.categories.assign.parent.store') }}" method="POST">
                    @csrf

                    <div class="space-y-5">

                        <!-- Category Name -->
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Category <span class="text-error-500">*</span> <span></span>
                            </label>

                            <select name="category" id="categorySelect"
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                                <option value="" selected disabled>Select a category</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}"
                                        class="bg-white text-gray-700 dark:bg-gray-900 dark:text-gray-300">
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>

                            <x-input-error :messages="$errors->get('category')" class="mt-2" />
                        </div>

                        <!-- Roles Multi Select with Select2 -->
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Assign Parent <span class="text-error-500">*</span>
                            </label>

                            <select name="parent_categories[]" id="categoryParentSelect" multiple
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}"
                                        class="bg-white text-gray-700 dark:bg-gray-900 dark:text-gray-300">
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>

                            <x-input-error :messages="$errors->get('parent_categories')" class="mt-2" />
                        </div>

                    </div>

                    <!-- Button -->
                    <div class="pt-6">
                        <button
                            class="flex items-center justify-center w-full px-4 py-3 text-sm font-medium text-white rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                            Assign Category To Parent Category
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
                            Category Relation
                        </h3>
                    </div>

                    <!-- Right: Search Form -->
                    <form action="{{ route('admin.categories.assign.parent') }}" method="GET"
                        class="col-span-1 sm:col-span-2 flex gap-2">
                        <input type="text" name="parent_category" placeholder="Search by parent category."
                            value="{{ old('parent_category') ?? request('parent_category') }}"
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
                        <thead>
                            <tr class="border-gray-100 border-y dark:border-gray-800">
                                <th class="py-3">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            Parent Category
                                        </p>
                                    </div>
                                </th>
                                <th class="py-3">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            Category
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
                                    <td class="py-3 text-center" colspan="3">
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
                                                            {{ $item->parentCategory->name }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3">
                                            <div class="flex items-center">
                                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                    {{ $item->category->name }}
                                                </p>
                                            </div>
                                        </td>
                                        <td class="py-3">
                                            <div class="flex items-center">
                                                <div class="text-gray-500 text-theme-sm dark:text-gray-400 flex gap-2">
                                                    <form action="{{ route('admin.categories.delete.relation', $item->id) }}"
                                                        method="POST">
                                                        @csrf @method('DELETE')
                                                        <button title="delete {{ $item->category->name }} - {{ $item->parentCategory->name }}"
                                                            onclick="return confirm('Are you sure you want to delete {{ $item->category->name }} - {{ $item->parentCategory->name }} relation?')">
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
    <!-- jQuery (required by Select2) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#categorySelect').select2({
                placeholder: "Select a category",
                width: "100%",
                allowClear: true,
            });
            $('#categoryParentSelect').select2({
                placeholder: "Select parent categories",
                width: "100%",
                allowClear: true,
            });
        });
    </script>
@endsection

@extends('admin.layouts.app')

@section('title', 'Users | Store 9Nepal Admin Dashboard')

@section('admin-content')
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <!-- Select2 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <!-- LEFT SIDE FORM -->
        <aside class="lg:col-span-1">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/5">

                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90 mb-4">
                    Assign Role To User
                </h3>

                <form action="{{ route('admin.assign.role.store', $user->id) }}" method="POST">
                    @csrf

                    <div class="space-y-5">

                        <!-- User Name -->
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                User's Name <span class="text-error-500">*</span>
                            </label>
                            <input type="text" value="{{ $user->name }}" readonly
                                class="h-11 w-full rounded-lg border dark:bg-dark-900 border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                        </div>

                        <!-- Roles Multi Select with Select2 -->
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Assign Roles <span class="text-error-500">*</span>
                            </label>

                            <select name="roles[]" id="roleSelect" multiple
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}" class="bg-white text-gray-700 dark:bg-gray-900 dark:text-gray-300"
                                        {{ $user->roles->pluck('name')->contains($role->name) ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>

                            <x-input-error :messages="$errors->get('roles')" class="mt-2" />
                        </div>

                    </div>

                    <!-- Button -->
                    <div class="pt-6">
                        <button
                            class="flex items-center justify-center w-full px-4 py-3 text-sm font-medium text-white rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                            Assign Role To User
                        </button>
                    </div>
                </form>
            </div>
        </aside>

        <aside class="lg:col-span-1">
            <div
                class="overflow-hidden rounded-2xl border border-gray-200 bg-white px-4 pb-3 pt-4 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6">
                <div class="flex flex-col gap-2 mb-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                            Users
                        </h3>
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
                                            Email
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
                                    <td class="py-3 text-center" colspan="2">
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
                                                    {{ $item->email }}
                                                </p>
                                            </div>
                                        </td>
                                        <td class="py-3">
                                            <div class="flex items-center">
                                                <div class="text-gray-500 text-theme-sm dark:text-gray-400 flex gap-2">
                                                    <a href="{{ route('admin.assign.role', $item->id) }}">
                                                        <button title="assign role to {{ $item->name }}">
                                                            <svg width="16px" height="16px" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path class="stroke-gray-900 dark:stroke-gray-100"
                                                                    d="M18.6 3H5.4A2.4 2.4 0 0 0 3 5.4v15.2A2.4 2.4 0 0 0 5.4 23h13.2a2.4 2.4 0 0 0 2.4-2.4V5.4A2.4 2.4 0 0 0 18.6 3Z"
                                                                    fill-opacity=".16" stroke-width="1.5"
                                                                    stroke-miterlimit="10" />
                                                                <path d="M7 14h10M7 11h10M7 17h6"
                                                                    class="stroke-gray-900 dark:stroke-gray-100"
                                                                    stroke-width="1.5" stroke-miterlimit="10"
                                                                    stroke-linecap="round" />
                                                                <path
                                                                    d="M15.2 6a.8.8 0 0 0 .8-.8V3H8v2.2a.8.8 0 0 0 .8.8h6.4Z"
                                                                    class="fill-gray-100 dark:fill-gray-900" />
                                                                <path d="M16 3v2.2a.8.8 0 0 1-.8.8H8.8a.8.8 0 0 1-.8-.8V3"
                                                                    stroke-width="1.5"
                                                                    class="stroke-gray-900 dark:stroke-gray-100"
                                                                    stroke-miterlimit="10" stroke-linecap="round" />
                                                                <path
                                                                    d="M18.6 3H5.4A2.4 2.4 0 0 0 3 5.4v15.2A2.4 2.4 0 0 0 5.4 23h13.2a2.4 2.4 0 0 0 2.4-2.4V5.4A2.4 2.4 0 0 0 18.6 3Z"
                                                                    stroke-width="1.5"
                                                                    class="stroke-gray-900 dark:stroke-gray-100"
                                                                    stroke-miterlimit="10" />
                                                                <path d="M14 3a2 2 0 1 0-4 0" stroke-width="1.5"
                                                                    stroke-miterlimit="10"
                                                                    class="stroke-gray-900 dark:stroke-gray-100"
                                                                    stroke-linecap="round" />
                                                            </svg>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('admin.users.edit', $item->id) }}">
                                                        <button title="edit {{ $item->name }}">
                                                            <svg class="fill-gray-900 dark:fill-gray-100" width="16"
                                                                height="16" viewBox="0 0 24 24"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M21,12a1,1,0,0,0-1,1v6a1,1,0,0,1-1,1H5a1,1,0,0,1-1-1V5A1,1,0,0,1,5,4h6a1,1,0,0,0,0-2H5A3,3,0,0,0,2,5V19a3,3,0,0,0,3,3H19a3,3,0,0,0,3-3V13A1,1,0,0,0,21,12ZM6,12.76V17a1,1,0,0,0,1,1h4.24a1,1,0,0,0,.71-.29l6.92-6.93h0L21.71,8a1,1,0,0,0,0-1.42L17.47,2.29a1,1,0,0,0-1.42,0L13.23,5.12h0L6.29,12.05A1,1,0,0,0,6,12.76ZM16.76,4.41l2.83,2.83L18.17,8.66,15.34,5.83ZM8,13.17l5.93-5.93,2.83,2.83L10.83,16H8Z" />
                                                            </svg>
                                                        </button>
                                                    </a>
                                                    <form action="{{ route('admin.users.destroy', $item->id) }}"
                                                        method="POST">
                                                        @csrf @method('DELETE')
                                                        <button title="delete {{ $item->name }}"
                                                            onclick="return confirm('Are you sure you want to delete {{ $item->name }} user?')">
                                                            <svg class="fill-gray-900 dark:fill-gray-100" width="16px" height="16px" viewBox="-3 -2 24 24"
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
            $('#roleSelect').select2({
                placeholder: "Select roles",
                width: "100%",
                allowClear: true,
            });
        });
    </script>

@endsection

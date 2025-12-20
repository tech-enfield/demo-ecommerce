@extends('admin.layouts.app')

@section('title', 'Banner Image | Store 9Nepal Admin Dashboard')

@section('admin-content')
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <!-- LEFT SIDE FORM -->
        <aside class="lg:col-span-1">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/5">

                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90 mb-4">
                    Upload Banner Image
                </h3>

                <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PATCH')

                    <div class="space-y-5">
                        <!-- Images -->
                        <div class="mb-4">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Image <span class="text-error-500">*
                            </label>

                            <div
                                class="flex items-center gap-4 border rounded-lg px-3 py-2 bg-transparent
                        dark:border-gray-700 dark:bg-dark-900">
                                <input type="file" id="image" name="image" accept="image/*" class="hidden"
                                    onchange="previewImage(event)" />
                                <label for="image"
                                    class="cursor-pointer text-sm font-medium text-gray-700 dark:text-gray-300
                           hover:text-gray-900 dark:hover:text-white transition">
                                    Choose File
                                </label>
                                <span id="file-name" class="text-sm text-gray-600 dark:text-gray-400">
                                    {{ old('image') ? basename(old('image')) : 'No file chosen' }}
                                </span>
                            </div>

                            <div class="mt-2 relative max-w-full flex">
                                <img id="image-preview"
                                    src="{{ asset('storage/' . $banner->path) }}"
                                    class="max-h-32 rounded-lg shadow-md" />
                                <button type="button" id="remove-image" onclick="removeImage()"
                                    class="top-0 right-0 bg-red-500 text-white rounded-full w-5 h-5 flex items-center
                           justify-center text-xs hover:bg-red-600">&times;</button>
                            </div>

                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                        <!-- Title -->
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Title <span class="text-error-500">*</span>
                            </label>
                            <input type="text" id="title" name="title" placeholder="Enter the image title"
                                value="{{ $banner->title }}"
                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5
                       text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300
                       focus:outline-hidden focus:ring-3 focus:ring-brand-500/10
                       dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30
                       dark:focus:border-brand-800" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Link To -->
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Link To <span class="text-error-500">*</span>
                            </label>
                            <input type="text" id="hyper_link" name="hyper_link"
                                placeholder="Enter the link to redirect on click." value="{{ $banner->hyper_link }}"
                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5
                       text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300
                       focus:outline-hidden focus:ring-3 focus:ring-brand-500/10
                       dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30
                       dark:focus:border-brand-800" />
                            <x-input-error :messages="$errors->get('hyper_link')" class="mt-2" />
                        </div>

                        <!-- Sort Order -->
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Sort Order <span class="text-error-500">*</span>
                            </label>
                            <input type="number" id="order" name="order" min="1" step="1"
                                value="{{ $banner->order }}"
                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5
                       text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300
                       focus:outline-hidden focus:ring-3 focus:ring-brand-500/10
                       dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30
                       dark:focus:border-brand-800" />
                            <x-input-error :messages="$errors->get('order')" class="mt-2" />
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Status <span class="text-error-500">*</span>
                            </label>
                            <select name="status" id="status"
                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5
                       text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300
                       focus:outline-hidden focus:ring-3 focus:ring-brand-500/10
                       dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30
                       dark:focus:border-brand-800">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="pt-6">
                        <button
                            class="flex items-center justify-center w-full px-4 py-3 text-sm font-medium text-white transition
                   rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                            Upload Banner Image
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
                            Banner Images
                        </h3>
                    </div>

                    <!-- Right: Search Form -->
                    <form action="{{ route('admin.banners.index') }}" method="GET"
                        class="col-span-1 sm:col-span-2 flex gap-2">
                        <input type="text" name="title" placeholder="Search by banner title."
                            value="{{ old('title') ?? request('title') }}"
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
                                            Title
                                        </p>
                                    </div>
                                </th>
                                <th class="py-3">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            Image
                                        </p>
                                    </div>
                                </th>
                                <th class="py-3">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            Sort
                                        </p>
                                    </div>
                                </th>
                                <th class="py-3">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            Status
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
                                    <td class="py-3 text-center" colspan="5">
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
                                                            {{ $item->title }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3">
                                            <div class="flex items-center">
                                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                    <img src="{{ asset('storage/' . $item->path) }}"
                                                        alt="{{ $item->title }}" class="h-16"
                                                        title="{{ $item->title }}">
                                                </p>
                                            </div>
                                        </td>
                                        <td class="py-3">
                                            <div class="flex items-center">
                                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                    {{ $item->order }}
                                                </p>
                                            </div>
                                        </td>
                                        <td class="py-3">
                                            <div class="flex items-center">
                                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                    @if ($item->status)
                                                        <svg width="32" height="32" viewBox="0 0 1024 1024"
                                                            class="icon" version="1.1"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M511.891456 928.549888c229.548032 0 415.634432-186.0864 415.634432-415.634432C927.525888 283.3664 741.439488 97.28 511.890432 97.28 282.343424 97.28 96.258048 283.3664 96.258048 512.915456c0 229.548032 186.084352 415.634432 415.634432 415.634432"
                                                                class="fill-success-500" />
                                                            <path
                                                                d="M436.571136 707.376128l330.3936-330.3936c5.506048-5.507072 8.571904-12.803072 8.633344-20.544512 0.060416-7.85408-2.961408-15.235072-8.511488-20.784128 0.001024-0.012288-0.001024-0.002048-0.001024-0.002048l-0.001024-0.001024c-5.410816-5.409792-12.978176-8.489984-20.687872-8.460288-7.810048 0.032768-15.13984 3.081216-20.640768 8.58112l-309.11488 309.116928-94.99648-94.998528c-5.501952-5.501952-12.833792-8.5504-20.642816-8.58112h-0.115712c-7.69536 0-15.186944 3.08224-20.569088 8.465408-11.360256 11.36128-11.307008 29.899776 0.118784 41.325568l109.924352 109.924352a29.017088 29.017088 0 0 0 4.883456 6.474752c5.658624 5.6576 13.095936 8.482816 20.550656 8.481792a29.31712 29.31712 0 0 0 20.77696-8.604672M511.891456 97.28C282.3424 97.28 96.256 283.3664 96.256 512.915456s186.0864 415.634432 415.635456 415.634432c229.548032 0 415.634432-186.085376 415.634432-415.634432C927.525888 283.365376 741.439488 97.28 511.891456 97.28m0 40.96c50.597888 0 99.661824 9.901056 145.82784 29.427712 44.61056 18.868224 84.683776 45.889536 119.10656 80.31232 34.422784 34.422784 61.444096 74.496 80.313344 119.107584 19.525632 46.164992 29.426688 95.228928 29.426688 145.82784s-9.901056 99.662848-29.426688 145.82784c-18.869248 44.61056-45.89056 84.6848-80.313344 119.107584s-74.496 61.443072-119.10656 80.31232c-46.166016 19.526656-95.229952 29.426688-145.82784 29.426688-50.598912 0-99.662848-9.900032-145.828864-29.426688-44.61056-18.869248-84.683776-45.889536-119.10656-80.31232-34.422784-34.422784-61.444096-74.497024-80.313344-119.107584C147.117056 612.57728 137.216 563.514368 137.216 512.915456s9.901056-99.662848 29.426688-145.82784c18.869248-44.611584 45.89056-84.6848 80.313344-119.107584s74.496-61.444096 119.10656-80.31232C412.228608 148.140032 461.292544 138.24 511.891456 138.24"
                                                                class="fill-gray-100 dark:fill-gray-900" />
                                                        </svg>
                                                    @else
                                                        <svg width="32" height="32" viewBox="0 0 1024 1024"
                                                            class="icon" version="1.1"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M511.881216 929.554432c230.109184 0 416.649216-186.540032 416.649216-416.649216S741.9904 96.256 511.881216 96.256 95.232 282.796032 95.232 512.905216s186.540032 416.649216 416.649216 416.649216"
                                                                class="fill-error-500" />
                                                            <path
                                                                d="M698.098688 376.60672L551.447552 523.256832l144.979968 144.979968c5.0688 5.0688 7.891968 11.782144 7.94624 18.905088 0.057344 7.221248-2.720768 14.006272-7.82336 19.10784 0.002048 0.003072-0.001024 0.004096-0.003072 0.004096-4.943872 4.943872-11.829248 7.774208-18.907136 7.774208h-0.113664c-7.185408-0.03072-13.93152-2.835456-18.993152-7.897088L513.553408 561.152 366.901248 707.805184c-5.506048 5.504-12.841984 8.55552-20.655104 8.589312h-0.123904c-7.70048 0-15.194112-3.08224-20.579328-8.46848l-0.004096-0.002048c-5.553152-5.554176-8.577024-12.939264-8.516608-20.799488 0.060416-7.74656 3.129344-15.049728 8.640512-20.558848l146.651136-146.65216-144.978944-144.979968c-5.0688-5.0688-7.891968-11.783168-7.947264-18.907136-0.05632-7.221248 2.722816-14.00832 7.827456-19.110912 4.941824-4.942848 11.8272-7.773184 18.907136-7.773184h0.11264c7.186432 0.03072 13.93152 2.833408 18.993152 7.89504L510.208 482.018304l146.65216-146.65216c5.506048-5.506048 12.843008-8.556544 20.65408-8.590336h0.124928c7.70048 0 15.19616 3.084288 20.5824 8.470528 5.552128 5.55008 8.578048 12.939264 8.516608 20.79744-0.059392 7.748608-3.12832 15.049728-8.640512 20.56192m79.434752 401.95072c-34.515968 34.516992-74.697728 61.611008-119.430144 80.530432-46.28992 19.57888-95.485952 29.507584-146.22208 29.507584-50.736128 0-99.93216-9.928704-146.223104-29.508608-44.731392-18.919424-84.913152-46.012416-119.42912-80.528384-34.515968-34.515968-61.609984-74.697728-80.530432-119.431168C146.11968 612.839424 136.192 563.641344 136.192 512.90624c0-50.736128 9.92768-99.93216 29.50656-146.223104 18.920448-44.731392 46.014464-84.914176 80.530432-119.42912 34.515968-34.515968 74.697728-61.609984 119.42912-80.530432C411.949056 147.14368 461.145088 137.216 511.881216 137.216s99.93216 9.928704 146.22208 29.50656c44.732416 18.920448 84.914176 46.014464 119.42912 80.530432 34.516992 34.514944 61.611008 74.698752 80.531456 119.42912 19.57888 46.291968 29.50656 95.488 29.50656 146.223104 0 50.736128-9.92768 99.93216-29.50656 146.22208-18.920448 44.731392-46.014464 84.9152-80.530432 119.431168M511.881216 96.256C281.772032 96.256 95.232 282.796032 95.232 512.904192 95.232 743.0144 281.772032 929.555456 511.881216 929.555456s416.649216-186.54208 416.649216-416.65024C928.530432 282.796032 741.9904 96.256 511.881216 96.256"
                                                                class="fill-gray-100 dark:fill-gray-900" />
                                                        </svg>
                                                    @endif
                                                </p>
                                            </div>
                                        </td>
                                        <td class="py-3">
                                            <div class="flex items-center">
                                                <div class="text-gray-500 text-theme-sm dark:text-gray-400 flex gap-2">
                                                    {{-- <a href="{{ route('admin.banners.show', $item->id) }}">
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
                                                    </a> --}}
                                                    <a href="{{ route('admin.banners.edit', $item->id) }}">
                                                        <button title="edit {{ $item->title }} - {{ $item->alt }}">
                                                            <svg class="fill-gray-900 dark:fill-gray-100" width="16"
                                                                height="16" viewBox="0 0 24 24"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M21,12a1,1,0,0,0-1,1v6a1,1,0,0,1-1,1H5a1,1,0,0,1-1-1V5A1,1,0,0,1,5,4h6a1,1,0,0,0,0-2H5A3,3,0,0,0,2,5V19a3,3,0,0,0,3,3H19a3,3,0,0,0,3-3V13A1,1,0,0,0,21,12ZM6,12.76V17a1,1,0,0,0,1,1h4.24a1,1,0,0,0,.71-.29l6.92-6.93h0L21.71,8a1,1,0,0,0,0-1.42L17.47,2.29a1,1,0,0,0-1.42,0L13.23,5.12h0L6.29,12.05A1,1,0,0,0,6,12.76ZM16.76,4.41l2.83,2.83L18.17,8.66,15.34,5.83ZM8,13.17l5.93-5.93,2.83,2.83L10.83,16H8Z" />
                                                            </svg>
                                                        </button>
                                                    </a>
                                                    <form action="{{ route('admin.banners.destroy', $item->id) }}"
                                                        method="POST">
                                                        @csrf @method('DELETE')
                                                        <button title="delete {{ $item->title }} - {{ $item->alt }}"
                                                            onclick="return confirm('Are you sure you want to delete {{ $item->title }} - {{ $item->alt }} product image?')">
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
    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('image-preview');
            const fileName = document.getElementById('file-name');
            const removeBtn = document.getElementById('remove-image');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    removeBtn.classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
                fileName.textContent = input.files[0].name;
            } else {
                preview.src = '';
                preview.classList.add('hidden');
                removeBtn.classList.add('hidden');
                fileName.textContent = 'No file chosen';
            }
        }

        function removeImage() {
            const input = document.getElementById('image');
            const preview = document.getElementById('image-preview');
            const fileName = document.getElementById('file-name');
            const removeBtn = document.getElementById('remove-image');

            input.value = '';
            preview.src = '';
            preview.classList.add('hidden');
            removeBtn.classList.add('hidden');
            fileName.textContent = 'No file chosen';
        }
    </script>
@endsection

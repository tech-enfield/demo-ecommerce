@extends('admin.layouts.app')

@section('title', 'Orders')

@section('admin-content')
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <aside class="">
        <div
            class="overflow-hidden rounded-2xl border border-gray-200 bg-white px-4 pb-3 pt-4 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6">
            <div class="flex flex-col gap-2 mb-4 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center justify-between w-full sm:w-auto">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Orders
                    </h3>
                </div>
            </div>


            <div x-data="orderModal()">
                <div class="w-full overflow-x-auto">
                    <table class="min-w-full">
                        <!-- table header start -->
                        <thead>
                            <tr class="border-gray-100 border-y dark:border-gray-800">
                                <th class="py-3">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            Order ID
                                        </p>
                                    </div>
                                </th>
                                <th class="py-3">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            Receiver Name
                                        </p>
                                    </div>
                                </th>
                                <th class="py-3">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            Contact
                                        </p>
                                    </div>
                                </th>
                                <th class="py-3">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            Delivery Address
                                        </p>
                                    </div>
                                </th>
                                <th class="py-3">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            Payment Method
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
                                {{-- <th class="py-3">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            Action
                                        </p>
                                    </div>
                                </th> --}}
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
                                                        <p @click="openOrder({{ $item->id }})"
                                                            class="cursor-pointer font-medium text-indigo-600 hover:underline">
                                                            {{ $item->order_number }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3" title="{{ $item->title }}">
                                            <div class="flex items-center">
                                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                    {{ $item->name }}
                                                </p>
                                            </div>
                                        </td>
                                        <td class="py-3">
                                            <div class="flex items-center">
                                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                    {{ $item->contact }}
                                                </p>
                                            </div>
                                        </td>
                                        <td class="py-3">
                                            <div class="flex items-center">
                                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                    {{ $item->shipping_address }}
                                                </p>
                                            </div>
                                        </td>
                                        <td class="py-3">
                                            <div class="flex items-center">
                                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                    {{ $item->payment_method }}
                                                </p>
                                            </div>
                                        </td>
                                        <td class="py-3">
                                            <div x-data="{ open: false, status: '{{ $item->status }}' }" class="relative flex items-center">

                                                <!-- Display current status, clickable -->
                                                <p @click="open = !open"
                                                    class="cursor-pointer text-gray-500 text-theme-sm dark:text-gray-400">
                                                    <span x-text="status"></span>
                                                </p>

                                                <!-- Dropdown -->
                                                <div x-show="open" @click.outside="open = false"
                                                    class="absolute mt-2 bg-white border rounded shadow-md z-50">
                                                    <template x-for="option in ['pending','processing','completed','cancelled']"
                                                        :key="option">
                                                        <p @click="
                        status = option;
                        open = false;
                        updateStatus({{ $item->id }}, option)
                    "
                                                            class="px-4 py-2 hover:bg-gray-100 cursor-pointer" x-text="option">
                                                        </p>
                                                    </template>
                                                </div>
                                            </div>
                                        </td>

                                        {{-- <td class="py-3">
                                            <div class="flex items-center">
                                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                    {{ $item->status }}
                                                </p>
                                            </div>
                                        </td> --}}
                                        {{-- <td class="py-3">
                                            <div class="flex items-center">
                                                <div class="text-gray-500 text-theme-sm dark:text-gray-400 flex gap-2">
                                                    <a href="{{ route('admin.orders.show', $item->id) }}">
                                                        <button title="view {{ $item->name }}">
                                                            <svg class="fill-gray-900 dark:fill-gray-100" height="16"
                                                                width="16" version="1.1" id="Layer_1"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 42 42"
                                                                enable-background="new 0 0 42 42" xml:space="preserve">
                                                                <path
                                                                    d="M15.3,20.1c0,3.1,2.6,5.7,5.7,5.7s5.7-2.6,5.7-5.7s-2.6-5.7-5.7-5.7S15.3,17,15.3,20.1z M23.4,32.4
                                                    C30.1,30.9,40.5,22,40.5,22s-7.7-12-18-13.3c-0.6-0.1-2.6-0.1-3-0.1c-10,1-18,13.7-18,13.7s8.7,8.6,17,9.9
                                                    C19.4,32.6,22.4,32.6,23.4,32.4z M11.1,20.7c0-5.2,4.4-9.4,9.9-9.4s9.9,4.2,9.9,9.4S26.5,30,21,30S11.1,25.8,11.1,20.7z" />
                                                            </svg>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('admin.orders.edit', $item->id) }}">
                                                        <button title="edit {{ $item->name }}">
                                                            <svg class="fill-gray-900 dark:fill-gray-100" width="16"
                                                                height="16" viewBox="0 0 24 24"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M21,12a1,1,0,0,0-1,1v6a1,1,0,0,1-1,1H5a1,1,0,0,1-1-1V5A1,1,0,0,1,5,4h6a1,1,0,0,0,0-2H5A3,3,0,0,0,2,5V19a3,3,0,0,0,3,3H19a3,3,0,0,0,3-3V13A1,1,0,0,0,21,12ZM6,12.76V17a1,1,0,0,0,1,1h4.24a1,1,0,0,0,.71-.29l6.92-6.93h0L21.71,8a1,1,0,0,0,0-1.42L17.47,2.29a1,1,0,0,0-1.42,0L13.23,5.12h0L6.29,12.05A1,1,0,0,0,6,12.76ZM16.76,4.41l2.83,2.83L18.17,8.66,15.34,5.83ZM8,13.17l5.93-5.93,2.83,2.83L10.83,16H8Z" />
                                                            </svg>
                                                        </button>
                                                    </a>
                                                    <form action="{{ route('admin.orders.destroy', $item->id) }}"
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
                                        </td> --}}
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $data->links('vendor.pagination.tailwind') }}
                    </div>
                    <div x-data="orderModal()" x-show="open" x-cloak
                        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
                        <div @click.outside="open = false"
                            class="bg-white dark:bg-gray-900 w-full max-w-3xl rounded-lg shadow-lg p-6">
                            <!-- Header -->
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-lg font-semibold">
                                    Order #<span x-text="order.order_number"></span>
                                </h2>
                                <button @click="open = false">✕</button>
                            </div>

                            <!-- Items -->
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="border-b">
                                        <th class="text-left py-2">Product</th>
                                        <th>Variant</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template x-for="item in items" :key="item.product">
                                        <tr class="border-b">
                                            <td class="py-2" x-text="item.product"></td>
                                            <td class="text-center" x-text="item.variant"></td>
                                            <td class="text-center" x-text="item.quantity"></td>
                                            <td class="text-right">Rs. <span x-text="item.price"></span></td>
                                            <td class="text-right font-medium">
                                                Rs. <span x-text="item.subtotal"></span>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>

                            <!-- Footer -->
                            <div class="text-right mt-4">
                                <p class="font-semibold">
                                    Grand Total: Rs. <span x-text="order.grand_total"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                allowClear: true,
            });
        });
    </script>

    <script>
        function updateStatus(orderId, newStatus) {
            fetch(`/admin/orders/${orderId}/status`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        status: newStatus
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        console.log('Status updated!');
                    } else {
                        alert('Failed to update status');
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert('Error updating status');
                });
        }
    </script>
    <script>
        function orderModal() {
            return {
                open: false,
                order: {},
                items: [],

                openOrder(id) {
                    fetch(`/admin/orders/${id}/items`)
                        .then(res => res.json())
                        .then(data => {
                            this.order = data.order
                            this.items = data.items
                            this.open = true
                        })
                }
            }
        }
    </script>

@endsection

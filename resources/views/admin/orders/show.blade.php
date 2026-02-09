@extends('admin.layouts.app')

@section('admin-content')
    <h1 class="text-xl font-semibold mb-4">
        Order #{{ $order->order_number }}
    </h1>

    <div class="mb-6 space-y-1 text-sm">
        <p><strong>Name:</strong> {{ $order->name }}</p>
        <p><strong>Contact:</strong> {{ $order->contact }}</p>
        <p><strong>Address:</strong> {{ $order->shipping_address }}</p>
        <p><strong>Status:</strong> {{ $order->status }}</p>
        <p><strong>Payment:</strong> {{ $order->payment_method }}</p>
    </div>

    <table class="min-w-full border">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-left">Product</th>
                <th class="px-4 py-2 text-left">Variant</th>
                <th class="px-4 py-2 text-left">Qty</th>
                <th class="px-4 py-2 text-left">Price</th>
                <th class="px-4 py-2 text-left">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr class="border-t">
                    <td class="px-4 py-2">
                        {{ $item->variant->product->title ?? '-' }}
                    </td>
                    <td class="px-4 py-2">
                        {{ $item->variant->title ?? '-' }}
                    </td>
                    <td class="px-4 py-2">
                        {{ $item->quantity }}
                    </td>
                    <td class="px-4 py-2">
                        Rs. {{ number_format($item->price, 2) }}
                    </td>
                    <td class="px-4 py-2">
                        Rs. {{ number_format($item->price * $item->quantity, 2) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4 text-right font-semibold">
        Total: Rs. {{ number_format($order->total, 2) }}
    </div>
    @section

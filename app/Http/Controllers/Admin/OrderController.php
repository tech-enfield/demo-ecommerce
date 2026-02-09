<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Order::paginate(10);
        return view('admin.orders.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return response()->json(['success' => true, 'status' => $order->status]);
    }

    public function items(Order $order)
    {
        $order->load(['items.variant.product']);

        return response()->json([
            'order' => $order,
            'items' => $order->items->map(function ($item) {
                return [
                    'product'  => $item->variant->product->title ?? 'N/A',
                    'variant'  => trim($item->variant->size . ' ' . $item->variant->color),
                    'quantity' => $item->quantity,
                    'price'    => $item->price,
                    'subtotal' => $item->quantity * $item->price,
                ];
            }),
        ]);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class OrderController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Order::with('items')->where('user_id', Auth::id())->get();
        return $this->sendResponse($data);
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
        try {
            $auth = Auth::user();
            $cart = Cart::where('user_id', $auth->id)->first();
            $cartItems = CartItem::where('cart_id', $cart->id)->get();

            $total = 0;

            $order = Order::create([
                'user_id' => $auth->id,
                'total' => 0,
                'shipping_address' => $request->shipping_address,
                'payment_method' => $request->payment_method,
                'name' => $request->name,
                'contact' => $request->contact,
            ]);

            foreach ($cartItems as $item) {
                $rate = $item->variant->product->price;
                $quantity = $item->quantity;

                $amount = $rate * $quantity;
                $total = $total + $amount;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_variant_id' => $item->product_variant_id,
                    'quantity' => $item->quantity,
                    'rate' => $rate,
                ]);
            }

            $order->update(['total' => $total]);

            CartItem::where('cart_id', $cart->id)->delete();

            return $this->sendResponse($order);
        } catch (Throwable $t) {
            return $this->sendError($t->getMessage(), null, 500);
        }
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
}

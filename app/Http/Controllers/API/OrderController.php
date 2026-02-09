<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\RewardPoint;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
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
            $auth = User::find(Auth::id());
            $cart = Cart::where('user_id', $auth->id)->first();
            $cartItems = CartItem::where('cart_id', $cart->id)->get();

            $total = 0;

            $order = Order::create([
                'order_number' => Str::orderedUuid(),
                'user_id' => $auth->id,
                'total' => 0,
                'shipping_address' => $request->shipping_address,
                'payment_method' => $request->payment_method,
                'name' => $request->name,
                'contact' => $request->contact,
                'discount' => $request->discount != null ? $request->discount : 0,
                'grand_total' => 0,
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
                    'price' => $rate,
                ]);
            }

            $order->update(['total' => $total, 'grand_total' => $total - $request->discount]);

            CartItem::where('cart_id', $cart->id)->delete();

            $reward = $total * config('app.reward_point');

            User::where('id', $auth->id)
                ->increment('reward_point', $reward);
            User::where('id', $auth->id)
                ->decrement('reward_point', $request->discount);

                $user = User::where('id', $auth->id)->first();

            return $this->sendResponse($order, $user->reward_point);
        } catch (Throwable $t) {
            return $this->sendError($t->getMessage(), null, 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = Order::with('items.variant.product')->find($id);
        return $this->sendResponse($order);
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
        $auth = User::find(Auth::id());
        $auth->reward_point = $auth->reward_point + $order->discount;
        $order->update(['status' => 'cancelled']);
        return $this->sendResponse();
    }
}

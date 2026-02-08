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

            $order->update(['total' => $total]);

            CartItem::where('cart_id', $cart->id)->delete();

            // if(RewardPoint::where('user_id', $auth->id)->exists()) {
            //     $rp = RewardPoint::where('user_id', $auth->id)->first();
            //     $rp->point = $rp->point + $total*0.02;
            //     $rp->save();
            // }else{
            //     RewardPoint::create(['user_id' => $auth->id, 'point' => $total * 0.02]);
            // }

            $auth->reward_point = $auth->reward_point + $total * config("");

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

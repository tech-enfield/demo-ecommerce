<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Cart::with('items.variant.product')->where('user_id', Auth::id())->get();
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
        $auth = Auth::user();

        $cart = Cart::firstOrCreate(
            ['user_id' => $auth->id]
        );

        CartItem::create([
            'cart_id' => $cart->id,
            'product_variant_id' => $request->product_id,
        ]);

        return $this->sendResponse();
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        return $this->sendResponse($cart);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}

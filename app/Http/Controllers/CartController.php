<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cartForUser(User $user)
    {
        $user->load('carts.product');
        $carts = $user->carts;
        return response()->json(['carts' => $carts], 200);
    }
    public function showCart()
    {
        return view('cart.cart');
    }
    public function addProduct(Request $request)
    {
        $product_id = $request->input('product_id');
        $user_id = $request->input('user_id');
        $quantity = $request->input('quantity');

        $cart = Cart::where('product_id', $product_id)
            ->where('user_id', $user_id)
            ->first();

        if ($cart) {
            $cart->quantity += $quantity;
            $cart->save();
        } else {
            $cart = new Cart([
                'product_id' => $product_id,
                'user_id' => $user_id,
                'quantity' => $quantity
            ]);
            $cart->save();
        }

        return response()->json(['cart' => $cart], 202);
    }

    public function deleteCart(Cart $cart)
    {
        $cart->delete();
        return response()->json([], 200);
    }
    public function updateCart(Request $request, $cart_id)
    {
        $cart = Cart::findOrFail($cart_id);
        $cart->quantity = $request->input('quantity');
        $cart->save();
        return response()->json(['cart' =>$cart], 200);
    }
}

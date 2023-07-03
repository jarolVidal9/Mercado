<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cartForUser(User $user){
        $user->load('carts.product');
        $carts = $user->carts;
        return response()->json(['carts' => $carts], 200);
    }
    public function showCart(){
        return view('cart.cart');
    }
}

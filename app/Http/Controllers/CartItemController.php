<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    public function increaseQuantity(CartItem $cartItem, Request $request)
    {
        $quantity = $request->input('quantity', 1);
        $cartItem->increaseQuantity($quantity);

        return redirect()->route('cart.index')->with('success', 'Quantity increased successfully.');
    }

    public function decreaseQuantity(CartItem $cartItem, Request $request)
    {
        $quantity = $request->input('quantity', 1);
        $cartItem->decreaseQuantity($quantity);

        return redirect()->route('cart.index')->with('success', 'Quantity decreased successfully.');
    }
}

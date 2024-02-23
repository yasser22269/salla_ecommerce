<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cart = auth()->user()->cart;
        // If the user doesn't have a cart, create a new one
        if (!$cart) {
            $cart = auth()->user()->cart()->create();
        }
        return view('cart.index', compact('cart'));
    }

    public function addProduct(CartRequest $request, Product $product)
    {
        $cart = auth()->user()->cart;
        if (!$cart) {
            $cart = auth()->user()->cart()->create();
        }

        $quantity = $request->input('quantity', 1);

        $cart->addProduct($product, $quantity);

        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully.');
    }

    public function removeItem(Cart $cart, $itemId)
    {
        $cart->items()->findOrFail($itemId)->delete();

        return redirect()->route('cart.index')->with('success', 'Item removed from cart successfully.');
    }

    public function clearCart(Cart $cart)
    {
        $cart->clearCart();

        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully.');
    }

    public function checkout(Cart $cart)
    {
        try {
            // Check if the cart is not empty
            if ($cart->isEmpty()) {
                return redirect()->route('cart.index')->with('error', 'Cannot checkout an empty cart.');
            }

            DB::beginTransaction();
            // Create an order
                $order = $this->createOrder($cart);

            // Create order items based on cart items
                $this->createOrderItems($cart, $order);

            // Clear the cart
            $cart->clearCart();

            DB::commit();
            return redirect()->route('cart.index')->with('success', 'Checkout successful. Cart cleared.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('cart.index')->with('error', $e->getMessage());
        }
    }

    private function createOrder(Cart $cart)
    {
        return auth()->user()->orders()->create([
            'total_amount' => $cart->calculateTotalPrice(),
            'status' => 'pending',
        ]);
    }
    private function createOrderItems(Cart $cart, Order $order)
    {
        foreach ($cart->items as $cartItem) {
            $product = $cartItem->product;

            // Check if there's enough quantity available
            if ($product->quantity_available >= $cartItem->quantity) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $cartItem->quantity,
                    'price' => $product->price,
                ]);

                // Update product quantity
                $product->decrement('quantity_available', $cartItem->quantity);
            } else {
                throw new \Exception('Insufficient quantity for ' . $product->name);
            }
        }
    }
}

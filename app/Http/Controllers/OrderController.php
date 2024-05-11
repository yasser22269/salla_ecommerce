<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {

        $orders = auth()->user()->orders;

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }


    public function destroy(Order $order)
    {
        $this->authorize('delete', $order);
        // Check if the order status is "pending"
        if ($order->status !== 'pending') {
            return redirect()->route('orders.index')
                ->with('error', 'Cannot delete an order with status other than pending.');
        }

        // Use a database transaction for atomicity
        DB::transaction(function () use ($order) {
            // Restore product quantities
            foreach ($order->items as $item) {
                $product = $item->product;
                $product->increment('quantity_available', $item->quantity);
            }

            // Delete order items
            $order->items()->delete();

            // Delete associated records (e.g., payment, shipping, returnProducts)
            $order->payment()->delete();
            $order->shipping()->delete();

            // Delete the order
            $order->delete();
        });

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');

    }

    public function latestForUser($userId)
    {
        // Get the latest order for a specific user
        $latestOrder = Order::latestForUser($userId);

        return view('orders.latest', compact('latestOrder'));
    }
}

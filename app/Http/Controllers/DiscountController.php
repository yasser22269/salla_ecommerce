<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscountRequest;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::all();
        return view('discounts.index', compact('discounts'));
    }

    public function create()
    {
        $products = Product::all();
        return view('discounts.create', compact('products'));
    }

    public function store(DiscountRequest $request)
    {
        $discount = Discount::create($request->validated());
        return redirect()->route('discounts.index')->with('success', 'Discount created successfully.');
    }

    public function show(Discount $discount)
    {
        return view('discounts.show', compact('discount'));
    }

    public function edit(Discount $discount)
    {
        $products = Product::all();
        return view('discounts.edit', compact('discount', 'products'));
    }

    public function update(DiscountRequest $request, Discount $discount)
    {
        $discount->update($request->validated());
        return redirect()->route('discounts.index')->with('success', 'Discount updated successfully.');
    }

    public function destroy(Discount $discount)
    {
        $discount->delete();
        return redirect()->route('discounts.index')->with('success', 'Discount deleted successfully.');
    }
}

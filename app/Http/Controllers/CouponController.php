<?php

namespace App\Http\Controllers;

use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::all();
        return view('coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('coupons.create');
    }

    public function store(CouponRequest $request)
    {
        Coupon::create($request->validated());
        return redirect()->route('coupons.index')->with('success', 'Coupon created successfully.');
    }

    public function edit(Coupon $coupon)
    {
        return view('coupons.edit', compact('coupon'));
    }

    public function update(Coupon $coupon, CouponRequest $request)
    {
        $coupon->update($request->validated());
        return redirect()->route('coupons.index')->with('success', 'Coupon updated successfully.');
    }

    public function show(Coupon $coupon)
    {
        return view('coupons.show', compact('coupon'));
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('coupons.index')->with('success', 'Coupon deleted successfully.');
    }
}

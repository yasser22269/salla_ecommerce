<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{

    public function index()
    {
        $addresses = Address::all();
        return view('addresses.index', compact('addresses'));
    }


    public function create()
    {
        return view('addresses.create');
    }


    public function store(AddressRequest $request)
    {
        Address::create($request->validated());

        return redirect()->route('addresses.index')
            ->with('success', 'Address created successfully.');
    }


    public function show(Address $address)
    {
        return view('addresses.show', compact('address'));
    }


    public function edit(Address $address)
    {
        return view('addresses.edit', compact('address'));
    }


    public function update(AddressRequest $request, Address $address)
    {
        $address->update($request->validated());

        return redirect()->route('addresses.index')
            ->with('success', 'Address updated successfully.');
    }


    public function destroy(Address $address)
    {
        $address->delete();

        return redirect()->route('addresses.index')
            ->with('success', 'Address deleted successfully.');
    }
}

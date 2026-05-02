<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $customers = Customer::when($request->search, function ($q) use ($request) {
            $q->where('full_name', 'like', "%{$request->search}%");
        })->latest()->get();

        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name'             => 'required|string|max:150',
            'contact_number'        => 'required|string|max:20',
            'address'               => 'required|string|max:255',
            'driver_license_number' => 'required|string|unique:customers,driver_license_number',
        ]);

        Customer::create($request->only([
            'full_name', 'contact_number', 'address', 'driver_license_number'
        ]));

        return redirect()->route('customers.index')
                         ->with('success', 'Customer added successfully.');
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'full_name'             => 'required|string|max:150',
            'contact_number'        => 'required|string|max:20',
            'address'               => 'required|string|max:255',
            'driver_license_number' => 'required|string|unique:customers,driver_license_number,' . $customer->id,
        ]);

        $customer->update($request->only([
            'full_name', 'contact_number', 'address', 'driver_license_number'
        ]));

        return redirect()->route('customers.index')
                         ->with('success', 'Customer updated successfully.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')
                         ->with('success', 'Customer deleted.');
    }
}
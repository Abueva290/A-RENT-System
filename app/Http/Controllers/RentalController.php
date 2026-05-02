<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Customer;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function index()
    {
        $rentals = Rental::with(['customer', 'vehicle'])->latest()->get();
        return view('rentals.index', compact('rentals'));
    }

    public function create()
    {
        $customers = Customer::all();
        $vehicles = Vehicle::where('status', 'Available')->get();
        return view('rentals.create', compact('customers', 'vehicles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'vehicle_id'  => 'required',
            'rent_date'   => 'required|date',
            'return_date' => 'required|date|after:rent_date',
        ]);

        $vehicle = Vehicle::findOrFail($request->vehicle_id);
        $rentDate = \Carbon\Carbon::parse($request->rent_date);
        $returnDate = \Carbon\Carbon::parse($request->return_date);
        $duration = $rentDate->diffInDays($returnDate);
        $total = $duration * $vehicle->price_per_day;

        Rental::create([
            'customer_id'   => $request->customer_id,
            'vehicle_id'    => $request->vehicle_id,
            'rent_date'     => $request->rent_date,
            'return_date'   => $request->return_date,
            'duration_days' => $duration,
            'total_amount'  => $total,
            'status'        => 'Ongoing',
        ]);

        $vehicle->update(['status' => 'Rented']);

        return redirect()->route('rentals.index')->with('success', 'Rental confirmed!');
    }

    public function returnForm(Rental $rental)
    {
        return view('rentals.return', compact('rental'));
    }

    public function processReturn(Request $request, Rental $rental)
    {
        $request->validate([
            'payment_method' => 'required',
        ]);

        $rental->update([
            'status'          => 'Returned',
            'payment_method'  => $request->payment_method,
            'amount_tendered' => $request->amount_tendered ?? $rental->total_amount,
            'change_amount'   => $request->change_amount ?? 0,
        ]);

        $rental->vehicle->update(['status' => 'Available']);

        return redirect()->route('rentals.receipt', $rental);
    }

    public function receipt(Rental $rental)
    {
        return view('rentals.receipt', compact('rental'));
    }

    public function destroy(Rental $rental)
    {
        $rental->vehicle->update(['status' => 'Available']);
        $rental->delete();
        return redirect()->route('rentals.index')->with('success', 'Rental cancelled!');
    }
}
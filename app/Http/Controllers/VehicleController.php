<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    // Public car list
    public function index(Request $request)
    {
        $query = Vehicle::query();

        if ($request->search) {
            $query->where('brand', 'like', "%{$request->search}%")
                  ->orWhere('model', 'like', "%{$request->search}%");
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->sort === 'low') {
            $query->orderBy('price_per_day');
        } elseif ($request->sort === 'high') {
            $query->orderByDesc('price_per_day');
        }

        $vehicles = $query->get();
        return view('cars.index', compact('vehicles'));
    }

    // Vehicle list (admin)
    public function adminIndex()
    {
        $vehicles = Vehicle::latest()->get();
        return view('vehicles.index', compact('vehicles'));
    }

    // Add vehicle form
    public function create()
    {
        return view('vehicles.create');
    }

    // Save new vehicle
    public function store(Request $request)
    {
        $request->validate([
            'brand'         => 'required|string|max:100',
            'model'         => 'required|string|max:100',
            'year'          => 'required|digits:4|integer',
            'plate_number'  => 'required|string|unique:vehicles,plate_number',
            'price_per_day' => 'required|numeric|min:1',
            'status'        => 'required|in:Available,Rented,Maintenance',
        ]);

        Vehicle::create($request->only([
            'brand', 'model', 'year',
            'plate_number', 'price_per_day', 'status', 'image_url'
        ]));

        return redirect()->route('vehicles.index')
                         ->with('success', 'Vehicle added successfully.');
    }

    // Edit vehicle form
    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'));
    }

    // Update vehicle
    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'brand'         => 'required|string|max:100',
            'model'         => 'required|string|max:100',
            'year'          => 'required|digits:4|integer',
            'plate_number'  => 'required|string|unique:vehicles,plate_number,' . $vehicle->id,
            'price_per_day' => 'required|numeric|min:1',
            'status'        => 'required|in:Available,Rented,Maintenance',
        ]);

        $vehicle->update($request->only([
            'brand', 'model', 'year',
            'plate_number', 'price_per_day', 'status', 'image_url'
        ]));

        return redirect()->route('vehicles.index')
                         ->with('success', 'Vehicle updated successfully.');
    }

    // Delete vehicle
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('vehicles.index')
                         ->with('success', 'Vehicle deleted.');
    }
}
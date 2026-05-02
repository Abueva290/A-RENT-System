<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Customer;
use App\Models\Rental;

class DashboardController extends Controller
{
    public function index()
    {
        $totalVehicles  = Vehicle::count();
        $availableCars  = Vehicle::where('status', 'Available')->count();
        $rentedCars     = Vehicle::where('status', 'Rented')->count();
        $totalCustomers = Customer::count();
        $recentRentals  = Rental::with(['customer', 'vehicle'])
                                ->latest()
                                ->take(5)
                                ->get();

        return view('admin.dashboard', compact(
            'totalVehicles',
            'availableCars',
            'rentedCars',
            'totalCustomers',
            'recentRentals'
        ));
    }
}
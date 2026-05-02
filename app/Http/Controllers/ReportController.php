<?php

namespace App\Http\Controllers;

use App\Models\Rental;

class ReportController extends Controller
{
    public function index()
    {
        $totalIncome  = Rental::where('status', 'Returned')->sum('total_amount');
        $totalRentals = Rental::count();
        $activeRentals = Rental::where('status', 'Ongoing')->count();
        $rentals      = Rental::with(['customer', 'vehicle'])->latest()->get();

        return view('reports.index', compact(
            'totalIncome',
            'totalRentals',
            'activeRentals',
            'rentals'
        ));
    }
}
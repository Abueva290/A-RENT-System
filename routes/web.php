<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;

// ── Public routes ──────────────────────────────────────────────
Route::get('/', fn() => view('welcome'))->name('home');
Route::get('/cars', [VehicleController::class, 'index'])->name('cars.index');

// ── Auth routes ────────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/vehicles', [VehicleController::class, 'adminIndex'])->name('vehicles.index');
    Route::resource('vehicles', VehicleController::class)->except(['index']);

    Route::resource('customers', CustomerController::class);
    Route::resource('rentals', RentalController::class);

    Route::get('/rentals/{rental}/return', [RentalController::class, 'returnForm'])->name('rentals.return');
    Route::post('/rentals/{rental}/return', [RentalController::class, 'processReturn'])->name('rentals.process-return');
    Route::get('/rentals/{rental}/receipt', [RentalController::class, 'receipt'])->name('rentals.receipt');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
});

// ── Breeze auth routes ─────────────────────────────────────────
require __DIR__.'/auth.php';
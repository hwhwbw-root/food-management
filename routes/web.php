<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;

// Public landing
Route::get('/', fn () => view('welcome'))->name('home');

// Auth
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/login', [LoginController::class, 'showForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Dashboard redirect
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Vendor
Route::middleware(['auth', 'role:vendor'])->prefix('vendor')->name('vendor.')->group(function () {
    Route::resource('listings', VendorController::class)->names([
        'index'   => 'listings.index',
        'create'  => 'listings.create',
        'store'   => 'listings.store',
        'show'    => 'listings.show',
        'edit'    => 'listings.edit',
        'update'  => 'listings.update',
        'destroy' => 'listings.destroy',
    ]);

    // Reservation fulfilment (vendor side)
    Route::patch('/reservations/{id}/confirm', [ReservationController::class, 'confirm'])->name('reservations.confirm');
    Route::patch('/reservations/{id}/complete', [ReservationController::class, 'complete'])->name('reservations.complete');
});

// Buyer
Route::middleware(['auth', 'role:buyer'])->prefix('buyer')->name('buyer.')->group(function () {
    Route::get('/listings', [BuyerController::class, 'index'])->name('listings.index');
    Route::get('/listings/{id}', [BuyerController::class, 'show'])->name('listings.show');
    Route::get('/reservations', [BuyerController::class, 'myReservations'])->name('reservations');
    Route::post('/reserve/{listing}', [ReservationController::class, 'store'])->name('reserve');
    Route::patch('/reservations/{id}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');
});

// Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::delete('/users/{id}', [AdminController::class, 'destroyUser'])->name('users.destroy');
    Route::get('/listings', [AdminController::class, 'listings'])->name('listings');
    Route::delete('/listings/{id}', [AdminController::class, 'destroyListing'])->name('listings.destroy');
});

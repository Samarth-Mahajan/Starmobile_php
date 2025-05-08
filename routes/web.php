<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Set the root URL to directly use the products controller index method
Route::get('/', [ProductController::class, 'index'])->name('home');



Route::get('/about', function () {
    return Inertia::render('About');
})->name('about');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('Dashboard');

// Product routes - this handles all CRUD operations
Route::resource('products', ProductController::class);

// Keep profile routes for authenticated users
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
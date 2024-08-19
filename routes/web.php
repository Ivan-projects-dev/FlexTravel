<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\BookingController;

Route::get('/', function () { return view('welcome'); });
Route::get('/dashboard', function () { return view('dashboard'); })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/public-reviews', [ReviewController::class, 'publicIndex'])->name('public.reviews');
Route::get('/trips', [TripController::class, 'index'])->name('trips.index');
Route::get('/trips/{trip}', [TripController::class, 'show'])->name('trips.show');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/trips/create', [TripController::class, 'create'])->name('trips.create'); 
    Route::post('/trips', [TripController::class, 'store'])->name('trips.store');
    Route::get('/trips/{trip}/edit', [TripController::class, 'edit'])->name('trips.edit');
    Route::patch('/trips/{trip}', [TripController::class, 'update'])->name('trips.update');
    Route::delete('/trips/{trip}', [TripController::class, 'destroy'])->name('trips.destroy'); 
    Route::post('/trips/{trip}/book', [BookingController::class, 'book'])->name('trips.book');
});
Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
Route::resource('/reviews', ReviewController::class)->names([
    'index' => 'reviews.index',
    'create' => 'reviews.create',
    'store' => 'reviews.store',
    'show' => 'reviews.show',
    'edit' => 'reviews.edit',
    'update' => 'reviews.update',
    'destroy' => 'reviews.destroy',
]);
require __DIR__.'/auth.php';

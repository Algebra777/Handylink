<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScreenController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ScreenController::class, 'show'])->defaults('screen', 'home')->name('home');
Route::get('/find-artisans', [ScreenController::class, 'show'])->defaults('screen', 'find-artisans')->name('find.artisans');
Route::get('/booking-select-service', [ScreenController::class, 'show'])->defaults('screen', 'booking-select-service')->name('booking.select-service');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

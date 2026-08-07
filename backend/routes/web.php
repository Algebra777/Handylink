<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScreenController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ScreenController::class, 'show'])->defaults('screen', 'home')->name('home');
Route::get('/find-artisans', [ScreenController::class, 'show'])->defaults('screen', 'find-artisans')->name('find.artisans');
Route::get('/booking-select-service', [ScreenController::class, 'show'])->defaults('screen', 'booking-select-service')->name('booking.select-service');
Route::get('/artisans/search', function () {
    $service = trim((string) request('service', ''));
    $location = trim((string) request('location', ''));

    $query = \App\Models\Artisan::query()->with('category');

    if ($service !== '') {
        $query->where(function ($q) use ($service) {
            $q->where('description', 'like', "%{$service}%")
                ->orWhereHas('category', function ($categoryQuery) use ($service) {
                    $categoryQuery->where('name', 'like', "%{$service}%")
                        ->orWhere('slug', 'like', "%{$service}%")
                        ->orWhere('description', 'like', "%{$service}%" );
                });
        });
    }

    if ($location !== '') {
        $query->where(function ($q) use ($location) {
            $q->where('city', 'like', "%{$location}%")
                ->orWhere('state', 'like', "%{$location}%")
                ->orWhere('country', 'like', "%{$location}%")
                ->orWhere('service_area', 'like', "%{$location}%");
        });
    }

    $artisans = $query->latest()->get();

    return view('artisans.search', compact('artisans', 'service', 'location'));
})->name('artisans.search');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

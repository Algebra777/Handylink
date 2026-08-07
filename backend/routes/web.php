<?php

use App\Http\Controllers\ScreenController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ScreenController::class, 'show'])->defaults('screen', 'home');
Route::get('/find-artisans', [ScreenController::class, 'show'])->defaults('screen', 'find-artisans');
Route::get('/booking-select-service', [ScreenController::class, 'show'])->defaults('screen', 'booking-select-service');

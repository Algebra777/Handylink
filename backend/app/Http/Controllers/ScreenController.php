<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ScreenController extends Controller
{
    public function show(Request $request, string $screen = 'home'): View
    {
        $screenPath = match ($screen) {
            'home' => base_path('../handylink_home_1/code.html'),
            'find-artisans' => base_path('../find_artisans/code.html'),
            'booking-select-service' => base_path('../booking_select_service/code.html'),
            default => base_path('../handylink_home_1/code.html'),
        };

        if (! file_exists($screenPath)) {
            abort(404);
        }

        return view('screen', ['screenPath' => $screenPath]);
    }
}

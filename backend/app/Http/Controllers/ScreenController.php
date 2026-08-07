<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ScreenController extends Controller
{
    public function show(Request $request, string $screen = 'home')
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

        $authBanner = '';

        if ($screen === 'home') {
            $authBanner = <<<HTML
<div class="flex justify-end gap-2 border-b border-slate-200 bg-white/95 px-4 py-3 backdrop-blur">
    <a href="/login" class="rounded-full border border-slate-300 px-3 py-1.5 text-sm font-medium text-slate-700 transition hover:border-blue-600 hover:text-blue-600">Sign in</a>
    <a href="/register" class="rounded-full bg-blue-600 px-3 py-1.5 text-sm font-medium text-white transition hover:bg-blue-700">Create account</a>
</div>
HTML;
        }

        return view('screen', ['screenPath' => $screenPath, 'authBanner' => $authBanner]);
    }
}

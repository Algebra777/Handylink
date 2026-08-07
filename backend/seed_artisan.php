<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$user = DB::table('users')->first();
if ($user) {
    DB::table('artisans')->insert([
        'user_id' => $user->id,
        'business_name' => 'Test Artisan',
        'description' => 'Plumbing specialist',
        'hourly_rate' => 25,
        'city' => 'Manchester',
        'state' => 'Greater Manchester',
        'country' => 'UK',
        'service_area' => 'Manchester',
        'is_verified' => true,
        'is_available' => true,
        'rating' => 5,
        'review_count' => 10,
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    echo "inserted\n";
} else {
    echo "no-user\n";
}

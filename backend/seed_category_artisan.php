<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$category = DB::table('categories')->where('slug', 'plumbing')->first();
if (!$category) {
    $categoryId = DB::table('categories')->insertGetId([
        'name' => 'Plumbing',
        'slug' => 'plumbing',
        'description' => 'Plumbing services',
        'is_active' => true,
        'created_at' => now(),
        'updated_at' => now(),
    ]);
} else {
    $categoryId = $category->id;
}

$userId = DB::table('users')->where('email', 'test@example.com')->value('id');
if ($userId) {
    DB::table('artisans')->insert([
        'user_id' => $userId,
        'business_name' => 'Test Artisan',
        'category_id' => $categoryId,
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
    echo "ok\n";
} else {
    echo "no-user\n";
}

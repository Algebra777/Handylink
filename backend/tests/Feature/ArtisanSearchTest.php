<?php

use App\Models\Artisan;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Artisan as ArtisanCommand;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('returns artisans matching the service and location search', function () {
    ArtisanCommand::call('migrate', ['--path' => 'database/migrations/2026_08_07_203931_add_missing_artisan_columns_to_existing_table.php']);

    $category = Category::create([
        'name' => 'Plumbing',
        'slug' => 'plumbing',
    ]);

    $user = User::factory()->create();

    Artisan::create([
        'user_id' => $user->id,
        'business_name' => 'Rapid Pipe Co.',
        'category_id' => $category->id,
        'description' => 'Fast plumbing repairs',
        'hourly_rate' => 65.00,
        'city' => 'Manchester',
        'state' => 'Greater Manchester',
        'country' => 'UK',
        'service_area' => 'Manchester',
        'is_verified' => true,
        'rating' => 5,
        'review_count' => 12,
    ]);

    $response = $this->get('/artisans/search?service=plumbing&location=manchester');

    $response->assertStatus(200);
    $response->assertSee('Rapid Pipe Co.');
    $response->assertSee('Manchester');
});

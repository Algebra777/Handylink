<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artisan extends Model
{
    /** @use HasFactory<\Database\Factories\ArtisanFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'business_name',
        'category_id',
        'description',
        'hourly_rate',
        'city',
        'state',
        'country',
        'service_area',
        'is_verified',
        'is_available',
        'rating',
        'review_count',
        'cover_image_path',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

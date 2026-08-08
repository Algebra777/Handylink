<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'customer_id',
        'artisan_id',
        'service_name',
        'service_category',
        'price',
        'scheduled_date',
        'scheduled_time',
        'location',
        'notes',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function artisan()
    {
        return $this->belongsTo(User::class, 'artisan_id');
    }
}

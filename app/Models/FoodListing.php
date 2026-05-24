<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodListing extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id', 'category_id', 'title', 'description',
        'quantity', 'price', 'pickup_location', 'expiry_time',
        'image', 'status',
    ];

    protected $casts = [
        'expiry_time' => 'datetime',
        'price' => 'decimal:2',
    ];

    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'listing_id');
    }
}

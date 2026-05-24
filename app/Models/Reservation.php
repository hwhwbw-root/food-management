<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['listing_id', 'buyer_id', 'status', 'reserved_at'];

    protected $casts = [
        'reserved_at' => 'datetime',
    ];

    public function listing()
    {
        return $this->belongsTo(FoodListing::class, 'listing_id');
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'rental_id',
        'amount',
        'payment_method',
        'paid_at',
    ];

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }
}
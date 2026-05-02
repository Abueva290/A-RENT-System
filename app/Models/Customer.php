<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'full_name',
        'contact_number',
        'address',
        'driver_license_number',
    ];

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}
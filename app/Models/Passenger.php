<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Passenger extends Model
{
    protected $fillable = [
        'passenger_passport',
        'passenger_name',
    ];

    public function setPassengerPassportAttribute($value): void
    {
        $this->attributes['passenger_passport'] =
            strtoupper(trim($value));
    }

    public function baggageItems(): HasMany
    {
        return $this->hasMany(BaggageItem::class);
    }
}
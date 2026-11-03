<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Flight extends Model
{
    protected $fillable = ['flight_code'];

    public function baggageItems(): HasMany
    {
        return $this->hasMany(BaggageItem::class);
    }
}
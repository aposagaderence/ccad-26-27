<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BaggageItem extends Model
{
    protected $fillable = [
        'passenger_id',
        'flight_id',
        'bag_tag_number',
        'bag_weight_kg',
        'heavy_cargo',
    ];

    protected function casts(): array
    {
        return [
            'bag_weight_kg' => 'decimal:2',
            'heavy_cargo' => 'boolean',
        ];
    }

    public function passenger(): BelongsTo
    {
        return $this->belongsTo(Passenger::class);
    }

    public function flight(): BelongsTo
    {
        return $this->belongsTo(Flight::class);
    }

    public function screeningLogs(): HasMany
    {
        return $this->hasMany(ScreeningLog::class);
    }
}
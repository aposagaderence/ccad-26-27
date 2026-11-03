<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScreeningLog extends Model
{
    protected $fillable = [
        'baggage_item_id',
        'screening_gate_id',
        'screener_officer',
        'screening_result',
        'flagged_reason',
        'clearance_status',
    ];

    public function baggageItem(): BelongsTo
    {
        return $this->belongsTo(BaggageItem::class);
    }

    public function screeningGate(): BelongsTo
    {
        return $this->belongsTo(ScreeningGate::class);
    }
}

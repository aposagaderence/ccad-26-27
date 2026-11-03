<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ScreeningGate extends Model
{
    protected $fillable = ['gate_code'];

    public function screeningLogs(): HasMany
    {
        return $this->hasMany(ScreeningLog::class);
    }
}
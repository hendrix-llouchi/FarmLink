<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Verification extends Model
{
    protected $fillable = [
        'order_id',
        'driver_id',
        'claimed_quantity',
        'actual_quantity',
        'claimed_grade',
        'actual_grade',
        'grade_match',
        'freshness_match',
        'damage_note',
        'heavy_spoilage',
        'packaging_ok',
        'pickup_photos',
        'outcome',
        'notes',
    ];

    protected $casts = [
        'grade_match' => 'boolean',
        'freshness_match' => 'boolean',
        'heavy_spoilage' => 'boolean',
        'packaging_ok' => 'boolean',
        'pickup_photos' => 'array',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}

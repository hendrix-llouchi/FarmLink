<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'buyer_id',
        'product_id',
        'driver_id',
        'quantity_ordered',
        'total_price',
        'status',
        'transport_requested',
        'estimated_transport_cost',
        'payment_status',
        'delivery_address',
        'disputed_reason',
        'disputed_notes',
        'disputed_at',
        'dispute_photo_path',
        'dispute_status',
        'dispute_resolution',
        'dispute_resolution_reason',
        'dispute_resolved_at',
        'verification_status',
        'workflow_status',
        'dispatch_code',
        'adjusted_price',
        'delivery_photo_path',
        'arrived_at',
        'buyer_confirmed_at',
        'flag_decision',
        'flag_decided_at',
        'flag_driver_decision_at',
        'flag_deadline_at',
        'flag_buyer_confirmed_at',
        'handover_confirmed_at',
    ];

    protected $hidden = ['dispatch_code'];

    protected $casts = [
        'arrived_at' => 'datetime',
        'buyer_confirmed_at' => 'datetime',
        'flag_decided_at' => 'datetime',
        'flag_driver_decision_at' => 'datetime',
        'flag_deadline_at' => 'datetime',
        'flag_buyer_confirmed_at' => 'datetime',
        'handover_confirmed_at' => 'datetime',
        'dispute_resolved_at' => 'datetime',
    ];

    /**
     * Get the buyer who placed the order.
     */
    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    /**
     * Get the product being ordered.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the driver assigned to the order.
     */
    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    /**
     * Get the ratings for the order.
     */
    public function ratings(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Rating::class);
    }

    /**
     * Get the buyer's rating for the order.
     */
    public function buyerRating(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Rating::class)->where('rater_id', $this->buyer_id);
    }

    public function verification(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Verification::class);
    }

    public function events(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(OrderEvent::class)->latest();
    }
}

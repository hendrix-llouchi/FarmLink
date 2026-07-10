<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'category',
        'quantity',
        'price',
        'image_path',
    ];

    /**
     * Get the user (farmer) that owns the product.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the orders placed for this product.
     */
    public function orders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get the product's image path, optimized with Cloudinary format/quality/resize transformations on the fly.
     *
     * @param  string  $value
     * @return string
     */
    public function getImagePathAttribute($value)
    {
        if ($value && str_contains($value, 'res.cloudinary.com')) {
            if (str_contains($value, '/upload/')) {
                return str_replace('/upload/', '/upload/f_auto,q_auto,w_600,c_limit/', $value);
            }
        }
        return $value;
    }
}

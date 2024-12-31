<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category',
        'price',
        'discount_price',
        'description',
        'badge',
        'badge_color',
        'free_shipping',
        'image',
        'stock',
        'features',
        'specifications',
        'seller_id'
    ];

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    protected $casts = [
        'price' => 'decimal:2',
        'rating' => 'float',
        'free_shipping' => 'boolean',
        'features' => 'array',
        'specifications' => 'array'
    ];
}
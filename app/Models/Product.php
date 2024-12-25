<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category',
        'price',
        'rating',
        'reviews_count',
        'description',
        'badge',
        'badge_color',
        'free_shipping',
        'image',
        'stock',
        'features',
        'specifications'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'rating' => 'float',
        'free_shipping' => 'boolean',
        'features' => 'array',
        'specifications' => 'array'
    ];
}
<?php
// app/Models/Product.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'category_id',
        'stock',
        'featured',
        'sku'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class)->withPivot('quantity');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot(['quantity', 'price']);
    }
}
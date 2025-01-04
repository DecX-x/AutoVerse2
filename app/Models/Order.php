<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $with = ['orderItems.product']; // Always load relationships

    protected $fillable = [
        'user_id',
        'order_id',
        'total_amount',
        'shipping_address',
        'payment_method',
        'status',
        'payment_status'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function products()
    {
        return $this->hasManyThrough(Product::class, OrderItem::class);
    }
}
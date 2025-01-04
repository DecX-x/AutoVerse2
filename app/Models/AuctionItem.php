<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AuctionItem extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'starting_bid',
        'current_bid',
        'bid_increment',
        'starts_at',
        'ends_at',
        'status',
        'seller_id'
    ];

    protected $casts = [
        'ends_at' => 'datetime',
        'starts_at' => 'datetime'
    ];

    public function bids()
    {
        return $this->hasMany(AuctionBid::class, 'auction_item_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
}
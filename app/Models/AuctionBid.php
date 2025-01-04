<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuctionBid extends Model
{
    protected $fillable = [
        'auction_item_id',
        'user_id',
        'bid_amount',
        'is_winner'
    ];

    public function auctionItem()
    {
        return $this->belongsTo(AuctionItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
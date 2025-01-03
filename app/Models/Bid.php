<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AuctionItem;

class Bid extends Model
{
    use HasFactory;

    protected $fillable = [
        'auction_item_id',
        'user_id',
        'amount',
    ];

    public function auctionItem()
    {
        return $this->belongsTo(AuctionItem::class);
    }
}

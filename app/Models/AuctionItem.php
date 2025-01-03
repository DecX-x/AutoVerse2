<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuctionItem extends Model
{
    use HasFactory;
    protected $table = 'auction_items';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'image',
        'description',
        'starting_bid',
        'current_bid',
        'bid_increment',
        'starts_at',
        'ends_at',
        'status',
    ];
    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];
}

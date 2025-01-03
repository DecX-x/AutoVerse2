<?php

namespace App\Http\Controllers;

use App\Models\AuctionItem;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class AuctionController extends Controller
{
    public function index()
    {
        // Mendapatkan data auction items yang statusnya open dan belum berakhir
        $auction_items = AuctionItem::where('status', 'open')
            ->where('ends_at', '>', now())
            ->orderBy('ends_at', 'asc')
            ->get();

        // Mengirim variabel auction_items ke view
        return view('auction', compact('auction_items'));
    }
}

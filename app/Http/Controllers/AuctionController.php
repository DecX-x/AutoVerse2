<?php

namespace App\Http\Controllers;

use App\Models\AuctionItem;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\AuctionBid;

class AuctionController extends Controller
{
    public function index()
    {
        $auction_items = AuctionItem::where('status', 'open')
            ->where('ends_at', '>', now())
            ->orderBy('ends_at', 'asc')
            ->get();

        // Check and close expired auctions
        AuctionItem::where('status', 'open')
            ->where('ends_at', '<', now())
            ->each(function($item) {
                $this->determineWinner($item);
            });

        return view('products.auction', compact('auction_items'));
    }

    public function show($id)
    {
        $item = AuctionItem::with(['bids.user'])->findOrFail($id);
        
        // Check if auction ended
        if ($item->ends_at < now() && $item->status == 'open') {
            $this->determineWinner($item);
            return redirect()->back()->with('info', 'Auction has ended');
        }
    
        $bids = $item->bids()
            ->with('user')
            ->orderBy('bid_amount', 'desc')
            ->get();

        $winner = $item->bids()
            ->where('is_winner', true)
            ->with('user')
            ->first();

        $timeLeft = $item->ends_at > now() 
            ? $item->ends_at->diffForHumans() 
            : 'Auction ended';
    
        return view('products.auction-show', compact('item', 'bids', 'winner', 'timeLeft'));
    }
    
    public function placeBid(Request $request, $id)
    {
        $item = AuctionItem::findOrFail($id);
    
        if ($item->ends_at < now()) {
            return back()->with('error', 'Auction has ended');
        }
    
        $minBid = $item->current_bid 
            ? $item->current_bid + $item->bid_increment 
            : $item->starting_bid;
    
        $request->validate([
            'bid_amount' => "required|numeric|min:$minBid"
        ]);
    
        $bid = new AuctionBid([
            'user_id' => auth()->id(),
            'auction_item_id' => $item->id,
            'bid_amount' => $request->bid_amount
        ]);
    
        $item->bids()->save($bid);
        $item->current_bid = $request->bid_amount;
        $item->save();
    
        return redirect()->back()->with('success', 'Bid placed successfully!');
    }
    
    private function determineWinner(AuctionItem $item)
    {
        $winningBid = $item->bids()
            ->orderBy('bid_amount', 'desc')
            ->first();
    
        if ($winningBid) {
            $winningBid->is_winner = true;
            $winningBid->save();
        }
    
        $item->status = 'closed';
        $item->save();
    }
}

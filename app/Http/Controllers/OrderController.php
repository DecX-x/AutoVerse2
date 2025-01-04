<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
{
    $orders = Order::where('user_id', Auth::id())
        ->with(['orderItems.product']) // Eager load relationships
        ->orderBy('created_at', 'desc')
        ->get();

    // Debug check
    foreach ($orders as $order) {
        if (!$order->orderItems->count()) {
            \Log::warning("Order {$order->order_id} has no items");
        }
    }

    return view('orders', compact('orders'));
}

        public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            
            $cartItems = Cart::where('user_id', Auth::id())
                            ->with('product')
                            ->get();
            
            if ($cartItems->isEmpty()) {
                throw new \Exception('Cart is empty');
            }
    
            $total = $cartItems->sum(function($item) {
                return $item->quantity * ($item->product->discount_price ?? $item->product->price);
            });
    
            // Create order with success status
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_id' => 'ORD-' . time() . '-' . Auth::id(),
                'total_amount' => $total,
                'status' => 'completed', // Changed from pending to completed
                'payment_method' => 'midtrans',
                'payment_status' => 'success', // Changed from pending to success
                'shipping_address' => Auth::user()->address
            ]);
    
            // Group cart items by seller
            $sellerTotals = [];
    
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->discount_price ?? $item->product->price
                ]);
    
                // Track seller revenues
                $sellerId = $item->product->seller_id;
                $itemTotal = $item->quantity * ($item->product->discount_price ?? $item->product->price);
                
                if (!isset($sellerTotals[$sellerId])) {
                    $sellerTotals[$sellerId] = [
                        'revenue' => 0,
                        'items_sold' => 0
                    ];
                }
                
                $sellerTotals[$sellerId]['revenue'] += $itemTotal;
                $sellerTotals[$sellerId]['items_sold'] += $item->quantity;
            }
    
            // Update seller stats
            foreach ($sellerTotals as $sellerId => $stats) {
                DB::table('sellers')
                    ->where('id', $sellerId)
                    ->update([
                        'total_revenue' => DB::raw('total_revenue + ' . $stats['revenue']),
                        'total_products_sold' => DB::raw('total_products_sold + ' . $stats['items_sold'])
                    ]);
            }
    
            Cart::where('user_id', Auth::id())->delete();
    
            DB::commit();
            return redirect()->route('orders')->with('success', 'Order placed successfully!');
    
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
    public function getStatusColorAttribute()
{
    return match ($this->status) {
        'completed' => 'success',
        'pending' => 'warning',
        'cancelled' => 'danger',
        default => 'secondary'
    };
}
}
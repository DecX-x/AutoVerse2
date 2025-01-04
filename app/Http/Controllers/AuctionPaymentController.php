<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\AuctionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Snap;

class AuctionPaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        Config::$is3ds = config('services.midtrans.is_3ds');
    }

    public function createPayment($id)
    {
        try {
            DB::beginTransaction();
            
            $auction = AuctionItem::findOrFail($id);
            $winner = $auction->bids()->where('user_id', Auth::id())
                            ->where('is_winner', true)
                            ->firstOrFail();

            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_id' => 'AUC-' . date('YmdHis') . '-' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT),
                'total_amount' => $winner->bid_amount,
                'status' => 'completed',
                'payment_method' => 'midtrans',
                'payment_status' => 'success',
                'shipping_address' => Auth::user()->address
            ]);

            // Create order item
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $auction->id, // Using auction item as product
                'quantity' => 1,
                'price' => $winner->bid_amount
            ]);

            // Update seller stats
            DB::table('sellers')
                ->where('id', $auction->seller_id)
                ->update([
                    'total_revenue' => DB::raw('total_revenue + ' . $winner->bid_amount),
                    'total_products_sold' => DB::raw('total_products_sold + 1')
                ]);

            // Create Midtrans payment params - same as cart
            $params = [
                'transaction_details' => [
                    'order_id' => $order->order_id,
                    'gross_amount' => (int)$winner->bid_amount,
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                ],
            ];

            $snapToken = Snap::getSnapToken($params);
            
            DB::commit();
            
            return response()->json([
                'snap_token' => $snapToken,
                'order_id' => $order->id
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        Config::$is3ds = config('services.midtrans.is_3ds');
    }

    public function createTransaction(Request $request)
    {
        try {
            DB::beginTransaction();
            
            $cart = Cart::where('user_id', Auth::id())->with('product')->get();
            if ($cart->isEmpty()) {
                throw new \Exception('Cart is empty');
            }
    
            $total = $cart->sum(function($item) {
                return $item->quantity * ($item->product->discount_price ?? $item->product->price);
            });
    
            // Create order with success status
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_id' => 'ORD-' . date('YmdHis') . '-' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT),
                'total_amount' => $total,
                'status' => 'completed', // Changed to completed
                'payment_method' => 'midtrans',
                'payment_status' => 'success', // Changed to success
                'shipping_address' => Auth::user()->address
            ]);
    
            // Track seller stats
            $sellerTotals = [];
    
            // Create order items and track seller stats
            foreach ($cart as $item) {
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
    
            // Keep Midtrans for display
            $params = [
                'transaction_details' => [
                    'order_id' => $order->order_id,
                    'gross_amount' => (int)$total,
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                ],
            ];
    
            $snapToken = Snap::getSnapToken($params);
            
            Cart::where('user_id', Auth::id())->delete();
            
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

    public function notificationHandler(Request $request)
{
    Log::info('Payment notification received', $request->all());

    try {
        $notification = new \Midtrans\Notification();
        
        Log::info('Notification data', [
            'order_id' => $notification->order_id,
            'transaction_status' => $notification->transaction_status,
            'payment_type' => $notification->payment_type,
            'fraud_status' => $notification->fraud_status ?? null
        ]);

        $order = Order::where('order_id', $notification->order_id)->firstOrFail();
        $transaction_status = $notification->transaction_status;
        $fraud = $notification->fraud_status;

        Log::info('Processing order', ['order_id' => $order->order_id]);

        if ($transaction_status == 'capture') {
            if ($fraud == 'challenge') {
                $order->status = 'pending';
                $order->payment_status = 'challenge';
            } else if ($fraud == 'accept') {
                $order->status = 'completed';
                $order->payment_status = 'paid';
            }
        } else if ($transaction_status == 'settlement') {
            $order->status = 'completed';
            $order->payment_status = 'paid';
        } else if ($transaction_status == 'cancel' || $transaction_status == 'deny' || $transaction_status == 'expire') {
            $order->status = 'failed';
            $order->payment_status = 'failed';
        } else if ($transaction_status == 'pending') {
            $order->status = 'pending';
            $order->payment_status = 'pending';
        }

        $order->save();
        
        Log::info('Order updated', [
            'order_id' => $order->order_id,
            'status' => $order->status,
            'payment_status' => $order->payment_status
        ]);

        return response()->json(['success' => true]);

    } catch (\Exception $e) {
        Log::error('Payment processing failed', ['error' => $e->getMessage()]);
        return response()->json(['message' => $e->getMessage()], 500);
    }
}
}
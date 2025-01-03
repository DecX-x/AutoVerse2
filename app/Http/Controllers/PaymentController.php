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
        $params = [
            'transaction_details' => [
                'order_id' => uniqid(), // Buat ID unik untuk transaksi
                'gross_amount' => $request->total, // Total pembayaran
            ],
            'customer_details' => [
                'first_name' => $request->user()->name ?? 'Guest',
                'email' => $request->user()->email ?? 'guest@example.com',
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function notificationHandler(Request $request)
    {
        $notification = new \Midtrans\Notification();

        $transaction = $notification->transaction_status;
        $orderId = $notification->order_id;

        if ($transaction == 'capture' || $transaction == 'settlement') {
            try {
                DB::beginTransaction();

                $cart = Cart::where('user_id', Auth::id())->with('items.product')->firstOrFail();

                $order = Order::create([
                    'user_id' => Auth::id(),
                    'order_id' => $orderId,
                    'total' => $cart->items->sum(function ($item) {
                        return ($item->product->discount_price ?? $item->product->price) * $item->quantity;
                    }),
                    'status' => 'completed'
                ]);

                foreach ($cart->items as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity,
                        'price' => $item->product->discount_price ?? $item->product->price,
                    ]);
                }

                $cart->items()->delete();
                $cart->delete();

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['message' => $e->getMessage()], 500);
            }
        }

        return response()->json(['message' => 'Notification handled']);
    }
}

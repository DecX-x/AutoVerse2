<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

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
            // Fix: Use Snap directly without ::
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
        $type = $notification->payment_type;
        $orderId = $notification->order_id;
        $fraud = $notification->fraud_status;

        // Handle the notification based on the transaction status
        if ($transaction == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    // Handle challenge status
                } else {
                    // Handle success status
                }
            }
        } else if ($transaction == 'settlement') {
            // Handle settlement status
        } else if ($transaction == 'pending') {
            // Handle pending status
        } else if ($transaction == 'deny') {
            // Handle deny status
        } else if ($transaction == 'expire') {
            // Handle expire status
        } else if ($transaction == 'cancel') {
            // Handle cancel status
        }

        return response()->json(['message' => 'Notification handled']);
    }
}

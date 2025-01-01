<?php
// app/Http/Controllers/OrderController.php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()
            ->with(['orderItems.product']) // Eager load relationships
            ->latest()
            ->get();
        return view('orders', compact('orders'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            
            // Create order from cart
            $cart = Cart::where('user_id', Auth::id())->with('items')->firstOrFail();
            
            $order = Order::create([
                'user_id' => Auth::id(), // Mendapatkan ID pengguna yang sedang login
                'order_id' => 'ORD-' . now()->timestamp, // Gunakan timestamp yang lebih eksplisit
                'total' => $cart->items->sum(function ($item) {
                    // Periksa apakah product memiliki harga diskon, jika tidak gunakan harga normal
                    $price = $item->product->discount_price ?? $item->product->price;
                    return $price * $item->quantity; // Hitung subtotal untuk setiap item
                }),
                'status' => 'pending' // Set status awal sebagai pending
            ]);
            // Clear cart
            $cart->items()->delete();
            $cart->delete();

            DB::commit();
            return redirect()->route('orders')->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to place order. Please try again.');
        }
    }
}
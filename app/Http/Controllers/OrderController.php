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
        $orders = Order::where('user_id', Auth::id())
            ->with('products')
            ->latest()
            ->paginate(10);
            
        return view('orders.index', compact('orders'));
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string',
            'payment_method' => 'required|in:credit_card,paypal'
        ]);

        try {
            DB::beginTransaction();

            $cart = Cart::where('user_id', Auth::id())->with('products')->firstOrFail();
            
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_amount' => $cart->products->sum('price'),
                'shipping_address' => $request->shipping_address,
                'payment_method' => $request->payment_method,
                'status' => 'pending'
            ]);

            // Transfer cart items to order
            foreach ($cart->products as $product) {
                $order->products()->attach($product->id, [
                    'quantity' => $product->pivot->quantity,
                    'price' => $product->price
                ]);
            }

            // Clear cart
            $cart->products()->detach();
            $cart->delete();

            DB::commit();

            return redirect()->route('orders.show', $order)
                ->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong!');
        }
    }
}
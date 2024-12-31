<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())
                        ->with('product')
                        ->get();
        
        $total = $cartItems->sum(function($item) {
            return $item->quantity * ($item->product->discount_price ?? $item->product->price);
        });

        return view('cart', compact('cartItems', 'total'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Cart::findOrFail($id);
        $cart->quantity = $request->quantity;
        $cart->save();

        return redirect()->back();
    }

    public function remove($id)
    {
        Cart::findOrFail($id)->delete();
        return redirect()->back();
    }
        
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);
    
        $product = Product::findOrFail($request->product_id);
        
        if($request->quantity > $product->stock) {
            return back()->with('error', 'Not enough stock available');
        }
    
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();
    
        if($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity
            ]);
        }
    
        return redirect()->back()->with('success', 'Product added to cart successfully');
    }
}
<?php
// app/Http/Controllers/CartController.php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', Auth::id())->with('products')->first();
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        
        $cart->products()->attach($request->product_id, [
            'quantity' => $request->quantity
        ]);

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $cart = Cart::where('user_id', Auth::id())->first();
        $cart->products()->detach($request->product_id);

        return redirect()->back()->with('success', 'Product removed from cart!');
    }
}
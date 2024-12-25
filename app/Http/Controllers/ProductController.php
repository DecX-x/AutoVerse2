<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB; // Removed unused import

class ProductController extends Controller
{
    private function formatPrice($price) {
        return 'Rp ' . number_format($price, 0, ',', '.');
    }

    public function index(Request $request)
    {
        $query = Product::query();

        // Apply filters
        if ($request->has('categories')) {
            $query->whereIn('category', $request->categories);
        }

        if ($request->has('price')) {
            $query->where(function($q) use ($request) {
                foreach($request->price as $range) {
                    list($min, $max) = explode('-', $range);
                    $q->orWhereBetween('price', [$min, $max]);
                }
            });
        }

        if ($request->has('rating')) {
            $query->whereIn(\Illuminate\Support\Facades\DB::raw('FLOOR(rating)'), $request->rating);
        }

        if ($request->has('shipping')) {
            $query->where('free_shipping', true);
        }

        $products = $query->get();

        $categories = ['All Categories', 'Brake System', 'Lighting', 'Engine Parts', 'Tools', 'Accessories'];
        
        return view('products.index', compact('products', 'categories'));
    }
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $product->formatted_price = $this->formatPrice($product->price);
        
        // Set empty arrays if null
        $product->specifications = $product->specifications ?? [];
        $product->features = $product->features ?? [];
        
        // Create images array if using single image
        $product->images = [$product->image];
        
        return view('products.show', compact('product'));
    }
}
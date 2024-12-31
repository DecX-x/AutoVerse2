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

    // Process image paths
    foreach($products as $product) {
        if ($product->image) {
            // Remove 'public/' from the beginning if it exists
            $product->image = str_replace('public/', '', $product->image);
            $product->image = asset($product->image);
        } else {
            $product->image = asset('assets/images/placeholder.jpg');
        }
    }

    $categories = ['All Categories','Cars','Motorcycle' ,'Brake System', 'Lighting', 'Engine Parts', 'Tools', 'Accessories', 'Wheels', 'Tires'];
    
    return view('products.index', compact('products', 'categories'));
}
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $product->formatted_price = $this->formatPrice($product->price);
        
        // Set empty arrays if null
        $product->specifications = $product->specifications ?? [];
        $product->features = $product->features ?? [];
        
        // Create images array with full path
        $imagePath = $product->image;
        if ($imagePath) {
            // Remove 'public/' from the beginning if it exists
            $imagePath = str_replace('public/', '', $imagePath);
            $product->images = [asset($imagePath)];
        } else {
            $product->images = [asset('assets/images/placeholder.jpg')];
        }
        
        return view('products.show', compact('product'));
    }
    // categories for the products
    public function categories()
    {
        $categories = ['Brake System', 'Lighting', 'Engine Parts', 'Tools', 'Accessories'];
        return view('products.categories', compact('categories'));
    }
    // ...existing code...

    public function search(Request $request)
    {
        $query = $request->input('query');
        
        // Search in multiple columns
        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->orWhere('category', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->get();
    
        // Process image paths
        foreach($products as $product) {
            if ($product->image) {
                // Remove 'public/' from the beginning if it exists
                $product->image = str_replace('public/', '', $product->image);
                $product->image = asset($product->image);
            } else {
                $product->image = asset('assets/images/placeholder.jpg');
            }
        }
    
        $categories = ['All Categories','Cars','Motorcycle' ,'Brake System', 'Lighting', 'Engine Parts', 'Tools', 'Accessories', 'Wheels', 'Tires'];
    
        return view('products.results', compact('products', 'categories', 'query'));
    }
}
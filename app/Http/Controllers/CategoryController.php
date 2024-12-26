<?php

namespace App\Http\Controllers;
use App\Models\Product;

class Category extends Controller
{
    public function category()
    {
        $featured_products = Product::latest()->take(4)->get();
        return view('products.categories', compact('featured_products'));
    }
}
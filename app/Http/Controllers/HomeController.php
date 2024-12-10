<?php
// app/Http/Controllers/HomeController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('featured', true)
            ->latest()
            ->take(4)
            ->get();
            
        return view('home', compact('featuredProducts'));
    }
}
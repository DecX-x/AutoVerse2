<?php

namespace App\Http\Controllers;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
    $featured_products = Product::first()->take(4)->get();
    $car_products = Product::where('category', 'Cars')->where('discount_price', '=', NULL)->get();
    $car_discount = Product::where('category', 'Cars')->where('discount_price', '>', 0)->get();

    return view('home', [
        'featured_products' => $featured_products,
        'car_products' => $car_products,
        'car_discount' => $car_discount
    ]);

        
    }
}
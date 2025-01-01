<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch featured products
        $featured_products = Product::query()->take(4)->get();

        // Fetch car products without discount
        $car_products = Product::where('category', 'Cars')
            ->where('discount_price', '=', NULL)
            ->get();

        // Fetch car products with discount
        $car_discount = Product::where('category', 'Cars')
            ->where('discount_price', '>', 0)
            ->get();

        // Process image paths
        $products = collect([$featured_products, $car_products, $car_discount])->flatten();
        foreach ($products as $product) {
            if ($product->image) {
                $product->image = asset($product->image);
            } else {
                $product->image = asset('assets/images/placeholder.jpg');
            }
        }

        return view('home', [
            'featured_products' => $featured_products,
            'car_products' => $car_products,
            'car_discount' => $car_discount,
        ]);
    }
}

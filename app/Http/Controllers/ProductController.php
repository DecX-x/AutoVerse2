<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id)
    {
        // For now, return static data
        // Later, you can fetch from database
        $product = [
            'id' => $id,
            'name' => 'Premium Brake Pads',
            'price' => 1800000, // Changed to Rupiah
            'rating' => 4.5,
            'reviews_count' => 24,
            'description' => 'High-performance brake pads designed for maximum stopping power and durability. Features advanced ceramic compound for reduced brake dust and noise.',
            'features' => [
                'Premium ceramic compound',
                'Reduced brake dust',
                'Low noise operation',
                'Extended pad life',
                'Enhanced stopping power'
            ],
            'specifications' => [
                'Material' => 'Ceramic Compound',
                'Position' => 'Front',
                'Warranty' => '2 Years',
                'Fitment' => 'Direct OEM Replacement',
                'Weight' => '4.5 lbs'
            ],
            'stock' => 15,
            'images' => [
                'https://placehold.co/600x400',
                'https://placehold.co/600x400',
                'https://placehold.co/600x400',
                'https://placehold.co/600x400'
            ]
        ];

        // Format price to Indonesian Rupiah
        $product['formatted_price'] = 'Rp ' . number_format($product['price'], 0, ',', '.');

        return view('products.show', compact('product'));
    }
}
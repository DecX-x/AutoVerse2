<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    private function formatPrice($price) {
        return 'Rp ' . number_format($price, 0, ',', '.');
    }

    private function getProducts() {
        return [
            [
                'id' => 1,
                'category' => 'Brake System',
                'name' => 'Premium Brake Pads',
                'price' => 1800000,
                'rating' => 4.5,
                'reviews_count' => 24,
                'description' => 'High-performance brake pads designed for maximum stopping power and durability.',
                'badge' => 'New',
                'badge_color' => 'primary',
                'free_shipping' => true,
                'image' => 'https://placehold.co/600x400'
            ],
            [
                'id' => 2,
                'name' => 'LED Headlight Kit',
                'price' => 2400000,
                'rating' => 5.0,
                'reviews_count' => 156,
                'description' => 'Ultra-bright LED headlight kit with extended lifespan.',
                'free_shipping' => true,
                'image' => 'https://placehold.co/600x400'
            ],
            [
                'id' => 3,
                'name' => 'Performance Air Filter',
                'price' => 750000,
                'rating' => 4.0,
                'reviews_count' => 42,
                'description' => 'High-flow air filter for improved engine performance.',
                'badge' => 'Sale',
                'badge_color' => 'danger',
                'free_shipping' => false,
                'image' => 'https://placehold.co/600x400'
            ],
            [
                'id' => 4,
                'name' => 'Professional Tool Set',
                'price' => 4250000,
                'rating' => 4.5,
                'reviews_count' => 89,
                'description' => 'Complete professional-grade automotive tool set.',
                'free_shipping' => true,
                'image' => 'https://placehold.co/600x400'
            ]
        ];
    }
    public function index()
    {
        $products = $this->getProducts();   
        foreach($products as &$product) {
            $product['formatted_price'] = $this->formatPrice($product['price']);
        }

        $categories = ['All Categories', 'Brake System', 'Lighting', 'Engine Parts', 'Tools', 'Accessories'];
        
        return view('products.index', compact('products', 'categories'));
    }

   
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
                'categories' => 'Accessories',
                'Material' => '',
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
        $product['formatted_price'] = $this->formatPrice($product['price']);
        return view('products.show', compact('product'));
    }
}
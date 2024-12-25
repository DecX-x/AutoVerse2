<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'Premium Brake Pads',
                'category' => 'Brake System',
                'price' => 1800000,
                'rating' => 4.5,
                'reviews_count' => 24,
                'description' => 'High-performance brake pads designed for maximum stopping power and durability.',
                'badge' => 'New',
                'badge_color' => 'primary',
                'free_shipping' => true,
                'image' => 'https://placehold.co/600x400',
                'stock' => 15,
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
                ]
            ],
            [
                'name' => 'LED Headlight Kit',
                'category' => 'Lighting',
                'price' => 2400000,
                'rating' => 5.0,
                'reviews_count' => 156,
                'description' => 'Ultra-bright LED headlight kit with extended lifespan.',
                'free_shipping' => true,
                'image' => 'https://placehold.co/600x400',
                'stock' => 20,
                'features' => [
                    'Ultra-bright LED',
                    'Extended lifespan',
                    'Easy installation',
                    'Weather-resistant'
                ],
                'specifications' => [
                    'Type' => 'LED',
                    'Wattage' => '55W',
                    'Lumens' => '10000LM',
                    'Color Temperature' => '6000K'
                ]
            ],
            // Add more products...
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CuciGudangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Porsche Carrera GT',
                'category' => 'Cars',
                'price' => 33000000,
                
                'reviews_count' => 98,
                'description' => 'Durable all-weather tires for safe and comfortable driving in all conditions.',
                'badge' => 'Hot',
                'badge_color' => 'danger',
                'free_shipping' => false,
                'image' => 'https://placehold.co/600x400',
                'stock' => 10,
                'features' => [
                    'Superior grip in wet and dry conditions',
                    'All-season performance',
                    'Low road noise',
                    'Enhanced durability'
                ],
                'specifications' => [
                    'Size' => '225/50R17',
                    'Load Index' => '94',
                    'Speed Rating' => 'V',
                    'Tread Depth' => '10/32"',
                    'Weight' => '12.5 kg'
                ]
            ],
            [
                'name' => 'Luxury Seat Covers',
                'category' => 'Interior Accessories',
                'price' => 1200000,
                'rating' => 4.6,
                'reviews_count' => 56,
                'description' => 'High-quality seat covers to enhance the look and comfort of your car interior.',
                'badge' => 'Trending',
                'badge_color' => 'success',
                'free_shipping' => true,
                'image' => 'https://placehold.co/600x400',
                'stock' => 25,
                'features' => [
                    'Premium fabric material',
                    'Easy to install',
                    'Water-resistant',
                    'Customizable fit'
                ],
                'specifications' => [
                    'Material' => 'Fabric',
                    'Fitment' => 'Universal',
                    'Color Options' => 'Black, Beige, Gray',
                    'Warranty' => '1 Year'
                ]
            ]
        ];
        foreach ($products as $product) {
            Product::create($product);
        }
    }
}

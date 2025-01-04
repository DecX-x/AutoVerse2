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
                'name' => 'Lamborghini Revuelto',
                'category' => 'Cars',
                'price' => 1000000,
                'stock' => 5,
                'image' => 'assets/images/1/product.jpg',
                'description' => 'The Rolex Submariner Date is a luxury dive watch that features a 41mm stainless steel case, a black dial with luminescent hour markers, and a unidirectional rotating bezel. It is powered by a self-winding mechanical movement and has a water resistance of 300 meters.',
                'badge' => 'Sale',
                'badge_color' => 'danger',
                'free_shipping' => true,
                'features' => [
                    'Luxury design',
                    'Dive watch functionality',
                    'Stainless steel case',
                    'Self-winding movement',
                ],
                'specifications' => [
                    'Engine' => '6.5L V12',
                    'Horse-power ' => '759 hp',
                    'Torque' => '531 lb-ft',
                    '0-60 mph' => '2.8 seconds',
                    'Top Speed' => '220 mph',
                ]
            ],
            [
                'name' => 'Pagani Utopia',
                'category' => 'Cars',
                'price' => 3000000,
                'stock' => 5,
                'image' => 'assets/images/2/product.jpg',
                'description' => 'The Pagani Utopia is a limited-edition hypercar that features a 6.0L V12 engine, a top speed of 230 mph, and a 0-60 mph time of 2.5 seconds. It is available in four finishes: Rosso Mars, Bianco Monocerus, Grigio Nimbus, and Nero Aldebaran.',
                'badge' => 'Hot',
                'badge_color' => 'danger',
                'free_shipping' => true,
                'features' => [
                    'Limited-edition design',
                    '6.0L V12 engine',
                    'Top speed of 230 mph',
                    '0-60 mph time of 2.5 seconds',
                ],
                'specifications' => [
                    'Engine' => '6.0L V12',
                    'Horsepower' => '789 hp',
                    'Torque' => '538 lb-ft',
                    '0-60 mph' => '2.5 seconds',
                    'Top Speed' => '230 mph',
                ]
            
                ],
                [
                    'name' => 'Mclaren Speedtail',
                    'category' => 'Cars',
                    'price' => 2500000,
                    'stock' => 5,
                    'image' => 'assets/images/3/product.jpg',
                    'description' => 'The McLaren Speedtail is a limited-edition hypercar that features a 4.0L V8 engine, a top speed of 250 mph, and a 0-60 mph time of 2.5 seconds. It is available in four finishes: Rosso Mars, Bianco Monocerus, Grigio Nimbus, and Nero Aldebaran.',
                    'badge' => 'Hot',
                    'badge_color' => 'danger',
                    'free_shipping' => true,
                    'features' => [
                        'Limited-edition design',
                        '4.0L V8 engine',
                        'Top speed of 250 mph',
                        '0-60 mph time of 2.5 seconds',
                    ],
                    'specifications' => [
                        'Engine' => '4.0L V8',
                        'Horsepower' => '789 hp',
                        'Torque' => '538 lb-ft',
                        '0-60 mph' => '2.5 seconds',
                        'Top Speed' => '250 mph',
                    ]
                    ],
                    [
                        'name' => 'Mercedes Benz Slr Mclaren',
                        'category' => 'Cars',
                        'stock' => 5,
                        'price' => 2000000,
                        'image' => 'assets/images/4/product.jpg',
                        'description' => 'The Mercedes-Benz SLR McLaren is a limited-edition hypercar that features a 5.4L V8 engine, a top speed of 220 mph, and a 0-60 mph time of 3.8 seconds. It is available in four finishes: Rosso Mars, Bianco Monocerus, Grigio Nimbus, and Nero Aldebaran.',
                        'badge' => 'New',
                        'badge_color' => 'primary',
                        'free_shipping' => true,
                        'features' => [
                            'Limited-edition design',
                            '5.4L V8 engine',
                            'Top speed of 220 mph',
                            '0-60 mph time of 3.8 seconds',
                        ],
                        'specifications' => [
                            'Engine' => '5.4L V8',
                            'Horsepower' => '789 hp',
                            'Torque' => '538 lb-ft',
                            '0-60 mph' => '3.8 seconds',
                            'Top Speed' => '220 mph',
                        ]
                        ],
                       [
                        'name' => 'Mercedes Benz Sls Amg',
                        'category' => 'Cars',
                        'price' => 1500000,
                        'image' => 'assets/images/5/product.jpg',
                        'description' => 'The Mercedes-Benz SLS AMG is a limited-edition hypercar that features a 6.2L V8 engine, a top speed of 220 mph, and a 0-60 mph time of 3.6 seconds. It is available in four finishes: Rosso Mars, Bianco Monocerus, Grigio Nimbus, and Nero Aldebaran.',
                        'badge' => 'New',
                        'stock' => 5,
                        'badge_color' => 'primary',
                        'discount_price' => 1000000,
                        'free_shipping' => true,
                        'features' => [
                            'Limited-edition design',
                            '6.2L V8 engine',
                            'Top speed of 220 mph',
                            '0-60 mph time of 3.6 seconds',
                        ],
                        'specifications' => [
                            'Engine' => '6.2L V8',
                            'Horsepower' => '789 hp',
                            'Torque' => '538 lb-ft',
                            '0-60 mph' => '3.6 seconds',
                            'Top Speed' => '220 mph',
                        ]

                       ]
                
    ];

        // Insert each product into the database
        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
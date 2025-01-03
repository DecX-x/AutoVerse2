<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\AuctionItem;
use Illuminate\Database\Seeder;

class AuctionItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AuctionItem::create([
            'name' => 'Engine V8',
            'image' => 'assets\images\auction\1\product.jpg',
            'description' => 'The Engine V8 is a powerful engine that features a 5.0L V8 engine, a top speed of 200 mph, and a 0-60 mph time of 3.5 seconds. It is available in four finishes: Rosso Mars, Bianco Monocerus, Grigio Nimbus, and Nero Aldebaran.',
            'starting_bid' => 10000000,
            'current_bid' => 100,
            'bid_increment' => 10,
            'starts_at' => now(),
            'ends_at' => now()->addDays(7),
            'status' => 'open',
        ]);
    }
}

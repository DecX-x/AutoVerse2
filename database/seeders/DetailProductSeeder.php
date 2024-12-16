<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DetailProduct;

class DetailProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     DetailProduct::create([
        'name' => 'All new Toyota 86 2016',
        'brand' => 'Toyota',
        'year' => '2016',
        'seller_type' => 'Dealer',
        'model' => '86',
        'mileage' => '25.000 - 50.000 km',
        'description' => 'Mobil sport Toyota 86 2016',
        'price' => 'Rp 500.000.000'
     ]);   
    }
}

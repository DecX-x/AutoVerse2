<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailProduct extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'brand',
        'year',
        'seller_type',
        'model',
        'mileage',
        'description',
        'price'
    ];
}

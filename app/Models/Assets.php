<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assets extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang',
        'review',
        'harga',
        'shipping'

    ];
}

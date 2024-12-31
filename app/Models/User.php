<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image',
        'address',
        'seller',
        'admin'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return $this->admin === 'true';
    }

    public function isPendingSeller()
    {
        return $this->seller === 'pending';
    }

    public function createSellerProfile()
    {
        if ($this->seller === 'approved' && !$this->seller()->exists()) {
            return $this->seller()->create([
                'total_revenue' => 0,
                'total_products_sold' => 0
            ]);
        }
        return null;
    }
    public function seller()
    {
        return $this->hasOne(Seller::class);
    }

    public function getSellerProfile()
    {
        return $this->seller()->firstOrCreate([
            'user_id' => $this->id
        ], [
            'total_revenue' => 0,
            'total_products_sold' => 0
        ]);
    }
}
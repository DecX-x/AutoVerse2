<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;


class SellerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        
        if (!$user || $user->seller !== 'approved') {
            return redirect('/')->with('error', 'Unauthorized access');
        }

        if (!$user->seller()->exists()) {
            $user->createSellerProfile();
        }

        return $next($request);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;
use App\Models\AuctionItem;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function orders()
{
    return $this->hasMany(Order::class);
}

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }

    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);
        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    
    public function profile()
{
    $user = Auth::user();
    $recentOrders = $user->orders()
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();

    // Add this section to fetch bids
    $recentBids = \App\Models\AuctionBid::where('user_id', $user->id)
        ->with('auctionItem')  // Eager load auction item details
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();

    return view('profile', compact('recentOrders', 'recentBids'));
}
    public function show(AuctionItem $auction)
{
    return view('auctions.show', compact('auction'));
}
    
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        $user = Auth::user();
        $user->name = $request->name;
        $user->save();
    
        return back()->with('success', 'Profile updated successfully');
    }
    
    public function updateProfilePhoto(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);
    
        if ($request->hasFile('profile_image')) {
            $user = Auth::user();
            
            // Delete old image if exists
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }
            
            $path = $request->file('profile_image')->store('profile-photos', 'public');
            $user->profile_image = $path;
            $user->save();
        }
    
        return back()->with('success', 'Profile photo updated successfully');
    }
    
    public function updateAddress(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:500'
        ]);
    
        $user = Auth::user();
        $user->address = $request->address;
        $user->save();
    
        return back()->with('success', 'Address updated successfully');
    }
    public function requestSeller(Request $request)
{
    $user = Auth::user();
    $user->seller = 'pending';
    $user->save();
    
    return back()->with('success', 'Seller request submitted successfully');
}

}
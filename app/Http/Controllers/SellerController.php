<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\AuctionItem;

class SellerController extends Controller
{
    public function __construct()
    {
        $this->middleware('seller');
    }

    private function getOrCreateSeller()
    {
        $user = Auth::user();
        $seller = Seller::where('user_id', $user->id)->first();
        
        if (!$seller) {
            $seller = Seller::create([
                'user_id' => $user->id,
                'total_revenue' => 0,
                'total_products_sold' => 0
            ]);
        }
        
        return $seller;
    }

    public function dashboard()
    {
        $seller = $this->getOrCreateSeller();
        $products = Product::where('seller_id', $seller->id)->get();
        $auctions = AuctionItem::where('seller_id', $seller->id)->get();
        
        return view('seller.dashboard', [
            'seller' => $seller,
            'products' => $products,
            'auctions' => $auctions,
            'totalProducts' => $products->count(),
            'totalRevenue' => $seller->total_revenue,
            'totalSold' => $seller->total_products_sold
        ]);
    }
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'category' => 'required|string',
        'price' => 'required|numeric|min:0',
        'discount_price' => 'nullable|numeric|min:0',
        'description' => 'required|string',
        'badge' => 'nullable|string',
        'badge_color' => 'nullable|string',
        'free_shipping' => 'nullable|boolean',
        'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'stock' => 'required|integer|min:0',
        'features' => 'nullable|array',
        'spec_keys' => 'nullable|array',
        'spec_values' => 'nullable|array',
    ]);

    $seller = $this->getOrCreateSeller();

    // Create product
    $product = new Product();
    $product->name = $validated['name'];
    $product->category = $validated['category'];
    $product->price = $validated['price'];
    $product->discount_price = $validated['discount_price'];
    $product->description = $validated['description'];
    $product->badge = $validated['badge'];
    $product->badge_color = $validated['badge_color'];
    $product->free_shipping = $request->has('free_shipping');
    $product->stock = $validated['stock'];
    $product->seller_id = $seller->id;

    if ($request->has('features')) {
        $features = array_values(array_filter($request->features));
        $product->features = $features; 
    }

    if ($request->has('spec_keys') && $request->has('spec_values')) {
        $specs = array_combine(
            array_filter($request->spec_keys),
            array_filter($request->spec_values)
        );
        $product->specifications = $specs; 
    }

    if ($request->hasFile('image')) {
        $extension = $request->file('image')->getClientOriginalExtension();
        $imageName = "product.{$extension}";
        
        $tempPath = $request->file('image')->storeAs('temp', $imageName, 'public');
        
        $product->image = ''; 
        $product->save();
        
        // Move to final location
        $finalDirectory = "assets/images/{$product->id}";
        $finalPath = "{$finalDirectory}/{$imageName}";
        
        Storage::disk('public')->makeDirectory($finalDirectory);
        Storage::disk('public')->move($tempPath, $finalPath);
        
        $product->image = $finalPath;
        $product->save();
    }

    return back()->with('success', 'Product added successfully');
}
public function update(Request $request, $id)
{
    $seller = $this->getOrCreateSeller();
    $product = Product::where('seller_id', $seller->id)->findOrFail($id);
    
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'category' => 'required|string',
        'price' => 'required|numeric',
        'discount_price' => 'nullable|numeric',
        'description' => 'required|string',
        'badge' => 'nullable|string',
        'badge_color' => 'nullable|string',
        'free_shipping' => 'nullable|boolean',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'stock' => 'required|integer|min:0',
        'features' => 'nullable|array',
        'spec_keys' => 'nullable|array',
        'spec_values' => 'nullable|array',
    ]);

    // Update basic fields
    $product->name = $validated['name'];
    $product->category = $validated['category'];
    $product->price = $validated['price'];
    $product->discount_price = $validated['discount_price'];
    $product->description = $validated['description'];
    $product->badge = $validated['badge'];
    $product->badge_color = $validated['badge_color'];
    $product->free_shipping = $request->has('free_shipping');
    $product->stock = $validated['stock'];

    // Update features
    if ($request->has('features')) {
        $features = array_values(array_filter($request->features));
        $product->features = $features;
    }

    // Update specifications
    if ($request->has('spec_keys') && $request->has('spec_values')) {
        $specs = array_combine(
            array_filter($request->spec_keys),
            array_filter($request->spec_values)
        );
        $product->specifications = $specs;
    }

    // Handle image update
    if ($request->hasFile('image')) {
        // Delete old image
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $extension = $request->file('image')->getClientOriginalExtension();
        $imageName = "product.{$extension}";
        
        // Store in product directory
        $finalDirectory = "assets/images/{$product->id}";
        Storage::disk('public')->makeDirectory($finalDirectory);
        
        $request->file('image')->storeAs("public/{$finalDirectory}", $imageName);
        $product->image = "{$finalDirectory}/{$imageName}";
    }

    $product->save();

    return back()->with('success', 'Product updated successfully');
}
    
    public function destroy($id)
    {
        try {
            $seller = $this->getOrCreateSeller();
            $product = Product::where('seller_id', $seller->id)
                             ->findOrFail($id);
    
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
    
            $product->delete();
    
            return back()->with('success', 'Product deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete product');
        }
    }
    public function storeAuction(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'starting_bid' => 'required|numeric|min:0',
            'bid_increment' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $seller = $this->getOrCreateSeller();

        $auction = new AuctionItem([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'starting_bid' => $validated['starting_bid'],
            'bid_increment' => $validated['bid_increment'],
            'starts_at' => now(),
            'ends_at' => now()->addHours($validated['duration']),
            'status' => 'open',
            'seller_id' => $seller->id
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('auctions', 'public');
            $auction->image = $path;
        }

        $auction->save();

        return back()->with('success', 'Auction created successfully');
    }
}
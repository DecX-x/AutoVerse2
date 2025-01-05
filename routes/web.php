<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\AuctionPaymentController;


// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/categories', [ProductController::class, 'categories'])->name('categories');
Route::get('/search', [ProductController::class, 'search'])->name('products.search');

Route::get('/assets/images/{path}', function($path) {
    $fullPath = storage_path('app/public/assets/images/' . $path);
    return response()->file($fullPath);
})->where('path', '.*');

Route::get('/assets/css/{path}', function ($path) {
    $fullPath = public_path('storage/app/public/assets/css/' . $path);
    return response()->file($fullPath);
})->where('path', '.*');

Route::get('/storage/{path}', function($path) {
    return response()->file(storage_path('app/public/' . $path));
})->where('path', '.*');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/seller/{id}/approve', [AdminController::class, 'approveSeller'])->name('admin.approve.seller');
    Route::post('/admin/seller/{id}/reject', [AdminController::class, 'rejectSeller'])->name('admin.reject.seller');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::put('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/photo', [AuthController::class, 'updateProfilePhoto'])->name('profile.update.photo');
    Route::put('/profile/address', [AuthController::class, 'updateAddress'])->name('profile.update.address');
});

Route::middleware(['auth', 'seller'])->group(function () {
    Route::get('/seller/dashboard', [SellerController::class, 'dashboard'])->name('seller.dashboard');
    Route::post('/seller/products', [SellerController::class, 'store'])->name('seller.products.store');
    Route::put('/seller/products/{id}', [SellerController::class, 'update'])->name('seller.products.update');
    Route::delete('/seller/products/{id}', [SellerController::class, 'destroy'])->name('seller.products.destroy');
});

// Page Detail
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
// Protected Routes (require authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/become-seller', [AuthController::class, 'requestSeller'])->name('request.seller');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});

// Payment Routes
Route::post('/payment', [PaymentController::class, 'createTransaction'])->name('payment.create');
Route::post('/payment/notification', [PaymentController::class, 'notificationHandler'])->name('payment.notification');
Route::post('/auction/{id}/payment', [AuctionPaymentController::class, 'createPayment'])
    ->name('auction.payment.create')
    ->middleware('auth');
// Auction Routes
Route::get('/auction', [AuctionController::class, 'index'])->name('auction.index');
Route::get('/auction/{id}', [AuctionController::class, 'show'])->name('auction.show');
Route::get('/auctions/{auction}', [AuctionController::class, 'show'])->name('auctions.show');
Route::get('/auctions', [AuctionController::class, 'index'])->name('auction.index');
Route::middleware(['auth'])->group(function () {
    Route::get('/auction', [AuctionController::class, 'index'])->name('auction.index');
    Route::get('/auction/{id}', [AuctionController::class, 'show'])->name('auction.show');
    Route::post('/auction/{id}/bid', [AuctionController::class, 'placeBid'])->name('auction.bid');
    Route::post('/seller/auctions', [SellerController::class, 'storeAuction'])->name('seller.auctions.store');

});
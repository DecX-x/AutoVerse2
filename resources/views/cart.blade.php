<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - AutoVerse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('storage/css/cart.css') }}">
    <link href="{{ asset('css/cart.css') }}" rel="stylesheet">

</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <!-- Brand -->
            <a class="navbar-brand" href="/">AutoVerse</a>
    
            <!-- Mobile Menu Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <!-- Navbar Content -->
            <div class="collapse navbar-collapse" id="navbarContent">
                <!-- Search Form - Full Width on Mobile -->
                <form class="d-lg-none w-100" action="{{ route('products.search') }}" method="GET">
                    <input 
                        class="form-control search-input" 
                        type="search"
                        name="query" 
                        placeholder="Search products..."
                        required
                        style="
                            border-radius: 10px;
                            padding: 10px 15px;
                            font-size: 0.95rem;
                            background: var(--input-bg);
                            border: 1px solid var(--input-border);
                            color: var(--text-color);
                        "
                    >
                </form>
    
                <!-- Navigation Links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/products">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/categories">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/auctions">Auction💰</a>
                    </li>
                </ul>
    
                <!-- Desktop Search -->
                <form class="d-none d-lg-flex mx-2 me-auto" style="width: 55%;" action="{{ route('products.search') }}" method="GET">
                    <input 
                        class="form-control search-input" 
                        type="search" 
                        name="query"
                        placeholder="Search for parts, tools, accessories..."
                        required
                        style="
                            border-radius: 30px;
                            padding: 10px 20px;
                            font-size: 0.95rem;
                            transition: all 0.3s ease;
                            box-shadow: var(--box-shadow);
                            background: var(--input-bg);
                            border: 1px solid var(--input-border);
                            color: var(--text-color);
                            width: 100%;
                        "
                    >
                </form>
    
                <!-- Action Buttons -->
                <div class="d-flex align-items-center gap-2 mt-3 mt-lg-0">
                    <button class="theme-toggle" id="theme-toggle" aria-label="Toggle theme">
                        <i class="fas fa-sun"></i>
                    </button>
                    <a href="/cart" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-shopping-cart me-2"></i><span class="d-none d-lg-inline">Cart</span>
                    </a>
                    @auth
                        <a href="{{ route('profile') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-user me-2"></i><span class="d-none d-lg-inline">Profile</span>
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fas fa-sign-out-alt me-2"></i><span class="d-none d-lg-inline">Logout</span>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-sign-in-alt me-2"></i><span class="d-none d-lg-inline">Login</span>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="container mt-5 pt-5">
        <div class="row">
            <!-- Cart Items -->
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Shopping Cart ({{ $cartItems->count() }} items)</h5>
                    </div>
                    <div class="card-body">
                        @if($cartItems->isEmpty())
                            <div class="text-center py-4">
                                <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                                <h5>Your cart is empty</h5>
                                <p class="text-muted">Browse our products and add items to your cart</p>
                                <a href="{{ route('products.index') }}" class="btn btn-primary">Continue Shopping</a>
                            </div>
                        @else
                            @foreach($cartItems as $item)
                                <div class="card mb-3">
                                    <div class="row g-0">
                                        <div class="col-md-3">
                                            <img src="{{ $item->product->image }}" 
                                                 class="img-fluid rounded-start" 
                                                 alt="{{ $item->product->name }}"
                                                 style="height: 100%; object-fit: cover;">
                                        </div>
                                        <div class="col-md-9">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <h5 class="card-title">{{ $item->product->name }}</h5>
                                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-link text-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                                <p class="card-text text-muted">{{ $item->product->category }}</p>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex align-items-center">
                                                        @csrf
                                                        @method('POST')
                                                        <label class="me-2">Quantity:</label>
                                                        <input type="number" name="quantity" value="{{ $item->quantity }}" 
                                                               min="1" class="form-control" style="width: 80px;">
                                                        <button type="submit" class="btn btn-sm btn-primary ms-2">Update</button>
                                                    </form>
                                                    <div class="text-end">
                                                        @if($item->product->discount_price)
                                                            <p class="text-muted mb-0"><s>Rp {{ number_format($item->product->price, 0, ',', '.') }}</s></p>
                                                            <h6 class="text-danger">Rp {{ number_format($item->product->discount_price * $item->quantity, 0, ',', '.') }}</h6>
                                                        @else
                                                            <h6>Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</h6>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping</span>
                            <span class="text-success">Free</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <strong>Total</strong>
                            <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
                        </div>
                        <!-- Add Midtrans Payment Form -->
                        <form id="payment-form" method="post" action="{{ route('payment.create') }}">
                            @csrf
                            <input type="hidden" name="total" value="{{ $total }}">
                            <button type="button" class="btn btn-primary w-100" id="pay-button" @if($cartItems->isEmpty()) disabled @endif>
                                Proceed to Checkout
                            </button>
                        </form>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-primary w-100 mt-2">
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Add Midtrans Snap.js -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    
    <script>
        const payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', async function () {
            try {
                payButton.disabled = true;
                payButton.innerHTML = 'Processing...';
    
                const response = await fetch('{{ route('payment.create') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        total: {{ $total ?? 0 }}
                    })
                });
    
                const data = await response.json();
    
                if (!response.ok) {
                    throw new Error(data.message || 'Payment failed');
                }
    
                window.snap.pay(data.snap_token, {
                    onSuccess: function(result) {
                        alert('Payment successful!');
                        window.location.href = '{{ route('orders') }}';
                    },
                    onPending: function(result) {
                        alert('Payment pending. Please complete your payment.');
                        window.location.href = '{{ route('orders') }}';
                    },
                    onError: function(result) {
                        alert('Payment failed. Please try again.');
                        window.location.reload();
                    },
                    onClose: function() {
                        payButton.disabled = false;
                        payButton.innerHTML = 'Proceed to Checkout';
                    }
                });
            } catch (error) {
                console.error('Payment Error:', error);
                alert('Payment failed: ' + error.message);
                payButton.disabled = false;
                payButton.innerHTML = 'Proceed to Checkout';
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const themeToggle = document.getElementById('theme-toggle');
            const html = document.documentElement;
            const icon = themeToggle.querySelector('i');
            
            const savedTheme = localStorage.getItem('theme') || 'light';
            html.setAttribute('data-bs-theme', savedTheme);
            updateIcon(savedTheme);

            themeToggle.addEventListener('click', () => {
                const currentTheme = html.getAttribute('data-bs-theme');
                const newTheme = currentTheme === 'light' ? 'dark' : 'light';
                
                html.setAttribute('data-bs-theme', newTheme);
                localStorage.setItem('theme', newTheme);
                updateIcon(newTheme);
            });

            function updateIcon(theme) {
                icon.className = theme === 'light' ? 'fas fa-moon' : 'fas fa-sun';
            }
        });
    </script>
</body>
</html>
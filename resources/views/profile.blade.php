<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - {{ Auth::user()->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Copy existing styles from home.blade.php -->
    <style>
        /* Copy all styles from home.blade.php */
        /* Additional profile styles */
        :root {
            --primary-color: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-light: #60a5fa;
            --secondary-color: #6c757d;
            --background-color: #f0f6ff;
            --text-color: #1e293b;
            --card-bg: #ffffff;
            --nav-bg: rgba(255, 255, 255, 0.9);
            --input-bg: #ffffff;
            --input-border: #cbd5e1;
            --box-shadow: 0 8px 20px rgba(37, 99, 235, 0.1);
            --hover-transform: translateY(-2px);
            --gradient-start: #f0f6ff;
            --gradient-end: #e0eaff;
        }

        [data-bs-theme="dark"] {
    --primary-color: #3b82f6;
    --primary-dark: #2563eb;
    --primary-light: #60a5fa;
    --secondary-color: #94a3b8;
    --background-color: #0f172a;
    --text-color: #e2e8f0;
    --card-bg: #1e293b;
    --nav-bg: rgba(15, 23, 42, 0.95);
    --input-bg: #1e293b;
    --input-border: #334155;
    --box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    --gradient-start: #0f172a;
    --gradient-end: #1e293b;
}

/* Add these additional dark mode styles */
[data-bs-theme="dark"] .navbar {
    border-bottom: 1px solid #334155;
}

[data-bs-theme="dark"] .nav-link {
    color: #e2e8f0;
}

[data-bs-theme="dark"] .nav-link:hover {
    color: var(--primary-light);
}

[data-bs-theme="dark"] .card {
    background: #1e293b;
    border: 1px solid #334155;
}

[data-bs-theme="dark"] .btn-outline-primary {
    color: var(--primary-light);
    border-color: var(--primary-light);
}

[data-bs-theme="dark"] .text-secondary {
    color: #94a3b8 !important;
}

[data-bs-theme="dark"] .lead {
    color: #cbd5e1;
}

[data-bs-theme="dark"] .navbar-toggler-icon {
    filter: invert(1);
}

[data-bs-theme="dark"] .text-primary {
    color: var(--primary-light) !important;
}

        body {
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            color: var(--text-color);
            min-height: 100vh;
            transition: all 0.5s ease;
        }

        .navbar {
            background: var(--nav-bg);
            backdrop-filter: blur(10px);
            box-shadow: var(--box-shadow);
        }

        .navbar-brand {
            font-weight: 700;
            background: linear-gradient(45deg, var(--primary-color), var(--primary-light));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .nav-link {
            color: var(--text-color);
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: var(--primary-color);
            transform: translateY(-2px);
        }

        .theme-toggle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary-color);
            border: none;
            color: white;
            box-shadow: var(--box-shadow);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .theme-toggle:hover {
            transform: scale(1.1);
            background: var(--primary-dark);
        }

        .card {
            background: var(--card-bg);
            border: none;
            box-shadow: var(--box-shadow);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: var(--hover-transform);
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        /* Add these to your existing styles */
.card-img-top {
    height: 200px;
    object-fit: cover;
    background-color: var(--background-color);
}

[data-bs-theme="dark"] .card-img-top {
    opacity: 0.9;
}

.badge {
    font-size: 0.8rem;
    padding: 0.5em 0.8em;
}

.card-title {
    font-size: 1rem;
    font-weight: 600;
    line-height: 1.2;
    height: 2.4em;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}

[data-bs-theme="dark"] .text-warning {
    color: #fbbf24 !important;
}

[data-bs-theme="dark"] .badge.bg-primary {
    background-color: var(--primary-color) !important;
}

[data-bs-theme="dark"] .badge.bg-danger {
    background-color: #ef4444 !important;
}
@media (max-width: 991.98px) {
        .navbar-collapse {
            background: var(--nav-bg);
            padding: 1rem;
            border-radius: 0.5rem;
            margin-top: 0.5rem;
            box-shadow: var(--box-shadow);
        }

        .navbar .container {
            padding: 0.5rem 1rem;
        }

        .navbar-toggler {
            padding: 4px 8px;
            font-size: 1rem;
        }

        .search-input {
            font-size: 0.9rem !important;
            padding: 8px 16px !important;
        }

        .profile-header {
            text-align: center;
        }

        .profile-header .col-md-3,
        .profile-header .col-md-9 {
            text-align: center;
            margin-bottom: 1rem;
        }

        .profile-header .col-md-9 {
            text-align: center;
        }

        .profile-section {
            padding: 1rem;
        }
    }

    .navbar-nav .nav-link {
        padding: 0.5rem 1rem;
        border-radius: 0.25rem;
    }

    .navbar-nav .nav-link:hover {
        background: rgba(var(--bs-primary-rgb), 0.1);
    }
    @media (min-width: 370px) {
        .navbar .container {
            padding-left: 0;
            max-width: 95%;
            margin-left: 2rem;
        }
        
        .navbar-brand {
            margin-right: 3rem;
        }
        
        .navbar-nav {
            margin-left: -1rem;
        }

        .profile-header .col-md-3 .update-photo-btn {
            display: block;
            margin-top: 1rem;
        }
    }
        .profile-header {
            background: var(--card-bg);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--box-shadow);
        }

        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--primary-color);
        }

        .profile-section {
            background: var(--card-bg);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 1rem;
            box-shadow: var(--box-shadow);
        }
    </style>
</head>
<body>
    <!-- Copy navbar from home.blade.php -->
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
                <form class="d-lg-none w-100 my-3" action="{{ route('products.search') }}" method="GET">
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
        <div class="profile-header">
            <div class="row align-items-center">
                <div class="col-md-3 text-center">
                    <img 
                        src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('images/default-profile.png') }}" 
                        class="profile-image mb-3"
                        alt="Profile Picture"
                    >
                    <button class="btn btn-primary btn-sm update-photo-btn mx-auto my-1" data-bs-toggle="modal" data-bs-target="#updatePhotoModal">
                        <i class="fas fa-camera me-2"></i>Update Photo
                    </button>
                </div>
                <div class="col-md-9">
                    <h2 class="mb-3">{{ Auth::user()->name }}</h2>
                    <p class="text-muted mb-2">
                        <i class="fas fa-envelope me-2"></i>{{ Auth::user()->email }}
                    </p>
                    <p class="text-muted mb-3">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        {{ Auth::user()->address ?: 'No address added yet' }}
                    </p>
                    <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        <i class="fas fa-edit me-2"></i>Edit Profile
                    </button>
                                        <!-- Replace the existing seller button with this conditional block -->
                    @if(Auth::user()->admin === 'true')
                        <a href="{{ route('admin.dashboard') }}" class="my-2 btn btn-danger ms-2">
                            <i class="fas fa-user-shield me-2"></i>Admin Dashboard
                        </a>
                    @endif
                    
                    @if(Auth::user()->seller === 'false')
                        <form action="{{ route('request.seller') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="my-2 btn btn-success ms-2">
                                <i class="fas fa-store me-2"></i>Become a Seller
                            </button>
                        </form>
                    @elseif(Auth::user()->seller === 'pending')
                        <button class="my-2 btn btn-warning ms-2" disabled>
                            <i class="fas fa-clock me-2"></i>Waiting for Approval
                        </button>
                    @elseif(Auth::user()->seller === 'approved')
                    <a href="{{ route('seller.dashboard') }}" class="my-2 btn btn-info ms-2">
                        <i class="fas fa-chart-line me-2"></i>Seller Dashboard
                    </a>
                @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="profile-section">
                    <h5 class="mb-3">Quick Links</h5>
                    <div class="list-group">
                        <a href="/orders" class="list-group-item list-group-item-action">
                            <i class="fas fa-shopping-bag me-2"></i>My Orders
                        </a>
                        <a href="/cart" class="list-group-item list-group-item-action">
                            <i class="fas fa-cart-shopping me-2"></i>Cart
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-map-marker-alt me-2"></i>Addresses
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-9">
                <!-- Replace the Recent Orders section -->
<div class="profile-section">
    <h5 class="mb-4">Recent Orders</h5>
    @if($recentOrders->isEmpty())
        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i>No recent orders found
        </div>
    @else
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentOrders as $order)
                    <tr>
                        <td>
                            <a href="{{ route('orders.show', $order->id) }}" class="text-primary">
                                #{{ $order->order_id }}
                            </a>
                        </td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                        <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge bg-{{ $order->status === 'completed' ? 'success' : 'warning' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
                
                <div class="profile-section">
                    <h5 class="mb-4">Saved Addresses</h5>
                    @if(Auth::user()->address)
                        <div class="card mb-3">
                            <div class="card-body">
                                <h6 class="card-title">Primary Address</h6>
                                <p class="card-text">{{ Auth::user()->address }}</p>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>No addresses saved yet
                        </div>
                    @endif
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addAddressModal">
                        <i class="fas fa-plus me-2"></i>Add New Address
                    </button>
                </div>
                <!-- Add after Saved Addresses section -->
                <div class="profile-section">
                    <h5 class="mb-4">My Auction Bids</h5>
                    @if($recentBids->isEmpty())
                        <div class="alert alert-info">
                            <i class="fas fa-gavel me-2"></i>You haven't placed any bids yet
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Auction Item</th>
                                        <th>Your Bid</th>
                                        <th>Bid Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentBids as $bid)
                                    <tr>
                                        <td>{{ $bid->auctionItem->title }}</td>
                                        <td>Rp {{ number_format($bid->bid_amount, 0, ',', '.') }}</td>
                                        <td>{{ $bid->created_at->format('d M Y H:i') }}</td>
                                        <td>
                                            @php
                                                $now = \Carbon\Carbon::now();
                                                $auctionEndsAt = \Carbon\Carbon::parse($bid->auctionItem->ends_at);
                                            @endphp
                                            
                                            @if($bid->is_winner)
                                                <span class="badge bg-success">Winner</span>
                                                <a href="{{ route('auctions.show', $bid->auction_item_id) }}" 
                                                   class="btn btn-sm btn-outline-success ms-2">
                                                    <i class="fas fa-trophy"></i> View Win
                                                </a>
                                            @elseif($auctionEndsAt < $now)
                                                <span class="badge bg-secondary">Ended</span>
                                            @else
                                                <span class="badge bg-primary">Active</span>
                                                <a href="{{ route('auctions.show', $bid->auction_item_id) }}" 
                                                   class="btn btn-sm btn-outline-primary ms-2">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <!-- Modals -->
    @include('partials.update-photo-modal')
    @include('partials.edit-profile-modal')
    @include('partials.add-address-modal')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Copy theme toggle script from home.blade.php -->
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
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product['name'] }} - AutoVerse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
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
        /* Copy all styles from home.blade.php and add these new styles */
        .product-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 8px;
        }

        .thumbnail {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
            cursor: pointer;
            opacity: 0.7;
            transition: all 0.3s ease;
        }

        .thumbnail:hover,
        .thumbnail.active {
            opacity: 1;
            transform: scale(1.05);
        }

        .specs-table tr td:first-child {
            width: 150px;
            font-weight: 600;
        }

        .quantity-input {
            width: 70px;
            text-align: center;
        }

        .feature-item {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 8px;
            background: var(--card-bg);
            box-shadow: var(--box-shadow);
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
    }

    .navbar-nav .nav-link {
        padding: 0.5rem 1rem;
        border-radius: 0.25rem;
    }

    .navbar-nav .nav-link:hover {
        background: rgba(var(--bs-primary-rgb), 0.1);
    }
    @media (min-width: 992px) {
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
    }
    </style>
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
                        <a class="nav-link" href="#">Auction💰</a>
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
        <div class="row g-4">
            <!-- Product Images -->
<div class="col-md-6">
    <div class="position-relative mb-3">
        <img src="{{ is_array($product->images) ? $product->images[0] : $product->images }}" id="mainImage" class="product-image" alt="{{ $product->name }}">
    </div>
    <div class="d-flex gap-2">
        @php
            $imageArray = is_array($product->images) ? $product->images : [$product->images];
        @endphp
        @foreach($imageArray as $image)
        <img src="{{ $image }}" class="thumbnail" alt="{{ $product->name }}" onclick="changeImage('{{ $image }}')">
        @endforeach
    </div>
</div>

<!-- Product Info -->
<div class="col-md-6">
    <h1 class="mb-2">{{ $product->name }}</h1>
    <div class="mb-3">
        <div class="d-flex align-items-center gap-2">
            <div>
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= floor($product->rating))
                        <i class="fas fa-star text-warning"></i>
                    @elseif($i - 0.5 <= $product->rating)
                        <i class="fas fa-star-half-alt text-warning"></i>
                    @else
                        <i class="far fa-star text-warning"></i>
                    @endif
                @endfor
            </div>
            <span class="text-secondary">({{ $product->reviews_count }} reviews)</span>
        </div>
    </div>

    <div class="mb-3">
        @if($product->discount_price)
            <div class="d-flex align-items-center gap-2">
                <h2 class="text-danger mb-0">Rp {{ number_format($product->discount_price, 0, ',', '.') }}</h2>
                <span class="text-decoration-line-through text-muted">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </span>
                @php
                    $savings = $product->price - $product->discount_price;
                    $savingsPercent = round(($savings / $product->price) * 100);
                @endphp
                <span class="badge bg-danger">
                    Save {{ $savingsPercent }}%
                </span>
            </div>
        @else
            <h2 class="text-primary mb-0">Rp {{ number_format($product->price, 0, ',', '.') }}</h2>
        @endif
    </div>
    
    <p class="mb-4">{{ $product->description }}</p>

    <!-- Replace existing add to cart button with this form -->
    <div class="mb-4">
        <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="d-flex align-items-center gap-3">
                <div class="input-group" style="width: 150px;">
                    <button class="btn btn-outline-secondary" type="button" onclick="updateQuantity(-1)">-</button>
                    <input type="number" class="form-control quantity-input" id="quantity" name="quantity" 
                           value="1" min="1" max="{{ $product->stock }}">
                    <button class="btn btn-outline-secondary" type="button" onclick="updateQuantity(1)">+</button>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-cart-plus me-2"></i>Add to Cart
                </button>
            </div>
        </form>
        <small class="text-secondary mt-2 d-block">{{ $product->stock }} items in stock</small>
    </div>
    
    <!-- Add flash message section after navbar -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Features -->
    <div class="mb-4">
        <h3 class="h5 mb-3">Key Features</h3>
        <div class="row g-2">
            @foreach($product->features as $feature)
            <div class="col-md-6">
                <div class="feature-item">
                    <i class="fas fa-check text-primary me-2"></i>
                    {{ $feature }}
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Specifications -->
    <div>
        <h3 class="h5 mb-3">Specifications</h3>
        <table class="table specs-table">
            <tbody>
                @foreach($product->specifications as $key => $value)
                    @if(!empty($value))
                    <tr>
                        <td>{{ $key }}</td>
                        <td>{{ $value }}</td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
       <script>
    document.addEventListener('DOMContentLoaded', () => {
        const themeToggle = document.getElementById('theme-toggle');
        const html = document.documentElement;
        const icon = themeToggle.querySelector('i');
        
        // Initialize theme from localStorage
        const savedTheme = localStorage.getItem('theme') || 'light';
        html.setAttribute('data-bs-theme', savedTheme);
        updateIcon(savedTheme);
    
        // Theme toggle event listener
        themeToggle.addEventListener('click', () => {
            const currentTheme = html.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            
            html.setAttribute('data-bs-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateIcon(newTheme);
        });
    });
    
    // Update icon based on theme
    function updateIcon(theme) {
        const icon = document.querySelector('.theme-toggle i');
        icon.className = theme === 'light' ? 'fas fa-moon' : 'fas fa-sun';
    }
    
    // Product image functions
    function changeImage(src) {
        document.getElementById('mainImage').src = src;
        document.querySelectorAll('.thumbnail').forEach(thumb => {
            thumb.classList.remove('active');
            if (thumb.src === src) thumb.classList.add('active');
        });
    }
    
    // Quantity update function
    function updateQuantity(change) {
        const input = document.getElementById('quantity');
        const newValue = parseInt(input.value) + change;
        if (newValue >= 1 && newValue <= {{ $product->stock }}) {
            input.value = newValue;
        }
    }
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - AutoVerse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Copy existing root styles from home.blade.php */
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

        /* New styles for product listing */
        .filter-section {
            background: var(--card-bg);
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: var(--box-shadow);
            position: sticky;
            top: 5rem;
        }

        .filter-group {
            margin-bottom: 1.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--input-border);
        }

        .filter-group:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .sort-select {
            background: var(--input-bg);
            border-color: var(--input-border);
            color: var(--text-color);
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        /* Copy existing body and component styles from home.blade.php */
        body {
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            color: var(--text-color);
            min-height: 100vh;
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
    @media (max-width: 991.98px) {
        .filter-section {
            display: none;
        }
        .filter-section.show {
            display: block;
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
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="px-2">Products</h1>
            <div class="d-flex gap-3 align-items-center">
                <button class="btn btn-outline-primary d-lg-none me-2" id="filter-toggle">
                    <i class="fas fa-filter"></i>
                </button>
                <select class="form-select sort-select">
                    <option>Latest</option>
                    <option>Price: Low to High</option>
                    <option>Price: High to Low</option>
                    <option>Most Popular</option>
                </select>
            </div>
        </div>

        <div class="row">
            <!-- Filters Sidebar -->
            <div class="col-lg-3">
                <form action="{{ route('products.index') }}" method="GET" id="filterForm">
                    <div class="filter-section" id="filter-section">
                        <!-- Filter content remains the same -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0">Filters</h5>
                            @if(request()->anyFilled(['categories', 'price', 'rating', 'shipping']))
                                <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-danger">
                                    Clear All
                                </a>
                            @endif
                        </div>

                        <!-- Categories Filter -->
                        <div class="filter-group">
                            <h6 class="mb-2">Categories</h6>
                            @foreach($categories as $category)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="categories[]" 
                                       value="{{ $category }}" id="cat-{{ $loop->index }}"
                                       {{ in_array($category, request()->get('categories', [])) ? 'checked' : '' }}
                                       onchange="this.form.submit()">
                                <label class="form-check-label" for="cat-{{ $loop->index }}">
                                    {{ $category }}
                                </label>
                            </div>
                            @endforeach
                        </div>

                        <!-- Price Range Filter -->
                        <div class="filter-group">
                            <!-- Previous filter groups remain the same -->
                            <h6 class="mb-2">Price Range</h6>
                            @php
                                $priceRanges = [
                                    '0-1000000' => 'Under Rp 1.000.000',
                                    '1000000-2000000' => 'Rp 1.000.000 - Rp 2.000.000',
                                    '2000000-999999999' => 'Above Rp 2.000.000'
                                ];
                            @endphp
                            @foreach($priceRanges as $range => $label)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="price[]" 
                                       value="{{ $range }}" id="price-{{ $loop->index }}"
                                       {{ in_array($range, request()->get('price', [])) ? 'checked' : '' }}
                                       onchange="this.form.submit()">
                                <label class="form-check-label" for="price-{{ $loop->index }}">
                                    {{ $label }}
                                </label>
                            </div>
                            @endforeach
                        </div>

                        <!-- Rating and Shipping filters remain the same -->
                        <!-- ... other filter groups ... -->
                    </div>
                </form>
            </div>

            <!-- Product Grid Section -->
            <div class="col-lg-9">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @php
                        // PHP filtering logic remains the same
                        $filteredProducts = $products;
                        
                        if(request()->has('categories')) {
                            $categories = request()->get('categories');
                            $filteredProducts = $filteredProducts->filter(function($product) use ($categories) {
                                return in_array($product->category ?? 'All Categories', $categories);
                            });
                        }
                        
                        // ... rest of the filtering logic ...
                    @endphp

                    @forelse($filteredProducts as $product)
                        <div class="col">
                            <div class="card h-100">
                                <div class="position-relative">
                                    <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">
                                    @if($product->badge)
                                    <span class="position-absolute top-0 end-0 m-2 badge bg-{{ $product->badge_color }}">
                                        {{ $product->badge }}
                                    </span>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title mb-1">{{ $product->name }}</h5>
                                    <div class="mb-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= floor($product->rating))
                                                <i class="fas fa-star text-warning"></i>
                                            @elseif($i - 0.5 <= $product->rating)
                                                <i class="fas fa-star-half-alt text-warning"></i>
                                            @else
                                                <i class="far fa-star text-warning"></i>
                                            @endif
                                        @endfor
                                        <small class="text-secondary ms-1">({{ $product->reviews_count }})</small>
                                    </div>
                                    <p class="text-primary fw-bold mb-1">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                    <p class="small text-secondary mb-2">
                                        {{ $product->free_shipping ? 'Free shipping' : '+ Shipping fee' }}
                                    </p>
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary w-100">
                                        <i class="fas fa-eye me-2"></i>View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info">
                                No products found matching your criteria.
                                <a href="{{ route('products.index') }}" class="alert-link">Clear filters</a>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Copy theme toggle script from home.blade.php
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

            const filterToggle = document.getElementById('filter-toggle');
            const filterSection = document.getElementById('filter-section');

            filterToggle.addEventListener('click', () => {
                filterSection.classList.toggle('show');
            });
        });
    </script>
</body>
</html>
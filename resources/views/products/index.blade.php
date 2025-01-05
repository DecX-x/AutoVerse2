<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - AutoVerse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('storage/css/index_product.css') }}">
    <link href="{{ asset('css/index_product.css') }}" rel="stylesheet">
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
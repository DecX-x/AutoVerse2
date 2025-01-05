<!-- home.blade.php -->
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoVerse - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('storage/css/home.css') }}">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    @include('layouts.navbar')
                
    <!-- Main Content -->
    <main class="container mt-5 pt-5">
        <!-- Hero Section -->
        <section class="py-5 text-center fade-in">
            <h1 class="display-4 fw-bold mb-4">
                @php
                    $hour = date('H');
                    $greeting = '';
                    if ($hour >= 5 && $hour < 12) {
                        $greeting = 'Good Morning';
                    } elseif ($hour >= 12 && $hour < 17) {
                        $greeting = 'Good Afternoon';
                    } elseif ($hour >= 17 && $hour < 22) {
                        $greeting = 'Good Evening';
                    } else {
                        $greeting = 'Good Night';
                    }
                @endphp
                {{ $greeting }}
                @auth
                    , {{ Auth::user()->name }}
                @endauth
            </h1>
            <div class="image-ad center" role="alert">
               <img src="{{ asset('assets/images/home-ad.png') }}" alt="Logo">
            </div>
        </section>

        <!-- Categories Section -->
        <section class="py-5 fade-in">
            <h2 class="text-center mb-4">Popular Categories</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card">
                        <a href="/products?categories%5B%5D=Engine+Parts" class="text-decoration-none">
                            <div class="card-body text-center">
                                <i class="fas fa-gear fa-3x mb-3 text-primary"></i>
                                <h5 class="card-title">Engine Parts</h5>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <a href="/products?categories%5B%5D=Tools" class="text-decoration-none">
                            <div class="card-body text-center">
                                <i class="fas fa-tools fa-3x mb-3 text-primary"></i>
                                <h5 class="card-title">Tools</h5>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <a href="/products?categories%5B%5D=Accessories" class="text-decoration-none">
                            <div class="card-body text-center">
                                <i class="fas fa-oil-can fa-3x mb-3 text-primary"></i>
                                <h5 class="card-title">Accessories</h5>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- button in the middle -->
                <div class="col-md-12 text-center mt-4">
                    <a href="/categories" class="btn btn-primary btn-lg">View All Categories</a>
                </div>
            </div>
        </section>

        <!-- Featured Products Section -->
        <section class="py-5 fade-in">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Featured Products</h2>
                <a href="/products" class="btn btn-outline-primary">View All</a>
            </div>
            <div class="row g-4">
                @foreach($featured_products as $product)
                    <div class="col-md-3">
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
                                    <small class="text-secondary ms-1">({{ $product->reviews_count }} reviews)</small>
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
                @endforeach
            </div>
        </section>

        <!-- Cars for Sale Section -->
        <section class="py-5 fade-in">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Cars for Sale</h2>
                <a href="/products" class="btn btn-outline-primary">View All</a>
            </div>
            <div class="row g-4">
                @foreach($car_products as $product)
                    <div class="col-md-3">
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
                                    <small class="text-secondary ms-1">({{ $product->reviews_count }} reviews)</small>
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
                @endforeach
            </div>
        </section>
        <!-- Cars with Discounts Section -->
<section class="py-5 fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Cars with Discounts</h2>
        <a href="/products?category=Cars&discount=1" class="btn btn-outline-primary">View All</a>
    </div>
    <div class="row g-4">
        @foreach($car_discount as $product)
            <div class="col-md-3">
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
                            <small class="text-secondary ms-1">({{ $product->reviews_count }} reviews)</small>
                        </div>
                        <p class="text-muted mb-1" style="text-decoration: line-through;">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                        <p class="text-primary fw-bold mb-1">
                            Rp {{ number_format($product->discount_price, 0, ',', '.') }}
                        </p>
                        <p class="small text-secondary mb-2">
                            {{ $product->free_shipping ? 'Free shipping' : '+ Shipping fee' }}
                        </p>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary w-100">
                            <i class="fas fa-eye me-2"></i>View Details
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
    </main>
    <!-- Footer -->
    @include('layouts.footer')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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

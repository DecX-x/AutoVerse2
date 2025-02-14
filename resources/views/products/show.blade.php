<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product['name'] }} - AutoVerse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('storage/css/product_show.css') }}">
    <link href="{{ asset('css/product_show.css') }}" rel="stylesheet">
</head>
<body>
    @include('layouts.navbar')
    
    


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
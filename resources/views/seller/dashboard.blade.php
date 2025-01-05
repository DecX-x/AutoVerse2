<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard - {{ Auth::user()->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('storage/css/dashboard_seller.css') }}">
    <link href="{{ asset('css/dashboard_seller.css') }}" rel="stylesheet">
</head>
<body>
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
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Seller Stats -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="stats-card p-4 text-center">
                    <i class="fas fa-box-open mb-3 text-primary" style="font-size: 2rem;"></i>
                    <h3 class="text-primary">{{ $totalProducts }}</h3>
                    <p class="text-muted mb-0">Total Products</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card p-4 text-center">
                    <i class="fas fa-shopping-cart mb-3 text-success" style="font-size: 2rem;"></i>
                    <h3 class="text-success">{{ $totalSold }}</h3>
                    <p class="text-muted mb-0">Products Sold</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card p-4 text-center">
                    <i class="fas fa-money-bill-wave mb-3 text-warning" style="font-size: 2rem;"></i>
                    <h3 class="text-warning">Rp.{{ number_format($totalRevenue, 2) }}</h3>
                    <p class="text-muted mb-0">Total Revenue</p>
                </div>
            </div>
        </div>

        <!-- Product Management -->
        <div class="profile-section">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4>Your Products</h4>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                    <i class="fas fa-plus me-2"></i>Add Product
                </button>
            </div>

            @if($products->isEmpty())
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>You haven't added any products yet
                </div>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>
                                        <img src="{{ asset('storage/' . $product->image) }}" 
                                             alt="{{ $product->name }}"
                                             width="50"
                                             height="50"
                                             class="rounded">
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category }}</td>
                                    <td>Rp.{{ number_format($product->price, 2) }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editProductModal{{ $product->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('seller.products.destroy', $product->id) }}" 
                                              method="POST" 
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Edit Product Modal -->
                                <div class="modal fade" id="editProductModal{{ $product->id }}">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Product</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('seller.products.update', $product->id) }}" 
                                                  method="POST" 
                                                  enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                @include('seller.partials.product-form', ['product' => $product])
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
        <!-- Add after Product Management section, before main closing tag -->
<!-- Auction Management -->
<div class="profile-section mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Your Auctions</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAuctionModal">
            <i class="fas fa-gavel me-2"></i>Add Auction
        </button>
    </div>

    @if($auctions->isEmpty())
        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i>You haven't created any auctions yet
        </div>
    @else
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Item</th>
                        <th>Starting Bid</th>
                        <th>Current Bid</th>
                        <th>Status</th>
                        <th>Ends At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($auctions as $auction)
                        <tr>
                            <td>
                                <img src="{{ asset('storage/' . $auction->image) }}" 
                                     alt="{{ $auction->name }}"
                                     width="50"
                                     height="50"
                                     class="rounded">
                            </td>
                            <td>{{ $auction->name }}</td>
                            <td>Rp {{ number_format($auction->starting_bid, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($auction->current_bid ?? $auction->starting_bid, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge bg-{{ $auction->status === 'open' ? 'success' : 'secondary' }}">
                                    {{ $auction->status }}
                                </span>
                            </td>
                            <td>
                                @if($auction->ends_at)
                                    {{ $auction->ends_at instanceof \Carbon\Carbon ? $auction->ends_at->format('d M Y H:i') : Carbon\Carbon::parse($auction->ends_at)->format('d M Y H:i') }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('auction.show', $auction->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<!-- Add Auction Modal -->
<div class="modal fade" id="addAuctionModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Auction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('seller.auctions.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Item Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Starting Bid (Rp)</label>
                                <input type="number" name="starting_bid" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Bid Increment (Rp)</label>
                                <input type="number" name="bid_increment" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Duration (hours)</label>
                                <input type="number" name="duration" class="form-control" required min="1">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Item Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create Auction</button>
                </div>
            </form>
        </div>
    </div>
</div>
    </main>

    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('seller.partials.product-form')
                </form>
            </div>
        </div>
    </div>
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
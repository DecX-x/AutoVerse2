<!-- home.blade.php -->
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoVerse - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/categories.css') }}">
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
    <!-- Main Content -->
    <main class="container mt-5 pt-5">
        <!-- Categories Section -->
        <section class="py-5 fade-in">
            <h2 class="text-center mb-4">Categories</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card">
                        <a href="/products?categories%5B%5D=Cars" class="text-decoration-none">
                            <div class="card-body text-center">
                                <i class="fas fa-car fa-3x mb-3 text-primary"></i>
                                <h5 class="card-title">Cars</h5>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <a href="/products?categories%5B%5D=Motorcycle" class="text-decoration-none">
                            <div class="card-body text-center">
                                <i class="fas fa-motorcycle fa-3x mb-3 text-primary"></i>
                                <h5 class="card-title">Motorcycle</h5>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <a href="/products?categories%5B%5D=Lighting" class="text-decoration-none">
                            <div class="card-body text-center">
                                <i class="fas fa-lightbulb fa-3x mb-3 text-primary"></i>
                                <h5 class="card-title">Lighting</h5>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <a href="/products?categories%5B%5D=Wheels" class="text-decoration-none">
                            <div class="card-body text-center">
                                <i class="fas fa-futbol fa-3x mb-3 text-primary"></i>
                                <h5 class="card-title">Wheels</h5>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <a href="/products?categories%5B%5D=Tires" class="text-decoration-none">
                            <div class="card-body text-center">
                                <i class="fas fa-compact-disc fa-3x mb-3 text-primary"></i>
                                <h5 class="card-title">Tires</h5>
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
                <div class="col-md-4">
                    <div class="card">
                        <a href="/products?categories%5B%5D=Brake+System" class="text-decoration-none">
                            <div class="card-body text-center">
                                <i class="fas fa-sliders fa-3x mb-3 text-primary"></i>
                                <h5 class="card-title">Brake System</h5>
                            </div>
                        </a>
                    </div>
                </div>
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
                <!-- button in the middle -->
            </div>
        </section>
        <!-- Add this section after the Categories Section -->
    </main>

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
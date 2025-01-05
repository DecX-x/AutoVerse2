

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

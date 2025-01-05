<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoVerse - Auction</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('storage/css/home.css') }}">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    @include('layouts.navbar')

    <!-- Theme Toggle Button -->
    <button id="theme-toggle" class="btn btn-secondary position-fixed top-0 end-0 m-3">
        <i class="fas fa-moon"></i>
    </button>

    <!-- Main Content -->
    <main class="container mt-5 pt-5">
        <!-- Auction Hero Section -->
        <section class="py-5 text-center fade-in">
            <h1 class="display-4 fw-bold mb-2">Live Auctions</h1>
            <p class="lead">Place your bids on these amazing automotive products!</p>
        </section>

        <!-- Auction Items Section -->
        <section class="py-5 fade-in">
            <h2 class="text-left py-4">Current Auctions</h2>
            <div class="row g-4">
                @forelse($auction_items as $item)
                    <div class="col-md-4">
                        <div class="card h-100">
                            <img src="{{ asset('storage/' . $item->image) }}" class="img-fluid rounded shadow" alt="{{ $item->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->name }}</h5>
                                <p class="text-muted">{{ Str::limit($item->description, 100) }}</p>
                                <p class="card-text">
                                    <strong>Starting Bid:</strong> Rp {{ number_format($item->starting_bid, 0, ',', '.') }}<br>
                                    <strong>Current Bid:</strong> Rp {{ number_format($item->current_bid ?? $item->starting_bid, 0, ',', '.') }}<br>
                                    <strong>Bid Increment:</strong> Rp {{ number_format($item->bid_increment, 0, ',', '.') }}
                                </p>
                                <p class="text-danger">Ends in: {{ $item->ends_at->diffForHumans() }}</p>
                                <a href="{{ route('auction.show', $item->id) }}" class="btn btn-primary w-100">Place Bid</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">No auctions available at the moment. Check back later!</p>
                    </div>
                @endforelse
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

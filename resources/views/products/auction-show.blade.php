<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $item->name }} - Auction</title>
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

    /* Add these new styles inside the existing <style> tag */
    .auction-image {
        border-radius: 15px;
        box-shadow: var(--box-shadow);
        transition: all 0.3s ease;
    }

    .auction-details {
        background: var(--card-bg);
        border-radius: 15px;
        padding: 2rem;
        box-shadow: var(--box-shadow);
        border: 1px solid rgba(var(--bs-primary-rgb), 0.1);
    }

    .bid-form {
        background: rgba(var(--bs-primary-rgb), 0.05);
        border-radius: 10px;
        padding: 1.5rem;
        margin: 1rem 0;
    }

    .bid-input {
        border-radius: 10px;
        border: 2px solid var(--primary-color);
        padding: 0.75rem;
        font-size: 1.1rem;
    }

    .bid-history {
        max-height: 400px;
        overflow-y: auto;
    }

    .bid-item {
        padding: 1rem;
        border-bottom: 1px solid rgba(var(--bs-primary-rgb), 0.1);
        transition: all 0.3s ease;
    }

    .bid-item:hover {
        background: rgba(var(--bs-primary-rgb), 0.05);
    }

    .countdown {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--primary-color);
        background: rgba(var(--bs-primary-rgb), 0.1);
        padding: 0.5rem 1rem;
        border-radius: 10px;
        display: inline-block;
    }
    </style>
</head>
<body>
    @include('layouts.navbar')

    <div class="container mt-5 pt-5">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('storage/' . $item->image) }}" class="img-fluid rounded shadow" alt="{{ $item->name }}">
            </div>
            <div class="col-md-6">
                <h2 class="mb-4">{{ $item->name }}</h2>
                <p class="lead">{{ $item->description }}</p>

                <!-- Modify the auction details section -->
                <div class="auction-details mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0">Current Status</h5>
                        <span class="countdown">
                            <i class="fas fa-clock me-2"></i>{{ $timeLeft }}
                        </span>
                    </div>
                    
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="detail-item">
                                <small class="text-muted">Starting Bid</small>
                                <h4 class="mb-0">Rp {{ number_format($item->starting_bid, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-item">
                                <small class="text-muted">Current Bid</small>
                                <h4 class="mb-0">Rp {{ number_format($item->current_bid ?? $item->starting_bid, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                    </div>

                    @if($item->status == 'open' && $item->ends_at > now())
                        <div class="bid-form mt-4">
                            <form action="{{ route('auction.bid', $item->id) }}" method="POST">
                                @csrf
                                <div class="input-group">
                                    <input type="number" name="bid_amount" class="form-control bid-input"
                                           value="{{ ($item->current_bid ?? $item->starting_bid) + $item->bid_increment }}"
                                           min="{{ ($item->current_bid ?? $item->starting_bid) + $item->bid_increment }}">
                                    <button class="btn btn-primary px-4" type="submit">
                                        <i class="fas fa-gavel me-2"></i>Place Bid
                                    </button>
                                </div>
                                <small class="text-muted mt-2 d-block">
                                    Minimum increment: Rp {{ number_format($item->bid_increment, 0, ',', '.') }}
                                </small>
                            </form>
                        </div>
                    @endif
                </div>

                <!-- Bid History -->
                <div class="card-body bid-history">
                    @if($bids->isEmpty())
                        <p class="text-muted">No bids yet. Be the first to bid!</p>
                    @else
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Bidder</th>
                                        <th>Amount</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bids as $bid)
                                    <tr class="bid-item">
                                        <td>{{ $bid->user->name }}</td>
                                        <td>Rp {{ number_format($bid->bid_amount, 0, ',', '.') }}</td>
                                        <td>{{ $bid->created_at->format('d M Y H:i') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Winner Payment Section -->
            @if($item->status == 'closed' && $winner && $winner->user_id == Auth::id())
            <div class="card mt-4">
                <div class="card-body">
                    <h5>Congratulations! You won this auction!</h5>
                    <p>Winning Bid: Rp {{ number_format($winner->bid_amount, 0, ',', '.') }}</p>
                    
                    <!-- Add Payment Form -->
                    <form id="auction-payment-form" method="post">
                        @csrf
                        <input type="hidden" name="auction_id" value="{{ $item->id }}">
                        <input type="hidden" name="bid_amount" value="{{ $winner->bid_amount }}">
                        <button type="button" class="btn btn-primary w-100" id="pay-auction-button">
                            <i class="fas fa-credit-card me-2"></i>Pay Now
                        </button>
                    </form>
                </div>
            </div>
            @endif

                </div>
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
    <!-- Add this near the end of the file, before closing body tag -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    <!-- Update the payment button script to match cart payment -->
<script>
    const payButton = document.getElementById('pay-auction-button');
    if (payButton) {
        payButton.addEventListener('click', async function() {
            try {
                payButton.disabled = true;
                payButton.innerHTML = 'Processing...';
    
                const response = await fetch('{{ route('auction.payment.create', $item->id) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
    
                const data = await response.json();
    
                if (!response.ok) {
                    throw new Error(data.message || 'Payment failed');
                }
    
                window.snap.pay(data.snap_token, {
                    onSuccess: function(result) {
                        alert('Payment successful!');
                        window.location.href = '{{ route('orders') }}';
                    },
                    onPending: function(result) {
                        alert('Payment pending. Please complete your payment.');
                        window.location.href = '{{ route('orders') }}';
                    },
                    onError: function(result) {
                        alert('Payment failed. Please try again.');
                        window.location.reload();
                    },
                    onClose: function() {
                        payButton.disabled = false;
                        payButton.innerHTML = '<i class="fas fa-credit-card me-2"></i>Pay Now';
                    }
                });
            } catch (error) {
                console.error('Payment Error:', error);
                alert('Payment failed: ' + error.message);
                payButton.disabled = false;
                payButton.innerHTML = '<i class="fas fa-credit-card me-2"></i>Pay Now';
            }
        });
    }
    </script>
</body>
</html>
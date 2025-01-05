<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $item->name }} - Auction</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('storage/css/auction_show.css') }}">
    <link href="{{ asset('css/auction_show.css') }}" rel="stylesheet">
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
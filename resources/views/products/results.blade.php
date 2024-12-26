@extends('products.index')

@section('title', 'Search Results - AutoVerse')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="px-2">Search Results</h1>
        <p class="text-muted">Found {{ $products->count() }} results for "{{ $query }}"</p>
    </div>
    <a href="{{ route('products.index') }}" class="btn btn-outline-primary">
        <i class="fas fa-arrow-left me-2"></i>Back to Products
    </a>
</div>

<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    @forelse($products as $product)
        <div class="col">
            <div class="card h-100">
                <!-- Same card structure as index.blade.php -->
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
                No products found matching your search.
                <a href="{{ route('products.index') }}" class="alert-link">Back to all products</a>
            </div>
        </div>
    @endforelse
</div>
@endsection
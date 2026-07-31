@extends('layouts.store')

@section('content')
<section class="py-5 mt-5 bg-light min-vh-100">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-4 col-lg-3 mb-4">
                @include('partials.account-sidebar')
            </div>

            <!-- Main Content -->
            <div class="col-md-8 col-lg-9">
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4 p-md-5">
                        <div class="d-flex align-items-center mb-4">
                            <h4 class="fw-bold m-0" style="letter-spacing: -0.5px;">My Wishlist</h4>
                        </div>
                        
                        @if(empty($wishlist) || count($wishlist) === 0)
                            <div class="text-center py-5 bg-light rounded-4 border border-light-subtle my-4">
                                <i class="bi bi-heart text-muted mb-3" style="font-size: 3rem;"></i>
                                <h5 class="fw-bold text-dark mb-2">Your wishlist is empty</h5>
                                <p class="text-muted small mb-4">Save items you love to your wishlist so you can easily find them later.</p>
                                <a href="/" class="btn btn-dark rounded-pill px-4">Explore Products</a>
                            </div>
                        @else
                            <div class="row g-4">
                                @foreach($wishlist as $item)
                                    @if($item->product)
                                    <div class="col-6 col-md-4 mb-4">
                                        <div class="product-item image-zoom-effect link-effect">
                                            <div class="image-holder position-relative">
                                                <a href="{{ route('frontend.product', $item->product->slug) }}">
                                                @if($item->product->images->where('is_primary', true)->first())
                                                    <img src="{{ $item->product->images->where('is_primary', true)->first()->image_path }}" alt="{{ $item->product->name }}" class="product-image img-fluid" style="height: 150px; width: 100px; object-fit: cover; border-radius: 8px;">
                                                @else
                                                    <img src="https://via.placeholder.com/150x200?text={{ urlencode($item->product->name) }}" alt="{{ $item->product->name }}" class="product-image img-fluid" style="height: 150px; width: 100px; object-fit: cover; border-radius: 8px;">
                                                @endif
                                                </a>
                                                <a href="#" class="btn-icon btn-wishlist active" data-product-id="{{ $item->product->id }}" onclick="toggleWishlist(event, '{{ $item->product->id }}')">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" style="fill: red;">
                                                        <use xlink:href="#heart"></use>
                                                    </svg>
                                                </a>
                                                <div class="product-content">
                                                    <h5 class="element-title text-uppercase fs-5 mt-3">
                                                        <a href="{{ route('frontend.product', $item->product->slug) }}">{{ $item->product->name }}</a>
                                                    </h5>
                                                    <a href="#" class="text-decoration-none add-to-cart-btn" data-product-id="{{ $item->product->id }}" data-after="Add to cart">
                                                        <span>${{ number_format($item->product->base_price, 2) }}</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

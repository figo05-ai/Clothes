@extends('layouts.store')

@section('content')
<section class="py-5 mt-5 bg-light min-vh-100">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                    <div class="card-body p-4 text-center bg-white border-bottom">
                        <div class="mb-3">
                            <div class="d-inline-block bg-primary text-white rounded-circle fs-3 d-flex align-items-center justify-content-center mx-auto" style="width: 80px; height: 80px;">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                        </div>
                        <h5 class="fw-bold mb-1">{{ auth()->user()->name }}</h5>
                        <p class="text-muted small mb-0">{{ auth()->user()->email }}</p>
                    </div>
                    <div class="list-group list-group-flush border-0">
                        <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action p-3 fw-semibold">
                            <i class="bi bi-person me-2"></i> Dashboard
                        </a>
                        <a href="{{ route('dashboard.orders') }}" class="list-group-item list-group-item-action p-3">
                            <i class="bi bi-box-seam me-2"></i> Order History
                        </a>
                        <a href="{{ route('wishlist') }}" class="list-group-item list-group-item-action p-3 active fw-semibold">
                            <i class="bi bi-heart me-2"></i> My Wishlist
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf
                            <button type="submit" class="list-group-item list-group-item-action p-3 text-danger fw-semibold w-100 text-start border-0">
                                <i class="bi bi-box-arrow-right me-2"></i> Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-8 col-lg-9">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-4 p-md-5">
                        <h4 class="fw-bold mb-4">My Wishlist</h4>
                        
                        @if(empty($wishlist) || count($wishlist) === 0)
                            <div class="text-center py-5">
                                <i class="bi bi-heart text-muted mb-3" style="font-size: 3rem;"></i>
                                <h5 class="text-muted">Your wishlist is empty.</h5>
                                <p class="text-muted small">Save items you love to your wishlist so you can easily find them later.</p>
                                <a href="/" class="btn btn-primary mt-3">Explore Products</a>
                            </div>
                        @else
                            <div class="row g-4">
                                @foreach($wishlist as $item)
                                    @if($item->product)
                                    <div class="col-6 col-md-4 mb-4">
                                        <div class="product-item image-zoom-effect link-effect">
                                            <div class="image-holder position-relative">
                                                <a href="{{ route('frontend.product', $item->product->slug) }}">
                                                    <img src="{{ asset('images/product-item-1.jpg') }}" alt="{{ $item->product->name }}" class="product-image img-fluid">
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

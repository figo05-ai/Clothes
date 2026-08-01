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
                        <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom">
                            <h4 class="fw-bold m-0" style="letter-spacing: -0.5px;">{{ __('My Wishlist') }}</h4>
                            <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">{{ count($wishlist) }} {{ __('Items') }}</span>
                        </div>
                        
                        @if(empty($wishlist) || count($wishlist) === 0)
                            <div class="text-center py-5 bg-light rounded-4 border border-light-subtle my-4" style="background: linear-gradient(180deg, #ffffff 0%, #f8f9fa 100%);">
                                <i class="bi bi-heart text-muted mb-3 d-block" style="font-size: 3.5rem; opacity: 0.5;"></i>
                                <h5 class="fw-bold text-dark mb-2" style="letter-spacing: -0.5px;">{{ __('Your wishlist is empty') }}</h5>
                                <p class="text-muted small mb-4 mx-auto" style="max-width: 300px;">{{ __('Save items you love to your wishlist so you can easily find them later.') }}</p>
                                <a href="/" class="btn btn-dark rounded-pill px-5 shadow-sm fw-bold text-uppercase" style="letter-spacing: 1px; font-size: 0.8rem; padding-top: 12px; padding-bottom: 12px;">{{ __('Explore Products') }}</a>
                            </div>
                        @else
                            <div class="row g-4 mt-2">
                                @foreach($wishlist as $item)
                                    @if($item->product)
                                    <div class="col-6 col-md-4 mb-4">
                                        <div class="product-item position-relative rounded-4 overflow-hidden shadow-sm" data-product-id="{{ isset($item->product) ? $item->product->id : '' }}" style="transition: transform 0.2s ease, box-shadow 0.2s ease;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 20px rgba(0,0,0,0.08)';" onmouseout="this.style.transform='none'; this.style.boxShadow='0 0.125rem 0.25rem rgba(0, 0, 0, 0.075)';">
                                            <div class="image-holder position-relative" style="background-color: #f6f6f6; padding-top: 130%;">
                                                <a href="{{ route('frontend.product', $item->product->slug) }}">
                                                @if($item->product->images->where('is_primary', true)->first())
                                                    <img src="{{ $item->product->images->where('is_primary', true)->first()->image_url }}" alt="{{ $item->product->name }}" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover" style="transition: opacity 0.3s ease;">
                                                @else
                                                    <img src="https://via.placeholder.com/150x200?text={{ urlencode($item->product->name) }}" alt="{{ $item->product->name }}" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover">
                                                @endif
                                                </a>
                                                <a href="#" class="btn-icon btn-wishlist active position-absolute top-0 end-0 m-3 d-flex align-items-center justify-content-center bg-white shadow-sm rounded-circle" style="width: 36px; height: 36px; transition: transform 0.2s ease;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'" data-product-id="{{ $item->product->id }}" onclick="toggleWishlist(event, '{{ $item->product->id }}')">
                                                    <i class="bi bi-heart-fill text-danger"></i>
                                                </a>
                                            </div>
                                            <div class="product-content p-3 bg-white">
                                                <h5 class="element-title text-uppercase mb-2" style="font-size: 0.85rem; letter-spacing: 0.5px;">
                                                    <a href="{{ route('frontend.product', $item->product->slug) }}" class="text-dark text-decoration-none">{{ $item->product->name }}</a>
                                                </h5>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span class="fw-bold" style="font-size: 0.95rem;">${{ number_format($item->product->base_price, 2) }}</span>
                                                    <a href="#" class="text-dark d-flex align-items-center justify-content-center bg-light rounded-circle" style="width: 32px; height: 32px; transition: background-color 0.2s ease;" onmouseover="this.classList.replace('bg-light', 'bg-dark'); this.classList.replace('text-dark', 'text-white')" onmouseout="this.classList.replace('bg-dark', 'bg-light'); this.classList.replace('text-white', 'text-dark')" data-product-id="{{ $item->product->id }}" title="{{ __('Add to Cart') }}">
                                                        <i class="bi bi-cart2"></i>
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

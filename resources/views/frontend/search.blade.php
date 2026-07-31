@extends('layouts.store')

@section('content')
    <section class="py-5 mt-5">
        <div class="container">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Search Results</li>
                </ol>
            </nav>

            <div class="row mt-4">
                <div class="col-12">
                    <h2 class="mb-4">Search Results for "{{ $query }}" <span
                            class="text-muted fs-5">({{ $products->total() }} Products)</span></h2>

                    <div class="row row-cols-1 row-cols-md-4 g-4">
                        @forelse($products as $product)
                            <div class="col">
                                <div class="product-item image-zoom-effect link-effect">
                                    <div class="image-holder position-relative">
                                        <a href="{{ route('frontend.product', $product->slug) }}">
                                            @if ($product->images->where('is_primary', true)->first())
                                                <img src="{{ $product->images->where('is_primary', true)->first()->image_path }}"
                                                    class="product-image img-fluid" alt="{{ $product->name }}"
                                                    style="height: 400px; width: 100%; object-fit: cover; border-radius: 8px;">
                                            @else
                                                <img src="https://via.placeholder.com/800x1200?text={{ urlencode($product->name) }}"
                                                    class="product-image img-fluid" alt="{{ $product->name }}"
                                                    style="height: 400px; width: 100%; object-fit: cover; border-radius: 8px;">
                                            @endif
                                        </a>
                                        <a href="#" class="btn-icon btn-wishlist active"
                                            data-product-id="{{ $product->id }}"
                                            onclick="toggleWishlist(event, '{{ $product->id }}')">
                                            <svg width="24" height="24" viewBox="0 0 24 24">
                                                <use xlink:href="#heart"></use>
                                            </svg>
                                        </a>
                                        <div class="product-content">
                                            <h5 class="element-title text-uppercase fs-5 mt-3">
                                                <a
                                                    href="{{ route('frontend.product', $product->slug) }}">{{ $product->name }}</a>
                                            </h5>
                                            <a href="#" class="text-decoration-none add-to-cart-btn"
                                                data-product-id="{{ $product->id }}" data-after="Add to cart">
                                                <span>${{ number_format($product->base_price, 2) }}</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <h4 class="text-muted">No products found for "{{ $query }}". Try different keywords.
                                </h4>
                                <a href="/" class="btn btn-primary mt-3">Continue Shopping</a>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-5 d-flex justify-content-center">
                        {{ $products->appends(['q' => $query])->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

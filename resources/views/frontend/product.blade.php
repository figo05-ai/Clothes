@extends('layouts.store')

@section('content')
<section class="py-5 mt-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.category', $product->subcategory->category->slug) }}">{{ $product->subcategory->category->name }}</a></li>
                <li class="breadcrumb-item"><a href="#">{{ $product->subcategory->name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>

        <div class="row mt-5">
            <!-- Product Images -->
            <div class="col-md-6">
                <div class="product-gallery">
                    <div class="main-image mb-3">
                        @if($product->images->where('is_primary', true)->first())
                            <img src="{{ $product->images->where('is_primary', true)->first()->image_path }}" class="img-fluid rounded" alt="{{ $product->name }}">
                        @else
                            <img src="https://via.placeholder.com/800x1200?text={{ urlencode($product->name) }}" class="img-fluid rounded" alt="{{ $product->name }}">
                        @endif
                    </div>
                    <div class="d-flex gap-2 thumbnail-images">
                        @foreach($product->images as $image)
                            <img src="{{ $image->image_path }}" class="img-thumbnail" style="width: 100px; height: 150px; object-fit: cover; cursor: pointer;" alt="">
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Product Details -->
            <div class="col-md-6">
                <h1 class="display-5 fw-bold">{{ $product->name }}</h1>
                <div class="d-flex align-items-center mb-3">
                    <div class="text-warning me-2">
                        @php
                            $avgRating = $product->reviews->avg('rating') ?? 0;
                        @endphp
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $avgRating)
                                <i class="bi bi-star-fill"></i>
                            @else
                                <i class="bi bi-star"></i>
                            @endif
                        @endfor
                    </div>
                    <span>({{ $product->reviews->count() }} Reviews)</span>
                </div>
                
                <h2 class="text-primary mb-4">${{ number_format($product->base_price, 2) }}</h2>
                <p class="lead">{{ $product->short_description }}</p>
                
                <div class="mb-4">
                    <p>{{ $product->long_description }}</p>
                </div>

                <div class="d-flex gap-3 mb-4">
                    <input type="number" class="form-control" value="1" min="1" max="{{ $product->stock_quantity }}" style="width: 80px;" id="qty-{{ $product->id }}">
                    <button class="btn btn-dark btn-lg flex-grow-1 add-to-cart-btn" data-product-id="{{ $product->id }}">
                        Add to Cart
                    </button>
                    <button class="btn btn-outline-danger btn-lg wishlist-btn" data-product-id="{{ $product->id }}" onclick="toggleWishlist(event, '{{ $product->id }}')">
                        <svg width="24" height="24" viewBox="0 0 24 24" style="fill: none; stroke: currentColor; stroke-width: 2;"><use xlink:href="#heart"></use></svg>
                    </button>
                </div>

                <div class="product-meta text-muted mt-4">
                    <p class="mb-1"><strong>SKU:</strong> {{ $product->sku }}</p>
                    <p class="mb-1"><strong>Category:</strong> {{ $product->subcategory->category->name }} > {{ $product->subcategory->name }}</p>
                    <p class="mb-0"><strong>Availability:</strong> 
                        @if($product->stock_quantity > 0)
                            <span class="text-success">In Stock ({{ $product->stock_quantity }})</span>
                        @else
                            <span class="text-danger">Out of Stock</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Product Reviews Section -->
<section class="py-5 border-top">
    <div class="container">
        <h3 class="mb-4">Customer Reviews</h3>
        <div class="row">
            <div class="col-md-8">
                @if($product->reviews->where('status', 'approved')->count() > 0)
                    @foreach($product->reviews->where('status', 'approved') as $review)
                        <div class="mb-4 pb-4 border-bottom">
                            <div class="d-flex align-items-center mb-2">
                                <div class="text-warning me-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating)
                                            <i class="bi bi-star-fill"></i>
                                        @else
                                            <i class="bi bi-star"></i>
                                        @endif
                                    @endfor
                                </div>
                                <span class="fw-bold me-2">{{ $review->user->name }}</span>
                                <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="mb-0">{{ $review->review_text }}</p>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted">No reviews yet for this product.</p>
                @endif
            </div>
            
            <div class="col-md-4">
                <div class="card bg-light border-0">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">Write a Review</h5>
                        @auth
                            <form id="review-form" method="POST" action="/api/products/{{ $product->id }}/reviews">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Rating</label>
                                    <select name="rating" class="form-select" required>
                                        <option value="5">5 - Excellent</option>
                                        <option value="4">4 - Good</option>
                                        <option value="3">3 - Average</option>
                                        <option value="2">2 - Poor</option>
                                        <option value="1">1 - Terrible</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Review</label>
                                    <textarea name="review_text" class="form-control" rows="4" placeholder="What did you like or dislike?" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-dark w-100">Submit Review</button>
                                <div id="review-alert" class="mt-3 d-none alert"></div>
                            </form>
                        @else
                            <p class="mb-3 text-muted">You must be logged in to write a review.</p>
                            <a href="/login" class="btn btn-outline-dark w-100">Log In</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Related Products -->
@if($relatedProducts->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <h3 class="mb-4">You may also like</h3>
        <div class="row row-cols-1 row-cols-md-4 g-4">
            @foreach($relatedProducts as $related)
            <div class="col">
                <div class="card h-100 border-0 shadow-sm">
                    <a href="{{ route('frontend.product', $related->slug) }}">
                        @if($related->images->where('is_primary', true)->first())
                            <img src="{{ $related->images->where('is_primary', true)->first()->image_path }}" class="card-img-top" alt="{{ $related->name }}" style="height: 400px; width: 100%; object-fit: cover; border-radius: 8px;">
                        @else
                            <img src="https://via.placeholder.com/800x1200?text={{ urlencode($related->name) }}" class="card-img-top" alt="{{ $related->name }}" style="height: 400px; width: 100%; object-fit: cover; border-radius: 8px;">
                        @endif
                    </a>
                    <div class="card-body text-center">
                        <h5 class="card-title">
                            <a href="{{ route('frontend.product', $related->slug) }}" class="text-dark text-decoration-none">{{ $related->name }}</a>
                        </h5>
                        <p class="text-primary fw-bold">${{ number_format($related->base_price, 2) }}</p>
                        <button class="btn btn-sm btn-outline-dark w-100 add-to-cart-btn" data-product-id="{{ $related->id }}">Add to Cart</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection

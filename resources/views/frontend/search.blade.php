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
                <h2 class="mb-4">Search Results for "{{ $query }}" <span class="text-muted fs-5">({{ $products->total() }} Products)</span></h2>

                <div class="row row-cols-1 row-cols-md-4 g-4">
                    @forelse($products as $product)
                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm">
                            <a href="{{ route('frontend.product', $product->slug) }}">
                                @if($product->images->where('is_primary', true)->first())
                                    <img src="{{ $product->images->where('is_primary', true)->first()->image_path }}" class="card-img-top" alt="{{ $product->name }}">
                                @else
                                    <img src="https://via.placeholder.com/800x1200?text={{ urlencode($product->name) }}" class="card-img-top" alt="{{ $product->name }}">
                                @endif
                            </a>
                            <div class="card-body text-center">
                                <h5 class="card-title">
                                    <a href="{{ route('frontend.product', $product->slug) }}" class="text-dark text-decoration-none">{{ $product->name }}</a>
                                </h5>
                                <p class="text-primary fw-bold">${{ number_format($product->base_price, 2) }}</p>
                                <button class="btn btn-sm btn-outline-dark w-100 add-to-cart-btn" data-product-id="{{ $product->id }}">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5">
                        <h4 class="text-muted">No products found for "{{ $query }}". Try different keywords.</h4>
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

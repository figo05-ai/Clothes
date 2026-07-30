@extends('layouts.store')

@section('content')
<section class="py-5 mt-5">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
            </ol>
        </nav>

        <div class="row mt-4">
            <!-- Sidebar / Filters -->
            <div class="col-md-3">
                <form action="{{ url()->current() }}" method="GET" id="filter-form">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Subcategories</h5>
                            <ul class="list-unstyled mb-0">
                                @foreach($category->subcategories as $sub)
                                    <li class="mb-2">
                                        <a href="#" class="text-decoration-none text-dark hover-primary">{{ $sub->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Filter by Price</h5>
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <input type="number" name="min_price" class="form-control form-control-sm" placeholder="Min" value="{{ request('min_price') }}">
                                <span>-</span>
                                <input type="number" name="max_price" class="form-control form-control-sm" placeholder="Max" value="{{ request('max_price') }}">
                            </div>
                            <button type="submit" class="btn btn-dark btn-sm w-100">Apply Filter</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Product Grid -->
            <div class="col-md-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">{{ $category->name }} <span class="text-muted fs-5">({{ $products->total() }} Products)</span></h2>
                    
                    <!-- Sorting -->
                    <select class="form-select w-auto" name="sort" onchange="document.getElementById('sort-hidden').value = this.value; document.getElementById('filter-form').submit();">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                    </select>
                    <!-- Hidden input to pass sort value with filters -->
                    <input type="hidden" form="filter-form" name="sort" id="sort-hidden" value="{{ request('sort', 'latest') }}">
                </div>

                <div class="row row-cols-1 row-cols-md-3 g-4">
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
                        <h4 class="text-muted">No products found in this category.</h4>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-5 d-flex justify-content-center">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

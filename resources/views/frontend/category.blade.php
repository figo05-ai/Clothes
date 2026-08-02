@extends('layouts.store')

@section('content')
    <section class="py-5 mt-5">
        <div class="container">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __($category->name) }}</li>
                </ol>
            </nav>

            <div class="row mt-4">
                <!-- Sidebar / Filters -->
                <div class="col-md-3">
                    <form action="{{ url()->current() }}" method="GET" id="filter-form">
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body">
                                <h5 class="card-title mb-3">{{ __('Subcategories') }}</h5>
                                <ul class="list-unstyled mb-0">
                                    @if (request('subcategory'))
                                        <li class="mb-3">
                                            <a href="{{ request()->fullUrlWithQuery(['subcategory' => null]) }}"
                                                class="text-decoration-none text-danger small hover-primary"><i
                                                    class="fas fa-times"></i> {{ __('Clear Subcategory Filter') }}</a>
                                        </li>
                                    @endif
                                    @foreach ($category->subcategories as $sub)
                                        <li class="mb-2">
                                            <a href="{{ request()->fullUrlWithQuery(['subcategory' => $sub->slug]) }}"
                                                class="text-decoration-none hover-primary {{ request('subcategory') == $sub->slug ? 'fw-bold text-primary' : 'text-dark' }}">
                                                {{ __($sub->name) }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="card-title mb-0">{{ __('Filter by Price') }}</h5>
                                    @if (request()->filled('min_price') || request()->filled('max_price'))
                                        <a href="{{ request()->fullUrlWithQuery(['min_price' => null, 'max_price' => null]) }}"
                                            class="text-danger small text-decoration-none hover-primary"><i
                                                class="fas fa-times"></i> {{ __('Clear') }}</a>
                                    @endif
                                </div>
                                <div class="d-flex align-items-center gap-2 mb-3">
                                    <input type="number" name="min_price" class="form-control form-control-sm"
                                        placeholder="Min" value="{{ request('min_price') }}">
                                    <span>-</span>
                                    <input type="number" name="max_price" class="form-control form-control-sm"
                                        placeholder="Max" value="{{ request('max_price') }}">
                                </div>
                                @if (request('subcategory'))
                                    <input type="hidden" name="subcategory" value="{{ request('subcategory') }}">
                                @endif
                                <button type="submit" class="btn btn-dark btn-sm w-100">{{ __('Apply Filter') }}</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Product Grid -->
                <div class="col-md-9">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="mb-0">{{ __($category->name) }} <span class="text-muted fs-5">({{ $products->total() }}
                                {{ __('Products') }})</span></h2>

                        <!-- Sorting -->
                        <select class="form-select w-auto" name="sort"
                            onchange="document.getElementById('sort-hidden').value = this.value; document.getElementById('filter-form').submit();">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>{{ __('Latest') }}</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>{{ __('Price: Low to High') }}</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>{{ __('Price: High to Low') }}</option>
                        </select>
                        <!-- Hidden input to pass sort value with filters -->
                        <input type="hidden" form="filter-form" name="sort" id="sort-hidden"
                            value="{{ request('sort', 'latest') }}">
                    </div>

                    <div class="row row-cols-2 row-cols-md-3 g-4">
                        @forelse($products as $product)
                            <div class="col">
                                <div class="product-item image-zoom-effect link-effect" data-product-id="{{ $product->id }}">
                                    <div class="image-holder position-relative">
                                        <a href="{{ route('frontend.product', $product->slug) }}">
                                            @if ($product->images->where('is_primary', true)->first())
                                                <img src="{{ $product->images->where('is_primary', true)->first()->image_url }}"
                                                    class="product-image img-fluid" alt="{{ __($product->name) }}"
                                                    style="aspect-ratio: 3/4; width: 100%; object-fit: cover; border-radius: 8px;">
                                            @else
                                                <img src="https://via.placeholder.com/800x1200?text={{ urlencode($product->name) }}"
                                                    class="product-image img-fluid" alt="{{ __($product->name) }}"
                                                    style="aspect-ratio: 3/4; width: 100%; object-fit: cover; border-radius: 8px;">
                                            @endif
                                        </a>
                                        <a href="javascript:void(0)" class="btn-icon btn-wishlist" data-product-id="{{ $product->id }}" onclick="toggleWishlist(event, '{{ $product->id }}')">
                                            @if(isset($wishlistProductIds) && in_array($product->id, $wishlistProductIds))
                                                <svg width="24" height="24" viewBox="0 0 24 24" style="color: red; fill: red;">
                                                    <use xlink:href="#heart"></use>
                                                </svg>
                                            @else
                                                <svg width="24" height="24" viewBox="0 0 24 24" style="color: inherit; fill: none;">
                                                    <use xlink:href="#heart"></use>
                                                </svg>
                                            @endif
                                        </a>
                                        <div class="product-content">
                                            <h5 class="element-title text-uppercase fs-5 mt-3">
                                                <a
                                                    href="{{ route('frontend.product', $product->slug) }}">{{ __($product->name) }}</a>
                                            </h5>
                                            <a href="#" class="text-decoration-none add-to-cart-btn"
                                                data-product-id="{{ $product->id }}" data-after="{{ __('Add to cart') }}">
                                                <span>${{ number_format($product->base_price, 2) }}</span>
                                            </a>
                                        </div>
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

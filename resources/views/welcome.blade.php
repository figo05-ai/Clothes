@extends("layouts.store")
@section("content")
    <section id="billboard" class="bg-light py-5">
        <div class="container">
            <div class="row justify-content-center text-center mb-4">
                <div class="col-lg-7 col-md-9" data-aos="fade-up">
                    <span class="text-uppercase text-primary fw-bold d-block mb-1"
                        style="font-size: 0.8rem; letter-spacing: 2.5px;">CURATED LOOKBOOK 2026</span>
                    <h2 class="section-title text-uppercase m-0 fw-bold display-6" style="letter-spacing: 1px;">NEW
                        COLLECTIONS</h2>
                    <p class="text-secondary mt-3 mx-auto"
                        style="font-size: 0.95rem; line-height: 1.6; max-width: 620px;">
                        Discover our curated selection of premium apparel and timeless statement pieces, crafted from
                        sustainable fabrics with meticulous attention to detail.
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="swiper main-swiper py-2" data-aos="fade-up" data-aos-delay="300">
                    <div class="swiper-wrapper d-flex">
                        @foreach($banners as $banner)
                        <div class="swiper-slide">
                            <div class="spotlight-card h-100 d-flex flex-column">
                                <div class="position-relative overflow-hidden">
                                    <a href="{{ $banner->link_url }}" class="d-block text-decoration-none">
                                        <img src="{{ $banner->image_url }}" alt="{{ $banner->title }}"
                                            class="img-fluid w-100 spotlight-img" style="height: 600px; object-fit: cover;">
                                    </a>
                                </div>
                                <div class="p-4 d-flex flex-column flex-grow-1">
                                    <h5 class="fw-bold text-dark text-uppercase mb-2" style="letter-spacing: 0.5px;">
                                        <a href="{{ $banner->link_url }}" class="text-decoration-none text-dark">{{ $banner->title }}</a>
                                    </h5>
                                    <div>
                                        <a href="{{ $banner->link_url }}"
                                            class="btn btn-dark rounded-pill px-4 py-2 text-uppercase fw-semibold fs-7 shadow-sm d-inline-flex align-items-center gap-2">
                                            Shop Now
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                                <polyline points="12 5 19 12 12 19"></polyline>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination mt-4"></div>
                </div>
            </div>
        </div>
    </section>

    </div>
    </div>
    </section>

    <!-- Concierge Guarantee Features Section -->
    <section class="features py-5 bg-white border-top border-bottom">
        <div class="container py-3">
            <div class="row g-4 justify-content-center">
                @foreach($categories->take(2) as $category)
                <div class="col-md-4">
                    <div class="category-card">
                        <a href="{{ route('frontend.category', $category->slug) }}" class="d-block text-decoration-none text-white">
                            <img src="{{ asset('images/products/categories/' . strtolower($category->name) . ' category.jpg') }}" alt="{{ $category->name }}"
                                class="img-fluid w-100 category-card-img" style="height: 400px; object-fit: cover; width: 100%;">
                            <span class="badge bg-white text-dark rounded-pill position-absolute top-0 end-0 m-3 px-3 py-2 fw-semibold shadow-sm" style="font-size: 0.75rem;">SHOP</span>
                            <div class="category-card-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-end p-4">
                                <span class="text-uppercase text-white-50 small fw-medium mb-1" style="letter-spacing: 1.5px;">Discover</span>
                                <h4 class="fw-bold text-white text-uppercase m-0 mb-3 fs-3" style="letter-spacing: 1px;">{{ $category->name }}</h4>
                                <div>
                                    <span class="btn btn-light rounded-pill px-4 py-2 text-uppercase fw-semibold fs-7 shadow-sm d-inline-flex align-items-center gap-2">
                                        Explore Department
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                            <polyline points="12 5 19 12 12 19"></polyline>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- REMOVED OLD CATEGORIES -->
            </section>

    <section id="new-arrival" class="new-arrival product-carousel py-5 position-relative overflow-hidden">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between align-items-center mt-5 mb-3">
                <h4 class="text-uppercase">Our New Arrivals</h4>
                <a href="/" class="btn-link">View All Products</a>
            </div>
            <div class="swiper product-swiper open-up" data-aos="zoom-out">
                <div class="swiper-wrapper d-flex">
                    @foreach ($newArrivals as $product)
                        <div class="swiper-slide">
                            <div class="product-item image-zoom-effect link-effect">
                                <div class="image-holder position-relative">
                                    <a href="{{ route('frontend.product', $product->slug) }}">

                                        @if($product->images->where('is_primary', true)->first())
                                            <img src="{{ $product->images->where('is_primary', true)->first()->image_path }}" alt="{{ $product->name }}"
                                                class="product-image img-fluid" style="height: 400px; width: 100%; object-fit: cover; border-radius: 8px;">
                                        @else
                                            <img src="https://via.placeholder.com/800x1200?text={{ urlencode($product->name) }}" alt="{{ $product->name }}"
                                                class="product-image img-fluid" style="height: 400px; width: 100%; object-fit: cover; border-radius: 8px;">
                                        @endif
                                    </a>
                                    <a href="/" class="btn-icon btn-wishlist">
                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                            <use xlink:href="#heart"></use>
                                        </svg>
                                    </a>
                                    <div class="product-content">
                                        <h5 class="element-title text-uppercase fs-5 mt-3">
                                            <a href="{{ route('frontend.product', $product->slug) }}">{{ $product->name }}</a>
                                        </h5>
                                        <a href="#" class="text-decoration-none"
                                            data-after="Add to cart"><span>${{ number_format($product->base_price, 2) }}</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
        <div class="icon-arrow icon-arrow-left"><svg width="50" height="50" viewBox="0 0 24 24">
                <use xlink:href="#arrow-left"></use>
            </svg></div>
        <div class="icon-arrow icon-arrow-right"><svg width="50" height="50" viewBox="0 0 24 24">
                <use xlink:href="#arrow-right"></use>
            </svg></div>
        </div>
    </section>

    <!-- Classic Winter Collection Section -->
    <section class="collection py-5 bg-light position-relative overflow-hidden">
        <div class="container py-3">
            <div class="row align-items-center g-0 collection-card bg-white border">

                <!-- Left: High-Res Editorial Campaign Image -->
                <div class="col-lg-6 col-md-12 p-0 overflow-hidden position-relative" style="min-height: 480px;">
                    <img src="{{ asset('images/single-image-2.jpg') }}" alt="Classic Winter Collection"
                        class="img-fluid w-100 h-100 object-fit-cover collection-img"
                        style="min-height: 480px; max-height: 580px;">
                    <div class="position-absolute top-0 start-0 m-4 z-2">
                        <span
                            class="badge bg-dark text-white px-3 py-2 rounded-pill text-uppercase fw-semibold shadow-sm"
                            style="letter-spacing: 2px; font-size: 0.78rem;">EDITORIAL CAPSULE 2026</span>
                    </div>
                </div>

                <!-- Right: Luxury Brand Narrative & Call to Action -->
                <div class="col-lg-6 col-md-12 p-4 p-md-5">
                    <div class="p-lg-3">
                        <span class="text-uppercase text-primary fw-bold d-block mb-2"
                            style="font-size: 0.8rem; letter-spacing: 2.5px;">AUTUMN / WINTER EDITION</span>
                        <h2 class="fw-bold text-dark text-uppercase mb-3 display-6"
                            style="letter-spacing: 1px; line-height: 1.2;">Classic Winter Collection</h2>

                        <p class="text-secondary mb-4" style="font-size: 0.95rem; line-height: 1.7;">
                            Our Classic Winter Collection celebrates the intersection of heritage craftsmanship and
                            contemporary minimalist design. Featuring plush cashmere knits, structured wool overcoats,
                            and versatile leather accents, each piece is engineered to keep you stylishly insulated
                            against the seasonal chill. We source only the finest ethical fabrics from Italian mills.
                        </p>

                        <!-- Key Feature Badges -->
                        <div class="row g-3 mb-4 text-dark" style="font-size: 0.85rem;">
                            <div class="col-6 d-flex align-items-center gap-2">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" class="text-primary">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <span class="fw-semibold">100% Italian Wool & Cashmere</span>
                            </div>
                            <div class="col-6 d-flex align-items-center gap-2">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" class="text-primary">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <span class="fw-semibold">Ethically Sourced Fabrics</span>
                            </div>
                            <div class="col-6 d-flex align-items-center gap-2">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" class="text-primary">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <span class="fw-semibold">Tailored Thermal Insulation</span>
                            </div>
                            <div class="col-6 d-flex align-items-center gap-2">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" class="text-primary">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <span class="fw-semibold">Limited Handcrafted Run</span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex flex-wrap align-items-center gap-3 pt-2">
                            <a href="#best-sellers"
                                class="btn btn-dark btn-lg rounded-pill px-5 py-3 text-uppercase fw-semibold shadow-sm d-inline-flex align-items-center gap-2 fs-6"
                                style="letter-spacing: 1px;">
                                Explore Collection
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalSizing"
                                class="btn btn-outline-secondary btn-lg rounded-pill px-4 py-3 text-uppercase fw-semibold fs-6">
                                Size & Fit Guide
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <section id="best-sellers" class="best-sellers product-carousel py-5 position-relative overflow-hidden">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between align-items-center mt-5 mb-3">
                <h4 class="text-uppercase">Best Selling Items</h4>
                <a href="/" class="btn-link">View All Products</a>
            </div>
            <div class="swiper product-swiper open-up" data-aos="zoom-out">
                <div class="swiper-wrapper d-flex">
                    @foreach ($bestSellers as $product)
                        <div class="swiper-slide">
                            <div class="product-item image-zoom-effect link-effect">
                                <div class="image-holder position-relative">
                                    <a href="{{ route('frontend.product', $product->slug) }}">

                                        @if($product->images->where('is_primary', true)->first())
                                            <img src="{{ $product->images->where('is_primary', true)->first()->image_path }}" alt="{{ $product->name }}"
                                                class="product-image img-fluid" style="height: 400px; width: 100%; object-fit: cover; border-radius: 8px;">
                                        @else
                                            <img src="https://via.placeholder.com/800x1200?text={{ urlencode($product->name) }}" alt="{{ $product->name }}"
                                                class="product-image img-fluid" style="height: 400px; width: 100%; object-fit: cover; border-radius: 8px;">
                                        @endif
                                    </a>
                                    <a href="/" class="btn-icon btn-wishlist">
                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                            <use xlink:href="#heart"></use>
                                        </svg>
                                    </a>
                                    <div class="product-content">
                                        <h5 class="element-title text-uppercase fs-5 mt-3">
                                            <a href="{{ route('frontend.product', $product->slug) }}">{{ $product->name }}</a>
                                        </h5>
                                        <a href="#" class="text-decoration-none"
                                            data-after="Add to cart"><span>${{ number_format($product->base_price, 2) }}</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
        <div class="icon-arrow icon-arrow-left"><svg width="50" height="50" viewBox="0 0 24 24">
                <use xlink:href="#arrow-left"></use>
            </svg></div>
        <div class="icon-arrow icon-arrow-right"><svg width="50" height="50" viewBox="0 0 24 24">
                <use xlink:href="#arrow-right"></use>
            </svg></div>
        </div>
    </section>

    <section class="video py-5 overflow-hidden">
        <div class="container-fluid">
            <div class="row">
                <div class="video-content open-up" data-aos="zoom-out">
                    <div class="video-bg">
                        <img src="{{ asset('images/video-image.jpg') }}" alt="video"
                            class="video-image img-fluid">
                    </div>
                    <div class="video-player">
                        <div class="position-relative d-inline-block">
                            <img src="{{ asset('images/text-pattern.png') }}" alt="pattern" class="text-rotate">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="testimonials py-5 bg-light">
        <div class="container">
            <div class="section-header text-center mb-4">
                <span class="text-uppercase text-primary fw-bold"
                    style="font-size: 0.8rem; letter-spacing: 2px;">Real Customer Reviews</span>
                <h3 class="section-title text-uppercase m-0 mt-1">WE LOVE GOOD COMPLIMENT</h3>
                <div class="mx-auto mt-2" style="width: 50px; height: 3px; background: var(--bs-primary, #8c907e);">
                </div>
            </div>
            <div class="swiper testimonial-swiper overflow-hidden py-3">
                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <div
                            class="testimonial-card p-4 p-md-5 bg-white rounded-4 shadow-sm border text-center h-100">
                            <div class="star-rating text-warning mb-3"
                                style="font-size: 1.1rem; letter-spacing: 2px;">
                                ★ ★ ★ ★ ★
                            </div>
                            <blockquote class="testimonial-text mb-4"
                                style="font-size: 1.05rem; line-height: 1.7; color: #333; font-style: italic;">
                                “The quality of the tailoring is simply extraordinary. The fabric breathes beautifully,
                                and the fit is flattering without feeling restrictive. Truly my favorite online shopping
                                discovery this year!”
                            </blockquote>
                            <div
                                class="reviewer-profile d-flex align-items-center justify-content-center gap-3 border-top pt-3">
                                <img src="{{ asset('images/insta-item1.jpg') }}" alt="Elena Rostova"
                                    class="rounded-circle object-fit-cover shadow-sm"
                                    style="width: 48px; height: 48px; border: 2px solid var(--bs-primary, #8c907e);">
                                <div class="text-start">
                                    <h6 class="m-0 fw-bold text-dark" style="font-size: 0.95rem;">Elena Rostova</h6>
                                    <small class="text-success fw-medium" style="font-size: 0.75rem;">Verified Buyer
                                        • Austria</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div
                            class="testimonial-card p-4 p-md-5 bg-white rounded-4 shadow-sm border text-center h-100">
                            <div class="star-rating text-warning mb-3"
                                style="font-size: 1.1rem; letter-spacing: 2px;">
                                ★ ★ ★ ★ ★
                            </div>
                            <blockquote class="testimonial-text mb-4"
                                style="font-size: 1.05rem; line-height: 1.7; color: #333; font-style: italic;">
                                “I ordered the winter wool overcoat and was blown away by the luxurious feel and
                                attention to detail. Fast global shipping and the packaging felt like opening a luxury
                                gift.”
                            </blockquote>
                            <div
                                class="reviewer-profile d-flex align-items-center justify-content-center gap-3 border-top pt-3">
                                <img src="{{ asset('images/insta-item2.jpg') }}" alt="Marcus Vance"
                                    class="rounded-circle object-fit-cover shadow-sm"
                                    style="width: 48px; height: 48px; border: 2px solid var(--bs-primary, #8c907e);">
                                <div class="text-start">
                                    <h6 class="m-0 fw-bold text-dark" style="font-size: 0.95rem;">Marcus Vance</h6>
                                    <small class="text-success fw-medium" style="font-size: 0.75rem;">Verified Buyer
                                        • Germany</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div
                            class="testimonial-card p-4 p-md-5 bg-white rounded-4 shadow-sm border text-center h-100">
                            <div class="star-rating text-warning mb-3"
                                style="font-size: 1.1rem; letter-spacing: 2px;">
                                ★ ★ ★ ★ ★
                            </div>
                            <blockquote class="testimonial-text mb-4"
                                style="font-size: 1.05rem; line-height: 1.7; color: #333; font-style: italic;">
                                “Unmatched customer service and effortless returns! The knitwear holds its shape
                                perfectly even after multiple washes. Worth every single penny for such timeless
                                wardrobe staples.”
                            </blockquote>
                            <div
                                class="reviewer-profile d-flex align-items-center justify-content-center gap-3 border-top pt-3">
                                <img src="{{ asset('images/insta-item3.jpg') }}" alt="Sophia Laurent"
                                    class="rounded-circle object-fit-cover shadow-sm"
                                    style="width: 48px; height: 48px; border: 2px solid var(--bs-primary, #8c907e);">
                                <div class="text-start">
                                    <h6 class="m-0 fw-bold text-dark" style="font-size: 0.95rem;">Sophia Laurent
                                    </h6>
                                    <small class="text-success fw-medium" style="font-size: 0.75rem;">Verified Buyer
                                        • France</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div
                            class="testimonial-card p-4 p-md-5 bg-white rounded-4 shadow-sm border text-center h-100">
                            <div class="star-rating text-warning mb-3"
                                style="font-size: 1.1rem; letter-spacing: 2px;">
                                ★ ★ ★ ★ ★
                            </div>
                            <blockquote class="testimonial-text mb-4"
                                style="font-size: 1.05rem; line-height: 1.7; color: #333; font-style: italic;">
                                “Kaira has completely transformed my daily aesthetic. Clean silhouettes, premium
                                fabrics, and subtle design nuances make these pieces stand out in any professional
                                setting.”
                            </blockquote>
                            <div
                                class="reviewer-profile d-flex align-items-center justify-content-center gap-3 border-top pt-3">
                                <img src="{{ asset('images/insta-item4.jpg') }}" alt="David K."
                                    class="rounded-circle object-fit-cover shadow-sm"
                                    style="width: 48px; height: 48px; border: 2px solid var(--bs-primary, #8c907e);">
                                <div class="text-start">
                                    <h6 class="m-0 fw-bold text-dark" style="font-size: 0.95rem;">David K.</h6>
                                    <small class="text-success fw-medium" style="font-size: 0.75rem;">Verified Buyer
                                        • USA</small>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="testimonial-swiper-pagination d-flex justify-content-center mt-4"></div>
        </div>
    </section>


    <section id="blog" class="blog py-5 bg-white">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between align-items-end mt-4 mb-4 pb-2 border-bottom">
                <div>
                    <span class="text-uppercase text-primary fw-bold"
                        style="font-size: 0.8rem; letter-spacing: 2px;">Editorial Insights</span>
                    <h3 class="section-title text-uppercase m-0 mt-1"
                        style="font-weight: 700; letter-spacing: 1px;">READ BLOG POSTS</h3>
                </div>
                <a href="#blog" class="btn-link text-uppercase fw-semibold" style="letter-spacing: 1px;">View
                    All Posts →</a>
            </div>
            <div class="row g-4">

                <div class="col-md-4">
                    <article class="blog-card h-100 d-flex flex-column">
                        <div class="blog-img-wrapper">
                            <span class="blog-badge">Styling Tips</span>
                            <a href="#blog">
                                <img src="{{ asset('images/post-image1.jpg') }}"
                                    alt="How to Look Outstanding in Pastel" class="img-fluid">
                            </a>
                        </div>
                        <div class="blog-content p-4 d-flex flex-column flex-grow-1">
                            <div class="text-uppercase text-muted fw-medium mb-2"
                                style="font-size: 0.78rem; letter-spacing: 1px;">
                                <span>JUL 11, 2022</span> • <span>5 MIN READ</span>
                            </div>
                            <h5 class="fw-bold mb-3" style="font-size: 1.15rem; line-height: 1.4;">
                                <a href="#blog" class="blog-title-link">How to Look Outstanding in Pastel</a>
                            </h5>
                            <p class="text-secondary mb-4 flex-grow-1"
                                style="font-size: 0.92rem; line-height: 1.6;">
                                Master the delicate art of incorporating muted tones into your seasonal wardrobe.
                                Discover how pairing soft lavender, sage green, and blush pink with neutral tailoring
                                creates a sophisticated silhouette.
                            </p>
                            <div class="border-top pt-3 mt-auto d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{ asset('images/insta-item1.jpg') }}" alt="Clara Dupont"
                                        class="rounded-circle object-fit-cover" style="width: 32px; height: 32px;">
                                    <span class="fw-medium text-dark" style="font-size: 0.85rem;">Clara
                                        Dupont</span>
                                </div>
                                <a href="#blog" class="fw-semibold text-primary text-decoration-none"
                                    style="font-size: 0.85rem;">Read Article →</a>
                            </div>
                        </div>
                    </article>
                </div>

                <div class="col-md-4">
                    <article class="blog-card h-100 d-flex flex-column">
                        <div class="blog-img-wrapper">
                            <span class="blog-badge">Trend Report</span>
                            <a href="#blog">
                                <img src="{{ asset('images/post-image2.jpg') }}"
                                    alt="Top 10 Fashion Trend For Summer" class="img-fluid">
                            </a>
                        </div>
                        <div class="blog-content p-4 d-flex flex-column flex-grow-1">
                            <div class="text-uppercase text-muted fw-medium mb-2"
                                style="font-size: 0.78rem; letter-spacing: 1px;">
                                <span>JUL 11, 2022</span> • <span>4 MIN READ</span>
                            </div>
                            <h5 class="fw-bold mb-3" style="font-size: 1.15rem; line-height: 1.4;">
                                <a href="#blog" class="blog-title-link">Top 10 Fashion Trends for Summer</a>
                            </h5>
                            <p class="text-secondary mb-4 flex-grow-1"
                                style="font-size: 0.92rem; line-height: 1.6;">
                                From lightweight linen ensembles and oversized tailoring to breathable open-weave knits,
                                explore the top curated trends dominating runway shows and urban street style this
                                season.
                            </p>
                            <div class="border-top pt-3 mt-auto d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{ asset('images/insta-item2.jpg') }}" alt="Julian Vance"
                                        class="rounded-circle object-fit-cover" style="width: 32px; height: 32px;">
                                    <span class="fw-medium text-dark" style="font-size: 0.85rem;">Julian
                                        Vance</span>
                                </div>
                                <a href="#blog" class="fw-semibold text-primary text-decoration-none"
                                    style="font-size: 0.85rem;">Read Article →</a>
                            </div>
                        </div>
                    </article>
                </div>

                <div class="col-md-4">
                    <article class="blog-card h-100 d-flex flex-column">
                        <div class="blog-img-wrapper">
                            <span class="blog-badge">Editorial</span>
                            <a href="#blog">
                                <img src="{{ asset('images/post-image3.jpg') }}"
                                    alt="Crazy Fashion With Unique Moment" class="img-fluid">
                            </a>
                        </div>
                        <div class="blog-content p-4 d-flex flex-column flex-grow-1">
                            <div class="text-uppercase text-muted fw-medium mb-2"
                                style="font-size: 0.78rem; letter-spacing: 1px;">
                                <span>JUL 11, 2022</span> • <span>6 MIN READ</span>
                            </div>
                            <h5 class="fw-bold mb-3" style="font-size: 1.15rem; line-height: 1.4;">
                                <a href="#blog" class="blog-title-link">Crazy Fashion with Unique Moment</a>
                            </h5>
                            <p class="text-secondary mb-4 flex-grow-1"
                                style="font-size: 0.92rem; line-height: 1.6;">
                                Uncover the inspiration behind our latest limited-edition capsule collection. We explore
                                how bold architectural lines and vintage textures blend to create standout statement
                                garments.
                            </p>
                            <div class="border-top pt-3 mt-auto d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{ asset('images/insta-item3.jpg') }}" alt="Sophia Laurent"
                                        class="rounded-circle object-fit-cover" style="width: 32px; height: 32px;">
                                    <span class="fw-medium text-dark" style="font-size: 0.85rem;">Sophia
                                        Laurent</span>
                                </div>
                                <a href="#blog" class="fw-semibold text-primary text-decoration-none"
                                    style="font-size: 0.85rem;">Read Article →</a>
                            </div>
                        </div>
                    </article>
                </div>

            </div>
        </div>
    </section>


    <!-- Newsletter Section -->
    <section class="newsletter py-5 bg-white position-relative border-top border-bottom">
        <div class="container py-4">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 text-center">
                    <div class="newsletter-card p-4 p-md-5 bg-light rounded-4 border shadow-sm">
                        <span class="text-uppercase text-primary fw-bold d-block mb-2"
                            style="font-size: 0.8rem; letter-spacing: 2px;">Join the Kaira VIP Club</span>
                        <h3 class="section-title text-uppercase m-0 mb-3"
                            style="font-weight: 700; letter-spacing: 1px;">SIGN UP FOR OUR NEWSLETTER</h3>
                        <p class="text-secondary mb-4 mx-auto"
                            style="max-width: 580px; font-size: 0.95rem; line-height: 1.6;">
                            Subscribe to receive 15% off your first luxury order, exclusive access to capsule collection
                            launches, and private editorial invites.
                        </p>
                        <form id="form" class="newsletter-form mx-auto" style="max-width: 540px;"
                            onsubmit="event.preventDefault(); alert('Thank you for subscribing to Kaira VIP!'); this.reset();">
                            <div class="input-group input-group-lg shadow-sm rounded-pill overflow-hidden border">
                                <input type="email" name="email" required
                                    placeholder="Enter your email address..."
                                    class="form-control border-0 ps-4 fs-6" style="background: #fff;">
                                <button type="submit" class="btn btn-dark px-4 fs-6 text-uppercase fw-semibold"
                                    style="letter-spacing: 1px;">Subscribe</button>
                            </div>
                        </form>
                        <div class="mt-3 text-muted" style="font-size: 0.78rem;">
                            <span>🔒 We respect your privacy. Unsubscribe anytime.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Instagram Section -->
    <section class="instagram py-5 bg-light position-relative overflow-hidden">
        <div class="container text-center mb-4">
            <span class="text-uppercase text-primary fw-bold d-block mb-1"
                style="font-size: 0.8rem; letter-spacing: 2px;">@KAIRAMODE ON INSTAGRAM</span>
            <h3 class="section-title text-uppercase m-0" style="font-weight: 700; letter-spacing: 1px;">
                #KAIRACOLLECTIVE</h3>
        </div>

        <div class="position-relative">
            <div class="d-flex justify-content-center w-100 position-absolute top-50 start-50 translate-middle z-3">
                <a href="https://www.instagram.com" target="_blank"
                    class="btn btn-dark btn-lg rounded-pill px-4 py-3 shadow-lg d-flex align-items-center gap-2 text-uppercase fw-semibold"
                    style="letter-spacing: 1.5px; font-size: 0.85rem; border: 2px solid rgba(255,255,255,0.2);">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <use xlink:href="#instagram"></use>
                    </svg>
                    Follow Us On Instagram
                </a>
            </div>

            <div class="row g-0 position-relative">
                <div class="col-6 col-sm-4 col-md-2">
                    <div class="insta-item overflow-hidden position-relative">
                        <a href="https://www.instagram.com" target="_blank" class="d-block text-decoration-none">
                            <img src="{{ asset('images/insta-item1.jpg') }}" alt="instagram"
                                class="img-fluid w-100 object-fit-cover insta-img"
                                style="height: 240px; transition: transform 0.4s ease;">
                            <div
                                class="insta-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-40 opacity-0">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="#ffffff">
                                    <use xlink:href="#instagram"></use>
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-md-2">
                    <div class="insta-item overflow-hidden position-relative">
                        <a href="https://www.instagram.com" target="_blank" class="d-block text-decoration-none">
                            <img src="{{ asset('images/insta-item2.jpg') }}" alt="instagram"
                                class="img-fluid w-100 object-fit-cover insta-img"
                                style="height: 240px; transition: transform 0.4s ease;">
                            <div
                                class="insta-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-40 opacity-0">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="#ffffff">
                                    <use xlink:href="#instagram"></use>
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-md-2">
                    <div class="insta-item overflow-hidden position-relative">
                        <a href="https://www.instagram.com" target="_blank" class="d-block text-decoration-none">
                            <img src="{{ asset('images/insta-item3.jpg') }}" alt="instagram"
                                class="img-fluid w-100 object-fit-cover insta-img"
                                style="height: 240px; transition: transform 0.4s ease;">
                            <div
                                class="insta-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-40 opacity-0">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="#ffffff">
                                    <use xlink:href="#instagram"></use>
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-md-2">
                    <div class="insta-item overflow-hidden position-relative">
                        <a href="https://www.instagram.com" target="_blank" class="d-block text-decoration-none">
                            <img src="{{ asset('images/insta-item4.jpg') }}" alt="instagram"
                                class="img-fluid w-100 object-fit-cover insta-img"
                                style="height: 240px; transition: transform 0.4s ease;">
                            <div
                                class="insta-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-40 opacity-0">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="#ffffff">
                                    <use xlink:href="#instagram"></use>
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-md-2">
                    <div class="insta-item overflow-hidden position-relative">
                        <a href="https://www.instagram.com" target="_blank" class="d-block text-decoration-none">
                            <img src="{{ asset('images/insta-item5.jpg') }}" alt="instagram"
                                class="img-fluid w-100 object-fit-cover insta-img"
                                style="height: 240px; transition: transform 0.4s ease;">
                            <div
                                class="insta-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-40 opacity-0">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="#ffffff">
                                    <use xlink:href="#instagram"></use>
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-md-2">
                    <div class="insta-item overflow-hidden position-relative">
                        <a href="https://www.instagram.com" target="_blank" class="d-block text-decoration-none">
                            <img src="{{ asset('images/insta-item6.jpg') }}" alt="instagram"
                                class="img-fluid w-100 object-fit-cover insta-img"
                                style="height: 240px; transition: transform 0.4s ease;">
                            <div
                                class="insta-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-40 opacity-0">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="#ffffff">
                                    <use xlink:href="#instagram"></use>
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

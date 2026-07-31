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
                            <h4 class="fw-bold m-0" style="letter-spacing: -0.5px;">Welcome back, {{ explode(' ', auth()->user()->name)[0] }}!</h4>
                        </div>
                        <p class="text-muted mb-5" style="font-size: 0.95rem; line-height: 1.6;">From your account dashboard, you can view your recent orders, manage your shipping and billing addresses, set your sizing preferences, and edit your password and account details.</p>
                        
                        <div class="row g-4 mb-5">
                            <div class="col-md-6">
                                <div class="p-4 rounded-4 position-relative overflow-hidden h-100 d-flex flex-column" style="background: linear-gradient(135deg, #111 0%, #333 100%); color: white;">
                                    <div class="position-absolute" style="top: -20px; right: -20px; width: 100px; height: 100px; background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%); border-radius: 50%;"></div>
                                    <h6 class="text-uppercase fw-bold mb-3" style="font-size: 0.75rem; letter-spacing: 2px; color: rgba(255,255,255,0.7);">Wallet Balance</h6>
                                    <h2 class="display-5 fw-bold mb-0 mt-auto">${{ number_format($walletBalance, 2) }}</h2>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-4 bg-light rounded-4 border h-100 d-flex flex-column position-relative overflow-hidden shadow-sm">
                                    <h6 class="text-uppercase fw-bold mb-3 text-muted" style="font-size: 0.75rem; letter-spacing: 2px;">Loyalty Points</h6>
                                    <h2 class="display-5 fw-bold text-dark mb-0 mt-auto">{{ number_format($loyaltyPoints) }} <small class="fs-6 text-muted">pts</small></h2>
                                </div>
                            </div>
                        </div>

                        <!-- My Preferences Section -->
                        <div class="mb-5">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h5 class="fw-bold m-0"><i class="bi bi-sliders me-2 text-dark"></i> My Preferences & Sizes</h5>
                                <button class="btn btn-outline-dark btn-sm rounded-pill px-3" onclick="alert('Settings saved!');">Save Preferences</button>
                            </div>
                            <div class="card border border-light-subtle shadow-sm rounded-4">
                                <div class="card-body p-4">
                                    <p class="text-muted small mb-4">Set your sizing preferences so we can recommend the perfect fit for you across our catalog.</p>
                                    <div class="row g-4">
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold small text-uppercase" style="letter-spacing: 1px;">Top Size</label>
                                            <select class="form-select form-select-lg border-0 bg-light rounded-3 shadow-none">
                                                <option>XS - Extra Small</option>
                                                <option>S - Small</option>
                                                <option selected>M - Medium</option>
                                                <option>L - Large</option>
                                                <option>XL - Extra Large</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold small text-uppercase" style="letter-spacing: 1px;">Bottom Size</label>
                                            <select class="form-select form-select-lg border-0 bg-light rounded-3 shadow-none">
                                                <option>28 - 30 (S)</option>
                                                <option selected>32 - 34 (M)</option>
                                                <option>36 - 38 (L)</option>
                                                <option>40 - 42 (XL)</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold small text-uppercase" style="letter-spacing: 1px;">Shoe Size (US)</label>
                                            <select class="form-select form-select-lg border-0 bg-light rounded-3 shadow-none">
                                                <option>8</option>
                                                <option>9</option>
                                                <option selected>10</option>
                                                <option>11</option>
                                                <option>12</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr class="my-4 text-light-subtle">
                                    <div class="form-check form-switch mt-3">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                        <label class="form-check-label fw-medium ms-2" for="flexSwitchCheckChecked">Enable personalized size recommendations while shopping</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="p-4 rounded-4 border h-100 d-flex flex-column shadow-sm transition-all hover-shadow" style="background-color: #fafafb;">
                                    <h5 class="fw-bold mb-3"><i class="bi bi-box-seam me-2 text-dark"></i> Recent Orders</h5>
                                    <p class="text-muted small mb-4 flex-grow-1">Check the status of your recent orders, view order details, and track shipments.</p>
                                    <a href="{{ route('dashboard.orders') }}" class="btn btn-dark w-100 mt-auto rounded-3">View Orders</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-4 rounded-4 border h-100 d-flex flex-column shadow-sm transition-all hover-shadow" style="background-color: #fafafb;">
                                    <h5 class="fw-bold mb-3"><i class="bi bi-heart me-2 text-danger"></i> Wishlist</h5>
                                    <p class="text-muted small mb-4 flex-grow-1">Access your saved items, move them to your cart, or share them with friends.</p>
                                    <a href="{{ route('wishlist') }}" class="btn btn-outline-dark w-100 mt-auto rounded-3">View Wishlist</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

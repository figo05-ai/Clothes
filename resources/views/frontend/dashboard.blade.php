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
                        <div class="d-flex align-items-center mb-4 pb-2 border-bottom">
                            <h4 class="fw-bold m-0" style="letter-spacing: -0.5px;">{{ __('Welcome back') }}, {{ explode(' ', auth()->user()->name)[0] }}!</h4>
                        </div>
                        <p class="text-muted mb-5" style="font-size: 0.95rem; line-height: 1.6;">{{ __('Welcome to your personalized account dashboard. From here, you can seamlessly navigate through your recent orders, review your wishlist, and update your personal sizing and fit preferences.') }}</p>
                        
                        <div class="row g-4 mb-5">
                            <div class="col-md-6">
                                <div class="p-4 rounded-4 position-relative overflow-hidden h-100 d-flex flex-column shadow-sm transition-all" style="background: linear-gradient(135deg, #1f1f21 0%, #3a3a3d 100%); color: white;">
                                    <div class="position-absolute" style="top: -20px; right: -20px; width: 120px; height: 120px; background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%); border-radius: 50%;"></div>
                                    <h6 class="text-uppercase fw-bold mb-3" style="font-size: 0.75rem; letter-spacing: 2px; color: rgba(255,255,255,0.7);">{{ __('Wallet Balance') }}</h6>
                                    <h2 class="display-5 fw-bold mb-0 mt-auto">${{ number_format($walletBalance, 2) }}</h2>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-4 rounded-4 border h-100 d-flex flex-column position-relative overflow-hidden shadow-sm" style="background-color: #fafafb;">
                                    <h6 class="text-uppercase fw-bold mb-3 text-muted" style="font-size: 0.75rem; letter-spacing: 2px;">{{ __('Loyalty Points') }}</h6>
                                    <h2 class="display-5 fw-bold text-dark mb-0 mt-auto">{{ number_format($loyaltyPoints) }} <small class="fs-6 text-muted">{{ __('pts') }}</small></h2>
                                </div>
                            </div>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <a href="{{ route('dashboard.orders') }}" class="text-decoration-none">
                                    <div class="p-4 rounded-4 border h-100 d-flex flex-column shadow-sm transition-all text-dark" style="background-color: #ffffff; transition: transform 0.2s ease, box-shadow 0.2s ease;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 20px rgba(0,0,0,0.05)';" onmouseout="this.style.transform='none'; this.style.boxShadow='0 0.125rem 0.25rem rgba(0, 0, 0, 0.075)';">
                                        <div class="mb-4">
                                            <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle" style="width: 50px; height: 50px;">
                                                <i class="bi bi-box-seam fs-4 text-dark"></i>
                                            </div>
                                        </div>
                                        <h5 class="fw-bold mb-2">{{ __('Order History') }}</h5>
                                        <p class="text-muted small mb-0 flex-grow-1">{{ __('Check the status of your recent orders, view order details, and track shipments seamlessly.') }}</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('dashboard.preferences') }}" class="text-decoration-none">
                                    <div class="p-4 rounded-4 border h-100 d-flex flex-column shadow-sm transition-all text-dark" style="background-color: #ffffff; transition: transform 0.2s ease, box-shadow 0.2s ease;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 20px rgba(0,0,0,0.05)';" onmouseout="this.style.transform='none'; this.style.boxShadow='0 0.125rem 0.25rem rgba(0, 0, 0, 0.075)';">
                                        <div class="mb-4">
                                            <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle" style="width: 50px; height: 50px;">
                                                <i class="bi bi-sliders fs-4 text-dark"></i>
                                            </div>
                                        </div>
                                        <h5 class="fw-bold mb-2">{{ __('My Preferences') }}</h5>
                                        <p class="text-muted small mb-0 flex-grow-1">{{ __('Update your sizing, style preferences, and personalized shopping recommendations.') }}</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('wishlist') }}" class="text-decoration-none">
                                    <div class="p-4 rounded-4 border h-100 d-flex flex-column shadow-sm transition-all text-dark" style="background-color: #ffffff; transition: transform 0.2s ease, box-shadow 0.2s ease;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 20px rgba(0,0,0,0.05)';" onmouseout="this.style.transform='none'; this.style.boxShadow='0 0.125rem 0.25rem rgba(0, 0, 0, 0.075)';">
                                        <div class="mb-4">
                                            <div class="d-inline-flex align-items-center justify-content-center bg-danger-subtle rounded-circle" style="width: 50px; height: 50px;">
                                                <i class="bi bi-heart fs-4 text-danger"></i>
                                            </div>
                                        </div>
                                        <h5 class="fw-bold mb-2">{{ __('My Wishlist') }}</h5>
                                        <p class="text-muted small mb-0 flex-grow-1">{{ __('Access your saved items, move them to your cart, or share them with friends.') }}</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('returns') }}" class="text-decoration-none">
                                    <div class="p-4 rounded-4 border h-100 d-flex flex-column shadow-sm transition-all text-dark" style="background-color: #ffffff; transition: transform 0.2s ease, box-shadow 0.2s ease;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 20px rgba(0,0,0,0.05)';" onmouseout="this.style.transform='none'; this.style.boxShadow='0 0.125rem 0.25rem rgba(0, 0, 0, 0.075)';">
                                        <div class="mb-4">
                                            <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle" style="width: 50px; height: 50px;">
                                                <i class="bi bi-arrow-return-left fs-4 text-dark"></i>
                                            </div>
                                        </div>
                                        <h5 class="fw-bold mb-2">{{ __('Returns & Refunds') }}</h5>
                                        <p class="text-muted small mb-0 flex-grow-1">{{ __('Initiate a return, download shipping labels, and track your refund status.') }}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

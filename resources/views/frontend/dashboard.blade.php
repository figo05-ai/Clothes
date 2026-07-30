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
                        <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action p-3 active fw-semibold">
                            <i class="bi bi-person me-2"></i> Dashboard
                        </a>
                        <a href="{{ route('dashboard.orders') }}" class="list-group-item list-group-item-action p-3">
                            <i class="bi bi-box-seam me-2"></i> Order History
                        </a>
                        <a href="{{ route('wishlist') }}" class="list-group-item list-group-item-action p-3">
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
                        <h4 class="fw-bold mb-4">Welcome back, {{ explode(' ', auth()->user()->name)[0] }}!</h4>
                        <p class="text-muted mb-5">From your account dashboard, you can view your recent orders, manage your shipping and billing addresses, and edit your password and account details.</p>
                        
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <div class="p-4 bg-primary bg-opacity-10 rounded-3 border border-primary border-opacity-25 h-100 d-flex flex-column align-items-center text-center justify-content-center">
                                    <h6 class="text-uppercase text-muted fw-bold mb-2">Wallet Balance</h6>
                                    <h2 class="display-6 fw-bold text-primary mb-0">${{ number_format($walletBalance, 2) }}</h2>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-4 bg-success bg-opacity-10 rounded-3 border border-success border-opacity-25 h-100 d-flex flex-column align-items-center text-center justify-content-center">
                                    <h6 class="text-uppercase text-muted fw-bold mb-2">Loyalty Points</h6>
                                    <h2 class="display-6 fw-bold text-success mb-0">{{ number_format($loyaltyPoints) }} <small class="fs-6">pts</small></h2>
                                </div>
                            </div>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="p-4 bg-light rounded-3 border h-100 d-flex flex-column">
                                    <h5 class="fw-bold mb-3"><i class="bi bi-box-seam me-2 text-primary"></i> Recent Orders</h5>
                                    <p class="text-muted small mb-4 flex-grow-1">Check the status of your recent orders, view order details, and track shipments.</p>
                                    <a href="{{ route('dashboard.orders') }}" class="btn btn-outline-dark btn-sm w-100 mt-auto">View Orders</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-4 bg-light rounded-3 border h-100 d-flex flex-column">
                                    <h5 class="fw-bold mb-3"><i class="bi bi-heart me-2 text-primary"></i> Wishlist</h5>
                                    <p class="text-muted small mb-4 flex-grow-1">Access your saved items, move them to your cart, or share them with friends.</p>
                                    <a href="{{ route('wishlist') }}" class="btn btn-outline-dark btn-sm w-100 mt-auto">View Wishlist</a>
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

@extends('layouts.store')

@section('content')
<section class="py-5 mt-5">
    <div class="container text-center py-5">
        <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#28a745" stroke-width="2" class="mb-4">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
            <polyline points="22 4 12 14.01 9 11.01"></polyline>
        </svg>
        <h1 class="display-5 fw-bold mb-3">Order Placed Successfully!</h1>
        <p class="lead text-muted mb-4">Thank you for your purchase. We have received your order.</p>
        
        @if(isset($orderId) && $orderId)
            <div class="card bg-light border-0 d-inline-block px-5 py-3 mb-5">
                <p class="mb-0 text-secondary">Your Order ID is:</p>
                <h4 class="fw-bold mb-0 text-primary">#{{ $orderId }}</h4>
            </div>
        @endif

        <div>
            <a href="/" class="btn btn-dark btn-lg rounded-pill px-5 text-uppercase fw-semibold">Continue Shopping</a>
        </div>
    </div>
</section>
@endsection

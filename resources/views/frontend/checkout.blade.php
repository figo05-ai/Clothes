@extends('layouts.store')

@section('content')
<section class="py-5 mt-5 bg-light">
    <div class="container">
        <h2 class="mb-4 text-uppercase fw-bold">Checkout</h2>
        <div class="row">
            <div class="col-md-8">
                <!-- Shipping Details -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h4 class="mb-4">Shipping Address</h4>
                        <form id="checkout-form">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">First Name *</label>
                                    <input type="text" class="form-control" name="first_name" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Last Name *</label>
                                    <input type="text" class="form-control" name="last_name" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Email Address *</label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Street Address *</label>
                                    <input type="text" class="form-control" name="address" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Country *</label>
                                    <select class="form-select" name="country" required>
                                        <option value="US">United States</option>
                                        <option value="UK">United Kingdom</option>
                                        <option value="EG">Egypt</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">City *</label>
                                    <input type="text" class="form-control" name="city" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Zip Code *</label>
                                    <input type="text" class="form-control" name="postal_code" required>
                                </div>
                                <div class="col-12 mt-4">
                                    <h4 class="mb-3">Payment Method</h4>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="payment_cod" value="cod" checked>
                                        <label class="form-check-label" for="payment_cod">
                                            Cash on Delivery (COD)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="payment_card" value="credit_card">
                                        <label class="form-check-label" for="payment_card">
                                            Credit / Debit Card
                                        </label>
                                    </div>
                                    @auth
                                    @if($walletIsActive)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="payment_wallet" value="wallet" @if($walletBalance < $total) disabled @endif>
                                        <label class="form-check-label" for="payment_wallet">
                                            Wallet Balance <span class="badge bg-dark ms-2">${{ number_format($walletBalance, 2) }}</span>
                                            @if($walletBalance < $total)
                                                <small class="text-danger d-block mt-1">Insufficient balance for this order.</small>
                                            @endif
                                        </label>
                                    </div>
                                    @endif
                                    @endauth
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <!-- Order Summary -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h4 class="mb-4">Order Summary</h4>
                        <ul class="list-group mb-3 list-group-flush">
                            @foreach($cart as $item)
                                <li class="list-group-item d-flex justify-content-between lh-sm px-0">
                                    <div>
                                        <h6 class="my-0">{{ $item['name'] }}</h6>
                                        <small class="text-body-secondary">Qty: {{ $item['quantity'] }}</small>
                                    </div>
                                    <span class="text-body-secondary">${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                                </li>
                            @endforeach
                            <li class="list-group-item d-flex justify-content-between px-0 bg-transparent mt-2">
                                <span>Subtotal</span>
                                <strong>${{ number_format($subtotal, 2) }}</strong>
                            </li>
                            @if(isset($discount) && $discount > 0)
                            <li class="list-group-item d-flex justify-content-between px-0 bg-transparent text-success" id="discount-row">
                                <span>Discount @if($coupon) ({{ $coupon['code'] }}) @endif</span>
                                <strong id="discount-amount">-${{ number_format($discount, 2) }}</strong>
                            </li>
                            @endif
                            <li class="list-group-item d-flex justify-content-between px-0 bg-transparent fs-5 border-top-0 pt-0 mt-2">
                                <span>Total (USD)</span>
                                <strong id="final-total">${{ number_format($total, 2) }}</strong>
                            </li>
                        </ul>

                        <!-- Coupon Form -->
                        <form class="card p-2 border-0 bg-light" id="coupon-form">
                            <div class="input-group">
                                <input type="text" class="form-control border-0" id="coupon_code" placeholder="Promo code">
                                <button type="submit" class="btn btn-dark px-4">Redeem</button>
                            </div>
                        </form>
                        
                        <div id="coupon-message" class="mt-2 small"></div>

                        <button class="w-100 btn btn-primary btn-lg mt-4 text-uppercase fw-bold shadow-sm" type="button" id="place-order-btn">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Handle Coupon Apply
    document.getElementById('coupon-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const code = document.getElementById('coupon_code').value;
        const msgDiv = document.getElementById('coupon-message');
        
        if(!code) return;
        
        fetch('/api/coupons/apply', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ code: code })
        })
        .then(res => res.json())
        .then(data => {
            if(data.success || data.data) {
                // Adjust total based on coupon response
                msgDiv.innerHTML = `<span class="text-success">Coupon applied successfully!</span>`;
                // Wait, does the API return discount amount? We might need to refresh or parse it.
                // Assuming standard reload for simplicity or parse discount from data.
                window.location.reload();
            } else {
                msgDiv.innerHTML = `<span class="text-danger">${data.message || 'Invalid coupon'}</span>`;
            }
        })
        .catch(err => {
            msgDiv.innerHTML = `<span class="text-danger">Failed to apply coupon</span>`;
        });
    });

    // Handle Place Order
    document.getElementById('place-order-btn').addEventListener('click', function(e) {
        e.preventDefault();
        const form = document.getElementById('checkout-form');
        if(!form.checkValidity()) {
            form.reportValidity();
            return;
        }
        
        const btn = this;
        btn.disabled = true;
        btn.innerHTML = 'Processing...';
        
        const formData = new FormData(form);
        const data = Object.fromEntries(formData.entries());
        
        // Shipping address should be sent as string per CheckoutRequest rules
        const fullAddress = `${data.first_name} ${data.last_name}, ${data.address}, ${data.city}, ${data.country}, ${data.postal_code}`;
        
        let paymentMethod = data.payment_method;
        if(paymentMethod === 'cod') paymentMethod = 'cash_on_delivery';

        const payload = {
            payment_method: paymentMethod,
            shipping_address: fullAddress,
            billing_address: fullAddress,
            shipping_cost: 0,
            tax_amount: 0
        };

        fetch('/api/checkout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify(payload)
        })
        .then(res => res.json())
        .then(resData => {
            if(resData.id || resData.data?.id) {
                window.location.href = '/order-success?id=' + (resData.id || resData.data.id);
            } else {
                alert('Error placing order: ' + (resData.message || 'Unknown error'));
                btn.disabled = false;
                btn.innerHTML = 'Place Order';
            }
        })
        .catch(err => {
            console.error(err);
            alert('Failed to place order.');
            btn.disabled = false;
            btn.innerHTML = 'Place Order';
        });
    });
});
</script>
@endsection

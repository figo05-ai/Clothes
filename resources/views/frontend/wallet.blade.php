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
                            <h4 class="fw-bold m-0" style="letter-spacing: -0.5px;">{{ __('My Wallet') }}</h4>
                        </div>
                        
                        <!-- Balance Card -->
                        <div class="p-4 rounded-4 position-relative overflow-hidden mb-5 shadow-sm transition-all" style="background: linear-gradient(135deg, #1f1f21 0%, #3a3a3d 100%); color: white;">
                            <div class="position-absolute" style="top: -20px; right: -20px; width: 120px; height: 120px; background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%); border-radius: 50%;"></div>
                            
                            <div class="d-flex justify-content-between align-items-start position-relative z-index-1">
                                <div>
                                    <h6 class="text-uppercase fw-bold mb-3" style="font-size: 0.75rem; letter-spacing: 2px; color: rgba(255,255,255,0.7);">{{ __('Current Balance') }}</h6>
                                    <h2 class="display-3 fw-bold mb-0">${{ number_format($balance, 2) }}</h2>
                                </div>
                                <div class="text-end">
                                    <form method="POST" action="{{ route('frontend.wallet.toggle') }}" class="mb-3">
                                        @csrf
                                        <input type="hidden" name="is_active" value="{{ $isActive ? 0 : 1 }}">
                                        <div class="form-check form-switch d-inline-block">
                                            <input class="form-check-input" type="checkbox" role="switch" id="walletStatusToggle" onchange="this.form.submit()" {{ $isActive ? 'checked' : '' }} style="cursor: pointer; width: 3em; height: 1.5em;">
                                            <label class="form-check-label ms-2 fw-medium text-white" for="walletStatusToggle" style="cursor: pointer;">
                                                {{ $isActive ? __('Active') : __('Disabled') }}
                                            </label>
                                        </div>
                                    </form>
                                    <button type="button" class="btn btn-light fw-bold rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#topUpModal">
                                        <i class="bi bi-plus-lg me-1"></i> {{ __('Top Up') }}
                                    </button>
                                </div>
                            </div>
                            @if(!$isActive)
                                <div class="mt-4 p-3 rounded bg-danger bg-opacity-25 border border-danger border-opacity-50 text-white small">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ __('Your wallet is currently disabled. You will not be able to use your balance for checkout.') }}
                                </div>
                            @endif
                        </div>

                        <!-- Top Up Modal -->
                        <div class="modal fade" id="topUpModal" tabindex="-1" aria-labelledby="topUpModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                                    <div class="modal-header bg-light border-0 px-4 py-3">
                                        <h5 class="modal-title fw-bold" id="topUpModalLabel">{{ __('Top Up Wallet') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('frontend.wallet.topup') }}" method="POST">
                                        @csrf
                                        <div class="modal-body p-4">
                                            <div class="mb-4">
                                                <label class="form-label fw-bold">{{ __('Amount (USD)') }}</label>
                                                <div class="input-group input-group-lg">
                                                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-currency-dollar"></i></span>
                                                    <input type="number" class="form-control border-start-0 ps-0" name="amount" min="5" max="10000" step="0.01" required placeholder="50.00">
                                                </div>
                                                <div class="form-text">{{ __('Minimum amount is $5.00') }}</div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">{{ __('Payment Method') }}</label>
                                                <div class="row g-3">
                                                    <div class="col-6">
                                                        <input type="radio" class="btn-check" name="payment_method" id="topup_card" value="credit_card" checked required onchange="togglePaymentForms()">
                                                        <label class="btn btn-outline-dark w-100 p-3 rounded-3 text-start" for="topup_card">
                                                            <i class="bi bi-credit-card fs-4 d-block mb-2 text-primary"></i>
                                                            <span class="fw-medium d-block">{{ __('Credit Card') }}</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="radio" class="btn-check" name="payment_method" id="topup_paypal" value="paypal" required onchange="togglePaymentForms()">
                                                        <label class="btn btn-outline-dark w-100 p-3 rounded-3 text-start" for="topup_paypal">
                                                            <i class="bi bi-paypal fs-4 d-block mb-2 text-primary"></i>
                                                            <span class="fw-medium d-block">{{ __('PayPal') }}</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Card Details Form -->
                                            <div id="card_details_form" class="mt-4 p-3 border rounded-3 bg-light">
                                                <h6 class="fw-bold mb-3 small text-muted text-uppercase">{{ __('Card Details') }}</h6>
                                                <div class="mb-3">
                                                    <label class="form-label small">{{ __('Cardholder Name') }}</label>
                                                    <input type="text" class="form-control" id="card_name" placeholder="John Doe" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label small">{{ __('Card Number') }}</label>
                                                    <input type="text" class="form-control" id="card_number" placeholder="0000 0000 0000 0000" maxlength="19" required>
                                                </div>
                                                <div class="row g-2">
                                                    <div class="col-6">
                                                        <label class="form-label small">{{ __('Expiry Date') }}</label>
                                                        <input type="text" class="form-control" id="card_expiry" placeholder="MM/YY" maxlength="5" required>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label small">{{ __('CVV') }}</label>
                                                        <input type="text" class="form-control" id="card_cvv" placeholder="123" maxlength="4" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- PayPal Details Form -->
                                            <div id="paypal_details_form" class="mt-4 p-3 border rounded-3 bg-light" style="display: none;">
                                                <h6 class="fw-bold mb-3 small text-muted text-uppercase">{{ __('PayPal Account') }}</h6>
                                                <div class="text-center py-3">
                                                    <i class="bi bi-paypal text-primary mb-2" style="font-size: 3rem;"></i>
                                                    <p class="small text-muted mb-3">{{ __('You will be securely redirected to PayPal to complete your payment.') }}</p>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-white"><i class="bi bi-envelope"></i></span>
                                                        <input type="email" class="form-control" id="paypal_email" placeholder="paypal-email@example.com">
                                                    </div>
                                                </div>
                                            </div>

                                            <script>
                                                function togglePaymentForms() {
                                                    const isCard = document.getElementById('topup_card').checked;
                                                    
                                                    const cardForm = document.getElementById('card_details_form');
                                                    const paypalForm = document.getElementById('paypal_details_form');
                                                    
                                                    if (isCard) {
                                                        cardForm.style.display = 'block';
                                                        paypalForm.style.display = 'none';
                                                        
                                                        // Toggle required fields
                                                        document.getElementById('card_name').required = true;
                                                        document.getElementById('card_number').required = true;
                                                        document.getElementById('card_expiry').required = true;
                                                        document.getElementById('card_cvv').required = true;
                                                        document.getElementById('paypal_email').required = false;
                                                    } else {
                                                        cardForm.style.display = 'none';
                                                        paypalForm.style.display = 'block';
                                                        
                                                        // Toggle required fields
                                                        document.getElementById('card_name').required = false;
                                                        document.getElementById('card_number').required = false;
                                                        document.getElementById('card_expiry').required = false;
                                                        document.getElementById('card_cvv').required = false;
                                                        document.getElementById('paypal_email').required = true;
                                                    }
                                                }
                                            </script>
                                            
                                            <div class="alert alert-info border-0 bg-primary bg-opacity-10 d-flex align-items-center mb-0 mt-4">
                                                <i class="bi bi-info-circle-fill text-primary fs-4 me-3"></i>
                                                <small class="text-primary-emphasis">
                                                    {{ __('Note: In this development environment, payment is simulated and will succeed automatically.') }}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0 px-4 pb-4">
                                            <button type="button" class="btn btn-light fw-medium px-4" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                                            <button type="submit" class="btn btn-dark fw-bold px-5">{{ __('Pay & Top Up') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Transactions History -->
                        <h5 class="fw-bold mb-4">{{ __('Transaction History') }}</h5>
                        
                        @if($transactions->isEmpty())
                            <div class="text-center py-5 bg-light rounded-4 border">
                                <i class="bi bi-wallet2 text-muted mb-3" style="font-size: 3rem;"></i>
                                <h6 class="fw-bold">{{ __('No transactions yet') }}</h6>
                                <p class="text-muted small mb-0">{{ __('Your wallet activity will appear here.') }}</p>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col" class="text-uppercase fw-bold text-muted small" style="letter-spacing: 1px;">{{ __('Date') }}</th>
                                            <th scope="col" class="text-uppercase fw-bold text-muted small" style="letter-spacing: 1px;">{{ __('Description') }}</th>
                                            <th scope="col" class="text-uppercase fw-bold text-muted small text-end" style="letter-spacing: 1px;">{{ __('Amount') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="border-top-0">
                                        @foreach($transactions as $transaction)
                                            <tr>
                                                <td>
                                                    <span class="d-block fw-medium">{{ $transaction->created_at->format('M d, Y') }}</span>
                                                    <span class="text-muted small">{{ $transaction->created_at->format('h:i A') }}</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="me-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background-color: {{ $transaction->type === 'credit' ? 'rgba(25, 135, 84, 0.1)' : 'rgba(220, 53, 69, 0.1)' }};">
                                                            <i class="bi {{ $transaction->type === 'credit' ? 'bi-arrow-down-left text-success' : 'bi-arrow-up-right text-danger' }}"></i>
                                                        </div>
                                                        <span class="fw-medium">{{ $transaction->description }}</span>
                                                    </div>
                                                </td>
                                                <td class="text-end fw-bold {{ $transaction->type === 'credit' ? 'text-success' : '' }}">
                                                    {{ $transaction->type === 'credit' ? '+' : '-' }}${{ number_format($transaction->amount, 2) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@extends('layouts.store')

@section('content')
<section class="py-5 mt-5 bg-light min-vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Sidebar -->
            <div class="col-md-4 col-lg-3 mb-4">
                @include('partials.account-sidebar')
            </div>

            <!-- Main Content -->
            <div class="col-md-8 col-lg-9">
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4 p-md-5">
                        <div class="d-flex align-items-center mb-4 pb-2 border-bottom">
                            <h4 class="fw-bold m-0" style="letter-spacing: -0.5px;">{{ __('Returns Portal') }}</h4>
                        </div>
                        <p class="text-muted mb-5" style="font-size: 0.95rem; line-height: 1.6;">{{ __('We want you to be completely satisfied with your purchase. Enter your details to start a return.') }}</p>

                        <div class="bg-white rounded-4 border shadow-sm p-4 p-md-5 mb-4">
                            <form id="return-form" action="/api/returns" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label class="form-label fw-bold text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 1px;">{{ __('Select Order') }}</label>
                                    <select class="form-select form-select-lg border border-light-subtle bg-light rounded-3 shadow-none focus-ring focus-ring-dark" name="order_id" required>
                                        <option value="" disabled selected>{{ __('Select an order...') }}</option>
                                        @if(isset($orders) && $orders->count() > 0)
                                            @foreach($orders as $order)
                                                <option value="{{ $order->id }}">{{ __('Order') }} #{{ $order->order_number }} - {{ $order->created_at->format('M d, Y') }} ({{ __(ucfirst($order->status)) }})</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if(!isset($orders) || $orders->count() == 0)
                                        <div class="form-text text-danger mt-2 fw-medium"><i class="bi bi-exclamation-circle me-1"></i>{{ __("You don't have any eligible orders to return.") }}</div>
                                    @endif
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 1px;">{{ __('Reason for Return') }}</label>
                                    <select class="form-select form-select-lg border border-light-subtle bg-light rounded-3 shadow-none focus-ring focus-ring-dark" name="reason" required>
                                        <option value="" disabled selected>{{ __('Select a reason...') }}</option>
                                        <option value="Wrong Item">{{ __('Received the wrong item') }}</option>
                                        <option value="Defective">{{ __('Item is defective or damaged') }}</option>
                                        <option value="Not as Expected">{{ __('Did not match description') }}</option>
                                        <option value="Size Issue">{{ __('Size did not fit') }}</option>
                                        <option value="Changed Mind">{{ __('Changed my mind') }}</option>
                                    </select>
                                </div>

                                <div class="mb-5">
                                    <label class="form-label fw-bold text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 1px;">{{ __('Additional Details (Optional)') }}</label>
                                    <textarea class="form-control form-control-lg border border-light-subtle bg-light rounded-3 shadow-none focus-ring focus-ring-dark" name="details" rows="4" placeholder="{{ __('Please provide any additional context...') }}"></textarea>
                                </div>

                                <div class="d-grid mt-5">
                                    <button type="submit" class="btn btn-dark btn-lg rounded-pill fw-bold text-uppercase shadow-sm" style="letter-spacing: 1px; font-size: 0.85rem;" @if(!isset($orders) || $orders->count() == 0) disabled @endif>{{ __('Submit Return Request') }}</button>
                                </div>
                                
                                <div id="return-alert" class="mt-4 d-none alert"></div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="card border-0 shadow-sm rounded-4 mb-5" style="background-color: #fafafb;">
                    <div class="card-body p-4 p-md-5">
                        <h5 class="fw-bold mb-4"><i class="bi bi-info-circle me-2 text-dark"></i>{{ __('Return Policy') }}</h5>
                        <ul class="text-muted mb-0" style="line-height: 1.8;">
                            <li>{{ __('Items must be returned within 30 days of receipt.') }}</li>
                            <li>{{ __('Items must be unworn, unwashed, and have original tags attached.') }}</li>
                            <li>{{ __('Refunds will be processed to the original payment method within 5-7 business days of receiving the return.') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    const returnForm = document.getElementById('return-form');
    if(returnForm) {
        returnForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const alertBox = document.getElementById('return-alert');
            const btn = returnForm.querySelector('button[type="submit"]');
            
            btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Submitting...';
            btn.disabled = true;
            alertBox.classList.add('d-none');
            
            const formData = new FormData(returnForm);
            const data = Object.fromEntries(formData.entries());
            
            fetch(returnForm.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(data)
            })
            .then(res => res.json())
            .then(data => {
                btn.innerHTML = 'Submit Return Request';
                btn.disabled = false;
                alertBox.classList.remove('d-none');
                
                if (data.success || data.message) {
                    alertBox.className = 'mt-4 alert alert-success';
                    alertBox.textContent = data.message || 'Return request submitted successfully.';
                    returnForm.reset();
                } else {
                    alertBox.className = 'mt-4 alert alert-danger';
                    alertBox.textContent = 'Failed to submit return request.';
                }
            })
            .catch(err => {
                btn.innerHTML = 'Submit Return Request';
                btn.disabled = false;
                alertBox.classList.remove('d-none');
                alertBox.className = 'mt-4 alert alert-danger';
                alertBox.textContent = 'An error occurred. Please try again.';
                console.error(err);
            });
        });
    }
});
</script>
@endsection

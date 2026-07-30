@extends('layouts.store')

@section('content')
<section class="py-5 mt-5 bg-light min-vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <h2 class="fw-bold">Returns Portal</h2>
                    <p class="text-muted">We want you to be completely satisfied with your purchase. Enter your details to start a return.</p>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4 p-md-5">
                        <form id="return-form" action="/api/returns" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label fw-bold">Select Order</label>
                                <select class="form-select form-select-lg" name="order_id" required>
                                    <option value="" disabled selected>Select an order...</option>
                                    @if(isset($orders) && $orders->count() > 0)
                                        @foreach($orders as $order)
                                            <option value="{{ $order->id }}">Order #{{ $order->order_number }} - {{ $order->created_at->format('M d, Y') }} ({{ ucfirst($order->status) }})</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if(!isset($orders) || $orders->count() == 0)
                                    <div class="form-text text-danger mt-2">You don't have any eligible orders to return.</div>
                                @endif
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Reason for Return</label>
                                <select class="form-select" name="reason" required>
                                    <option value="" disabled selected>Select a reason...</option>
                                    <option value="Wrong Item">Received the wrong item</option>
                                    <option value="Defective">Item is defective or damaged</option>
                                    <option value="Not as Expected">Did not match description</option>
                                    <option value="Size Issue">Size did not fit</option>
                                    <option value="Changed Mind">Changed my mind</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Additional Details (Optional)</label>
                                <textarea class="form-control" name="details" rows="3" placeholder="Please provide any additional context..."></textarea>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-dark btn-lg" @if(!isset($orders) || $orders->count() == 0) disabled @endif>Submit Return Request</button>
                            </div>
                            
                            <div id="return-alert" class="mt-4 d-none alert"></div>
                        </form>
                    </div>
                </div>
                
                <div class="mt-5 bg-white p-4 rounded border">
                    <h5 class="fw-bold mb-3"><i class="bi bi-info-circle me-2"></i>Return Policy</h5>
                    <ul class="text-muted mb-0">
                        <li>Items must be returned within 30 days of receipt.</li>
                        <li>Items must be unworn, unwashed, and have original tags attached.</li>
                        <li>Refunds will be processed to the original payment method within 5-7 business days of receiving the return.</li>
                    </ul>
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

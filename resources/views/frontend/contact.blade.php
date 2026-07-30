@extends('layouts.store')

@section('content')
<section class="py-5 mt-5 bg-light min-vh-100">
    <div class="container">
        <div class="row mb-5 text-center">
            <div class="col-12">
                <h1 class="fw-bold">Contact Us</h1>
                <p class="text-muted lead">We're here to help. Reach out to our support team.</p>
            </div>
        </div>

        <div class="row g-5">
            <div class="col-md-5">
                <div class="bg-white p-5 rounded border shadow-sm h-100">
                    <h4 class="fw-bold mb-4">Get in Touch</h4>
                    
                    <div class="d-flex mb-4 align-items-start">
                        <div class="bg-light text-dark rounded-circle p-3 me-3">
                            <i class="bi bi-geo-alt fs-4"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Our Headquarters</h6>
                            <p class="text-muted mb-0">123 Fashion Street, Suite 456<br>New York, NY 10001, USA</p>
                        </div>
                    </div>
                    
                    <div class="d-flex mb-4 align-items-start">
                        <div class="bg-light text-dark rounded-circle p-3 me-3">
                            <i class="bi bi-telephone fs-4"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Phone Number</h6>
                            <p class="text-muted mb-0">+1 (800) 123-4567<br>Mon-Fri: 9AM - 6PM EST</p>
                        </div>
                    </div>
                    
                    <div class="d-flex mb-4 align-items-start">
                        <div class="bg-light text-dark rounded-circle p-3 me-3">
                            <i class="bi bi-envelope fs-4"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Email Address</h6>
                            <p class="text-muted mb-0">support@kaira.com<br>sales@kaira.com</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="bg-white p-5 rounded border shadow-sm h-100">
                    <h4 class="fw-bold mb-4">Send a Message</h4>
                    <form id="contact-form" action="/api/support/tickets" method="POST">
                        @csrf
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
                                <label class="form-label">Subject *</label>
                                <select class="form-select" name="subject" required>
                                    <option value="" disabled selected>Select a subject...</option>
                                    <option value="General Inquiry">General Inquiry</option>
                                    <option value="Order Issue">Order Issue</option>
                                    <option value="Payment Problem">Payment Problem</option>
                                    <option value="Shipping/Delivery">Shipping/Delivery</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Message *</label>
                                <textarea class="form-control" name="message" rows="5" required></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-dark btn-lg w-100">Send Message</button>
                            </div>
                        </div>
                        <div id="contact-alert" class="mt-4 d-none alert"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    const contactForm = document.getElementById('contact-form');
    if(contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const alertBox = document.getElementById('contact-alert');
            const btn = contactForm.querySelector('button[type="submit"]');
            
            btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sending...';
            btn.disabled = true;
            alertBox.classList.add('d-none');
            
            const formData = new FormData(contactForm);
            const data = Object.fromEntries(formData.entries());
            
            fetch(contactForm.action, {
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
                btn.innerHTML = 'Send Message';
                btn.disabled = false;
                alertBox.classList.remove('d-none');
                
                if (data.success || data.message) {
                    alertBox.className = 'mt-4 alert alert-success';
                    alertBox.textContent = data.message || 'Message sent successfully. We will get back to you soon!';
                    contactForm.reset();
                } else {
                    alertBox.className = 'mt-4 alert alert-danger';
                    alertBox.textContent = 'Failed to send message.';
                }
            })
            .catch(err => {
                btn.innerHTML = 'Send Message';
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

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
                        <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom">
                            <h4 class="fw-bold m-0" style="letter-spacing: -0.5px;">Order History</h4>
                            <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">{{ $orders->count() }} Orders</span>
                        </div>
                        
                        @if($orders->isEmpty())
                            <div class="text-center py-5 bg-light rounded-4 border border-light-subtle my-4" style="background: linear-gradient(180deg, #ffffff 0%, #f8f9fa 100%);">
                                <i class="bi bi-bag-x text-muted mb-3 d-block" style="font-size: 3.5rem; opacity: 0.5;"></i>
                                <h5 class="fw-bold text-dark mb-2" style="letter-spacing: -0.5px;">You have no orders yet</h5>
                                <p class="text-muted small mb-4 mx-auto" style="max-width: 300px;">Looks like you haven't made any purchases with us yet.</p>
                                <a href="/" class="btn btn-dark rounded-pill px-5 shadow-sm fw-bold text-uppercase" style="letter-spacing: 1px; font-size: 0.8rem; padding-top: 12px; padding-bottom: 12px;">Start Shopping</a>
                            </div>
                        @else
                            <div class="table-responsive bg-white rounded-4 border shadow-sm mt-4">
                                <table class="table table-hover align-middle mb-0">
                                    <thead style="background-color: #fafafb;">
                                        <tr>
                                            <th class="px-4 py-3 text-uppercase text-muted fw-bold border-bottom" style="font-size: 0.7rem; letter-spacing: 1.5px;">Order ID</th>
                                            <th class="px-4 py-3 text-uppercase text-muted fw-bold border-bottom" style="font-size: 0.7rem; letter-spacing: 1.5px;">Date</th>
                                            <th class="px-4 py-3 text-uppercase text-muted fw-bold border-bottom" style="font-size: 0.7rem; letter-spacing: 1.5px;">Status</th>
                                            <th class="px-4 py-3 text-uppercase text-muted fw-bold border-bottom text-end" style="font-size: 0.7rem; letter-spacing: 1.5px;">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                        <tr style="transition: background-color 0.2s ease; cursor: pointer;" onmouseover="this.style.backgroundColor='#fafafb'" onmouseout="this.style.backgroundColor='white'">
                                            <td class="px-4 py-4 fw-bold text-dark" style="font-size: 0.95rem;">#{{ substr($order->id, 0, 8) }}</td>
                                            <td class="px-4 py-4 text-muted" style="font-size: 0.95rem;">{{ $order->created_at->format('M d, Y') }}</td>
                                            <td class="px-4 py-4">
                                                <span class="badge {{ $order->status === 'pending' ? 'bg-warning-subtle text-warning-emphasis' : ($order->status === 'completed' ? 'bg-success-subtle text-success-emphasis' : 'bg-secondary-subtle text-secondary-emphasis') }} px-3 py-2 rounded-pill fw-semibold" style="letter-spacing: 0.5px;">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-4 fw-bold text-dark text-end" style="font-size: 1rem;">${{ number_format($order->grand_total, 2) }}</td>
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

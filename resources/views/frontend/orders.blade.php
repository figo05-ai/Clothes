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
                            <h4 class="fw-bold m-0" style="letter-spacing: -0.5px;">Order History</h4>
                        </div>
                        
                        @if($orders->isEmpty())
                            <div class="text-center py-5 bg-light rounded-4 border border-light-subtle my-4">
                                <i class="bi bi-bag-x text-muted mb-3" style="font-size: 3rem;"></i>
                                <h5 class="fw-bold text-dark mb-2">You have no orders yet</h5>
                                <p class="text-muted small mb-4">Looks like you haven't made any purchases with us yet.</p>
                                <a href="/" class="btn btn-dark rounded-pill px-4">Start Shopping</a>
                            </div>
                        @else
                            <div class="table-responsive bg-white rounded-4 border shadow-sm mt-4">
                                <table class="table table-hover align-middle mb-0">
                                    <thead style="background-color: #fafafb; border-bottom: 2px solid #f1f1f1;">
                                        <tr>
                                            <th class="px-4 py-3 text-uppercase text-muted fw-bold" style="font-size: 0.75rem; letter-spacing: 1px;">Order ID</th>
                                            <th class="px-4 py-3 text-uppercase text-muted fw-bold" style="font-size: 0.75rem; letter-spacing: 1px;">Date</th>
                                            <th class="px-4 py-3 text-uppercase text-muted fw-bold" style="font-size: 0.75rem; letter-spacing: 1px;">Status</th>
                                            <th class="px-4 py-3 text-uppercase text-muted fw-bold" style="font-size: 0.75rem; letter-spacing: 1px;">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                        <tr>
                                            <td class="fw-bold">#{{ substr($order->id, 0, 8) }}</td>
                                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <span class="badge {{ $order->status === 'pending' ? 'bg-warning text-dark' : ($order->status === 'completed' ? 'bg-success' : 'bg-secondary') }}">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td class="fw-bold">${{ number_format($order->grand_total, 2) }}</td>
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

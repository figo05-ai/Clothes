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
                        <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action p-3 fw-semibold">
                            <i class="bi bi-person me-2"></i> Dashboard
                        </a>
                        <a href="{{ route('dashboard.orders') }}" class="list-group-item list-group-item-action p-3 active fw-semibold">
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
                        <h4 class="fw-bold mb-4">Order History</h4>
                        
                        @if($orders->isEmpty())
                            <div class="text-center py-5">
                                <i class="bi bi-bag-x text-muted mb-3" style="font-size: 3rem;"></i>
                                <h5 class="text-muted">You have no orders yet.</h5>
                                <a href="/" class="btn btn-primary mt-3">Start Shopping</a>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Total</th>
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

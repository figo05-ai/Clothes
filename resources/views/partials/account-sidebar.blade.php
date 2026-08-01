<div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
    <div class="card-body p-4 text-center bg-white border-bottom" style="background: linear-gradient(145deg, #ffffff, #f8f9fa);">
        <div class="mb-3">
            <div class="d-inline-block text-white rounded-circle fs-3 d-flex align-items-center justify-content-center mx-auto shadow-sm" style="width: 80px; height: 80px; background: linear-gradient(135deg, #111 0%, #333 100%); font-weight: 700;">
                {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
            </div>
        </div>
        <h5 class="fw-bold mb-1" style="letter-spacing: 0.5px;">{{ auth()->user()->name }}</h5>
        <p class="text-muted small mb-2">{{ auth()->user()->email }}</p>
        <span class="badge bg-dark text-white fw-semibold px-3 py-2 rounded-pill shadow-sm" style="font-size: 0.65rem; letter-spacing: 1px;">VIP MEMBER</span>
    </div>
    
    <style>
        .account-sidebar-link {
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            border-bottom: 1px solid #f6f6f6;
            color: #444;
        }
        .account-sidebar-link:last-child {
            border-bottom: none;
        }
        .account-sidebar-link:hover, .account-sidebar-link.active {
            background-color: #fafafb;
            padding-left: 1.5rem !important;
            color: #000;
        }
        .account-sidebar-link.active {
            border-left: 4px solid #111;
            font-weight: 700 !important;
        }
        .account-sidebar-icon {
            opacity: 0.6;
            transition: all 0.25s ease;
        }
        .account-sidebar-link:hover .account-sidebar-icon, .account-sidebar-link.active .account-sidebar-icon {
            opacity: 1;
            transform: scale(1.15) rotate(3deg);
            color: #111 !important;
        }
    </style>

    <div class="list-group list-group-flush border-0">
        <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action p-3 fw-semibold account-sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-person me-2 account-sidebar-icon"></i> {{ __('Dashboard') }}
        </a>
        <a href="{{ route('dashboard.orders') }}" class="list-group-item list-group-item-action p-3 fw-semibold account-sidebar-link {{ request()->routeIs('dashboard.orders') ? 'active' : '' }}">
            <i class="bi bi-box-seam me-2 account-sidebar-icon"></i> {{ __('Order History') }}
        </a>
        <a href="{{ route('frontend.wallet') }}" class="list-group-item list-group-item-action p-3 fw-semibold account-sidebar-link {{ request()->routeIs('frontend.wallet') ? 'active' : '' }}">
            <i class="bi bi-wallet2 me-2 account-sidebar-icon"></i> {{ __('My Wallet') }}
        </a>
        <a href="{{ route('wishlist') }}" class="list-group-item list-group-item-action p-3 fw-semibold account-sidebar-link {{ request()->routeIs('wishlist') ? 'active' : '' }}">
            <i class="bi bi-heart me-2 account-sidebar-icon text-danger"></i> {{ __('My Wishlist') }}
        </a>
        <a href="{{ route('dashboard.preferences') }}" class="list-group-item list-group-item-action p-3 fw-semibold account-sidebar-link {{ request()->routeIs('dashboard.preferences') ? 'active' : '' }}">
            <i class="bi bi-sliders me-2 account-sidebar-icon"></i> {{ __('My Preferences') }}
        </a>
        <a href="{{ route('returns') }}" class="list-group-item list-group-item-action p-3 fw-semibold account-sidebar-link {{ request()->routeIs('returns') ? 'active' : '' }}">
            <i class="bi bi-arrow-return-left me-2 account-sidebar-icon"></i> {{ __('Returns & Refunds') }}
        </a>
        <form method="POST" action="{{ route('logout') }}" class="m-0">
            @csrf
            <button type="submit" class="list-group-item list-group-item-action p-3 text-danger fw-semibold w-100 text-start border-0 account-sidebar-link" style="background-color: #fffafb;">
                <i class="bi bi-box-arrow-right me-2 account-sidebar-icon"></i> {{ __('Log Out') }}
            </button>
        </form>
    </div>
</div>

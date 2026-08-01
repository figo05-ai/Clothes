<x-guest-layout>
    <div class="text-center mb-4">
        <h2 class="font-marcellus text-uppercase mb-2">{{ __('Create Account') }}</h2>
        <p class="text-muted">{{ __('Join us to track your orders and save favorites') }}</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-person"></i>
                </span>
                <input id="name" class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="John Doe" />
            </div>
            @error('name')
                <div class="text-danger mt-1" style="font-size: 0.8rem;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="form-label">{{ __('Email Address') }}</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-envelope"></i>
                </span>
                <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="name@example.com" />
            </div>
            @error('email')
                <div class="text-danger mt-1" style="font-size: 0.8rem;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-lock"></i>
                </span>
                <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            </div>
            @error('password')
                <div class="text-danger mt-1" style="font-size: 0.8rem;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-5">
            <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-shield-check"></i>
                </span>
                <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            </div>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn-gold">
            {{ __('Create Account') }}
        </button>

        <!-- Log In Link -->
        <div class="text-center mt-4 pt-4" style="border-top: 1px solid rgba(255,255,255,0.1);">
            <span class="text-light" style="font-size: 0.9rem; opacity: 0.7;">Already have an account? </span>
            <a href="{{ route('login') }}" class="auth-link fw-bold ms-1" style="letter-spacing: 1px;">LOG IN</a>
        </div>
    </form>
</x-guest-layout>

<x-guest-layout>
    <div class="text-center mb-4">
        <h2 class="font-marcellus text-uppercase mb-2">{{ __('Welcome Back') }}</h2>
        <p class="text-muted">{{ __('Log in to your account to continue shopping') }}</p>
    </div>

    @if (session('status'))
        <div class="alert alert-success mb-4 text-center" style="background-color: rgba(40,167,69,0.1); border-color: rgba(40,167,69,0.3); color: #28a745; border-radius: 10px;">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="form-label">{{ __('Email Address') }}</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-envelope"></i>
                </span>
                <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="name@example.com" />
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
                <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            </div>
            @error('password')
                <div class="text-danger mt-1" style="font-size: 0.8rem;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div class="form-check">
                <input id="remember_me" type="checkbox" name="remember" class="form-check-input" style="cursor: pointer;">
                <label for="remember_me" class="form-check-label text-light" style="font-size: 0.85rem; cursor: pointer;">
                    {{ __('Remember me') }}
                </label>
            </div>
            
            @if (Route::has('password.request'))
                <a class="auth-link" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <!-- Submit -->
        <button type="submit" class="btn-gold">
            {{ __('Log In') }}
        </button>

        <!-- Sign Up Link -->
        <div class="text-center mt-4 pt-4" style="border-top: 1px solid rgba(255,255,255,0.1);">
            <span class="text-light" style="font-size: 0.9rem; opacity: 0.7;">Don't have an account? </span>
            <a href="{{ route('register') }}" class="auth-link fw-bold ms-1" style="letter-spacing: 1px;">SIGN UP</a>
        </div>
    </form>
</x-guest-layout>

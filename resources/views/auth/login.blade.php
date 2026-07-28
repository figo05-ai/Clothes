<x-guest-layout>
    @if (session('status'))
        <div class="alert alert-success mb-4" style="background-color: rgba(40,167,69,0.1); border-color: rgba(40,167,69,0.3); color: #28a745;">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="form-label">{{ __('Email Address') }}</label>
            <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
            @error('email')
                <div class="invalid-feedback" style="color: #ff6b6b; font-size: 0.85rem; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="current-password" />
            @error('password')
                <div class="invalid-feedback" style="color: #ff6b6b; font-size: 0.85rem; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="d-flex justify-content-between align-items-center mb-5">
            <label for="remember_me" class="d-flex align-items-center mb-0" style="cursor: pointer;">
                <input id="remember_me" type="checkbox" name="remember" class="form-check-input me-2 mt-0" style="background-color: #111; border-color: var(--border-color); cursor: pointer;">
                <span class="text-muted" style="font-size: 0.9rem;">{{ __('Remember me') }}</span>
            </label>
            
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
        <div class="text-center mt-4 pt-3" style="border-top: 1px solid var(--border-color);">
            <span class="text-muted" style="font-size: 0.9rem;">Don't have an account? </span>
            <a href="{{ route('register') }}" class="auth-link fw-bold ms-1" style="text-decoration: underline;">Sign Up</a>
        </div>
    </form>
</x-guest-layout>

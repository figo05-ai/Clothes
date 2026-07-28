<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input id="name" class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
            @error('name')
                <div class="invalid-feedback" style="color: #ff6b6b; font-size: 0.85rem; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="form-label">{{ __('Email Address') }}</label>
            <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
            @error('email')
                <div class="invalid-feedback" style="color: #ff6b6b; font-size: 0.85rem; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="new-password" />
            @error('password')
                <div class="invalid-feedback" style="color: #ff6b6b; font-size: 0.85rem; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-5">
            <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
        </div>

        <!-- Submit -->
        <button type="submit" class="btn-gold">
            {{ __('Create Account') }}
        </button>

        <!-- Log In Link -->
        <div class="text-center mt-4 pt-3" style="border-top: 1px solid var(--border-color);">
            <span class="text-muted" style="font-size: 0.9rem;">Already have an account? </span>
            <a href="{{ route('login') }}" class="auth-link fw-bold ms-1" style="text-decoration: underline;">Log In</a>
        </div>
    </form>
</x-guest-layout>

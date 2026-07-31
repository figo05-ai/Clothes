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
                        
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show rounded-3 border-0 shadow-sm mb-4" role="alert">
                                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="mb-2">
                            <h4 class="fw-bold m-0" style="letter-spacing: -0.5px;">{{ __('My Preferences & Sizes') }}</h4>
                            <p class="text-muted mt-2" style="font-size: 0.95rem;">{{ __('Set your sizing preferences so we can recommend the perfect fit for you across our catalog.') }}</p>
                        </div>
                        
                        <form action="{{ route('dashboard.preferences.update') }}" method="POST" class="mt-4">
                            @csrf
                            <div class="card border border-light-subtle shadow-sm rounded-4 bg-white">
                                <div class="card-body p-4 p-md-5">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold text-uppercase text-muted" style="letter-spacing: 1px; font-size: 0.75rem;">{{ __('Top Size') }}</label>
                                            <select name="preferred_top_size" class="form-select form-select-lg border border-light-subtle bg-light rounded-3 shadow-none focus-ring focus-ring-dark">
                                                <option value="">{{ __('Select Size') }}</option>
                                                <option value="XS" {{ $preferences->preferred_top_size == 'XS' ? 'selected' : '' }}>XS - Extra Small</option>
                                                <option value="S" {{ $preferences->preferred_top_size == 'S' ? 'selected' : '' }}>S - Small</option>
                                                <option value="M" {{ $preferences->preferred_top_size == 'M' ? 'selected' : '' }}>M - Medium</option>
                                                <option value="L" {{ $preferences->preferred_top_size == 'L' ? 'selected' : '' }}>L - Large</option>
                                                <option value="XL" {{ $preferences->preferred_top_size == 'XL' ? 'selected' : '' }}>XL - Extra Large</option>
                                                <option value="XXL" {{ $preferences->preferred_top_size == 'XXL' ? 'selected' : '' }}>XXL - Double Extra Large</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold text-uppercase text-muted" style="letter-spacing: 1px; font-size: 0.75rem;">{{ __('Bottom Size') }}</label>
                                            <select name="preferred_bottom_size" class="form-select form-select-lg border border-light-subtle bg-light rounded-3 shadow-none focus-ring focus-ring-dark">
                                                <option value="">{{ __('Select Size') }}</option>
                                                <option value="S" {{ $preferences->preferred_bottom_size == 'S' ? 'selected' : '' }}>28 - 30 (S)</option>
                                                <option value="M" {{ $preferences->preferred_bottom_size == 'M' ? 'selected' : '' }}>32 - 34 (M)</option>
                                                <option value="L" {{ $preferences->preferred_bottom_size == 'L' ? 'selected' : '' }}>36 - 38 (L)</option>
                                                <option value="XL" {{ $preferences->preferred_bottom_size == 'XL' ? 'selected' : '' }}>40 - 42 (XL)</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold text-uppercase text-muted" style="letter-spacing: 1px; font-size: 0.75rem;">{{ __('Shoe Size (US)') }}</label>
                                            <select name="shoe_size" class="form-select form-select-lg border border-light-subtle bg-light rounded-3 shadow-none focus-ring focus-ring-dark">
                                                <option value="">{{ __('Select Size') }}</option>
                                                @for($i = 5; $i <= 14; $i++)
                                                    <option value="{{ $i }}" {{ $preferences->shoe_size == (string)$i ? 'selected' : '' }}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <hr class="my-5 text-light-subtle">
                                    <div class="d-flex align-items-center justify-content-between p-4 rounded-4" style="background-color: #fafafb; border: 1px solid #f1f1f1;">
                                        <div>
                                            <h6 class="fw-bold mb-1">{{ __('Personalized Recommendations') }}</h6>
                                            <p class="text-muted small m-0">{{ __('Enable personalized size recommendations while shopping based on your profile.') }}</p>
                                        </div>
                                        <div class="form-check form-switch fs-4 m-0">
                                            <input name="enable_recommendations" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" {{ $preferences->enable_recommendations ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                    <div class="mt-5 text-end">
                                        <button type="submit" class="btn btn-dark btn-lg rounded-pill px-5 fw-bold shadow-sm" style="letter-spacing: 1px; text-transform: uppercase; font-size: 0.85rem;">{{ __('Save Preferences') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

    <!-- Product Quick View Modal -->
    <div class="modal fade" id="modalQuickView" tabindex="-1" aria-labelledby="modalQuickViewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="modal-header border-0 pb-0 pe-4 pt-4">
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 p-md-5 pt-0">

                    <!-- Product Title, Brand Subtitle & Ratings Header (Above Picture & Details) -->
                    <div class="mb-4 pb-3 border-bottom">
                        <span class="text-uppercase text-primary fw-bold d-block"
                            style="font-size: 0.78rem; letter-spacing: 2px;">{{ __('KAIRA LUXURY COLLECTION') }}</span>
                        <h2 class="fw-bold text-dark m-0 mt-1 mb-2" id="qvTitle">Dark Florish Onepiece</h2>
                        <div class="d-flex flex-wrap align-items-center gap-3">
                            <div class="star-rating text-warning" style="font-size: 0.95rem; letter-spacing: 1px;">
                                ★ ★ ★ ★ ★ <span class="text-dark fw-semibold ms-1" style="font-size: 0.85rem;">4.9
                                    ({{ __('128 Reviews') }})</span>
                            </div>
                            <span
                                class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 rounded-pill"
                                style="font-size: 0.78rem;">{{ __('In Stock') }}</span>
                        </div>
                    </div>

                    <div class="row g-4 align-items-start">

                        <!-- Left: Main Product Image & Angle Thumbnails -->
                        <div class="col-md-6 text-center">
                            <div class="qv-img-wrapper p-2 bg-light rounded-4 border mb-3 position-relative">
                                <span
                                    class="badge bg-dark text-white text-uppercase px-3 py-2 rounded-pill position-absolute top-0 start-0 m-3 z-2"
                                    id="qvBadge">{{ __('NEW ARRIVAL') }}</span>
                                <img src="{{ asset('images/product-item-5.jpg') }}" id="qvMainImage" alt="Product Image"
                                    class="img-fluid rounded-3 object-fit-cover w-100" style="max-height: 400px;">
                            </div>
                            <!-- Thumbnail previews -->
                            <div class="d-flex justify-content-center gap-2">
                                <button type="button"
                                    class="btn btn-outline-secondary p-1 rounded-3 active border-2 qv-thumb-btn"
                                    onclick="document.getElementById('qvMainImage').src=this.querySelector('img').src;">
                                    <img src="{{ asset('images/product-item-5.jpg') }}" alt="thumb1"
                                        style="width: 50px; height: 50px;" class="rounded object-fit-cover">
                                </button>
                                <button type="button"
                                    class="btn btn-outline-secondary p-1 rounded-3 border-2 qv-thumb-btn"
                                    onclick="document.getElementById('qvMainImage').src=this.querySelector('img').src;">
                                    <img src="{{ asset('images/product-item-6.jpg') }}" alt="thumb2"
                                        style="width: 50px; height: 50px;" class="rounded object-fit-cover">
                                </button>
                                <button type="button"
                                    class="btn btn-outline-secondary p-1 rounded-3 border-2 qv-thumb-btn"
                                    onclick="document.getElementById('qvMainImage').src=this.querySelector('img').src;">
                                    <img src="{{ asset('images/product-item-7.jpg') }}" alt="thumb3"
                                        style="width: 50px; height: 50px;" class="rounded object-fit-cover">
                                </button>
                            </div>
                        </div>

                        <!-- Right: Product Details, Color & Size Selection -->
                        <div class="col-md-6">
                            <div class="ps-md-2">

                                <!-- Price -->
                                <div class="d-flex align-items-baseline gap-2 mb-3">
                                    <h2 class="fw-bold text-dark m-0" id="qvPrice">$95.00</h2>
                                    <span class="text-muted text-decoration-line-through"
                                        style="font-size: 1rem;">$120.00</span>
                                    <span class="badge bg-danger text-white ms-2" style="font-size: 0.75rem;">{{ __('SAVE 20%') }}</span>
                                </div>

                                <p class="text-secondary mb-4" style="font-size: 0.9rem; line-height: 1.6;"
                                    id="qvDesc">
                                    {{ __('Crafted from a premium silk-cotton blend, featuring a tailored silhouette, concealed buttons, and elegant finishing. Designed for effortless luxury.') }}
                                </p>

                                <!-- Color Selection -->
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <label class="fw-bold text-dark small text-uppercase"
                                            style="letter-spacing: 1px;">{{ __('Select Color:') }} <span
                                                class="text-primary fw-semibold" id="qvSelectedColor">{{ __('Midnight Black') }}</span></label>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <button type="button"
                                            class="btn btn-outline-dark rounded-circle p-1 active qv-color-btn"
                                            style="width: 32px; height: 32px; background: #111;"
                                            data-color="{{ __('Midnight Black') }}" title="{{ __('Midnight Black') }}"
                                            onclick="document.getElementById('qvSelectedColor').textContent='{{ __('Midnight Black') }}'; document.querySelectorAll('.qv-color-btn').forEach(b=>b.classList.remove('active', 'border-3')); this.classList.add('active', 'border-3');"></button>
                                        <button type="button"
                                            class="btn btn-outline-secondary rounded-circle p-1 qv-color-btn"
                                            style="width: 32px; height: 32px; background: #f5f0eb;"
                                            data-color="{{ __('Cream White') }}" title="{{ __('Cream White') }}"
                                            onclick="document.getElementById('qvSelectedColor').textContent='{{ __('Cream White') }}'; document.querySelectorAll('.qv-color-btn').forEach(b=>b.classList.remove('active', 'border-3')); this.classList.add('active', 'border-3');"></button>
                                        <button type="button"
                                            class="btn btn-outline-secondary rounded-circle p-1 qv-color-btn"
                                            style="width: 32px; height: 32px; background: #8c907e;"
                                            data-color="{{ __('Sage Green') }}" title="{{ __('Sage Green') }}"
                                            onclick="document.getElementById('qvSelectedColor').textContent='{{ __('Sage Green') }}'; document.querySelectorAll('.qv-color-btn').forEach(b=>b.classList.remove('active', 'border-3')); this.classList.add('active', 'border-3');"></button>
                                        <button type="button"
                                            class="btn btn-outline-secondary rounded-circle p-1 qv-color-btn"
                                            style="width: 32px; height: 32px; background: #c2a68c;"
                                            data-color="{{ __('Warm Camel') }}" title="{{ __('Warm Camel') }}"
                                            onclick="document.getElementById('qvSelectedColor').textContent='{{ __('Warm Camel') }}'; document.querySelectorAll('.qv-color-btn').forEach(b=>b.classList.remove('active', 'border-3')); this.classList.add('active', 'border-3');"></button>
                                    </div>
                                </div>

                                <!-- Size Selection & Size Chart Link -->
                                <div class="mb-4">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <label class="fw-bold text-dark small text-uppercase"
                                            style="letter-spacing: 1px;">{{ __('Select Size:') }} <span
                                                class="text-primary fw-semibold" id="qvSelectedSize">M</span></label>
                                    </div>
                                    <div class="d-flex flex-wrap gap-2 mb-2">
                                        <button type="button"
                                            class="btn btn-outline-dark rounded-3 px-3 py-2 fw-medium qv-size-btn"
                                            onclick="document.getElementById('qvSelectedSize').textContent='XS'; document.querySelectorAll('.qv-size-btn').forEach(b=>b.classList.remove('active', 'btn-dark')); this.classList.add('active', 'btn-dark');">XS</button>
                                        <button type="button"
                                            class="btn btn-outline-dark rounded-3 px-3 py-2 fw-medium qv-size-btn"
                                            onclick="document.getElementById('qvSelectedSize').textContent='S'; document.querySelectorAll('.qv-size-btn').forEach(b=>b.classList.remove('active', 'btn-dark')); this.classList.add('active', 'btn-dark');">S</button>
                                        <button type="button"
                                            class="btn btn-dark active rounded-3 px-3 py-2 fw-medium qv-size-btn"
                                            onclick="document.getElementById('qvSelectedSize').textContent='M'; document.querySelectorAll('.qv-size-btn').forEach(b=>b.classList.remove('active', 'btn-dark')); this.classList.add('active', 'btn-dark');">M</button>
                                        <button type="button"
                                            class="btn btn-outline-dark rounded-3 px-3 py-2 fw-medium qv-size-btn"
                                            onclick="document.getElementById('qvSelectedSize').textContent='L'; document.querySelectorAll('.qv-size-btn').forEach(b=>b.classList.remove('active', 'btn-dark')); this.classList.add('active', 'btn-dark');">L</button>
                                        <button type="button"
                                            class="btn btn-outline-dark rounded-3 px-3 py-2 fw-medium qv-size-btn"
                                            onclick="document.getElementById('qvSelectedSize').textContent='XL'; document.querySelectorAll('.qv-size-btn').forEach(b=>b.classList.remove('active', 'btn-dark')); this.classList.add('active', 'btn-dark');">XL</button>
                                    </div>
                                    <div
                                        class="d-flex flex-wrap align-items-center justify-content-between gap-2 mt-3 p-2 px-3 bg-light rounded-3 border">
                                        <button type="button"
                                            class="btn btn-sm btn-outline-dark rounded-pill px-3 py-2 fw-semibold d-inline-flex align-items-center gap-2 border-secondary border-opacity-50 text-uppercase"
                                            style="font-size: 0.78rem; letter-spacing: 1px;" data-bs-toggle="modal"
                                            data-bs-target="#modalSizing"
                                            onclick="bootstrap.Modal.getInstance(document.getElementById('modalQuickView'))?.hide();">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" class="text-primary">
                                                <rect x="2" y="7" width="20" height="10" rx="2">
                                                </rect>
                                                <line x1="6" y1="7" x2="6" y2="12">
                                                </line>
                                                <line x1="10" y1="7" x2="10" y2="10">
                                                </line>
                                                <line x1="14" y1="7" x2="14" y2="12">
                                                </line>
                                                <line x1="18" y1="7" x2="18" y2="10">
                                                </line>
                                            </svg>
                                            {{ __('Size Chart & Fit Guide') }}
                                        </button>
                                        <span class="text-secondary d-flex align-items-center gap-1"
                                            style="font-size: 0.78rem;">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" class="text-muted">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="12" cy="7" r="4"></circle>
                                            </svg>
                                            {{ __('Model is 175cm (5\'9") wearing size S') }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Quantity & Actions -->
                                <div class="d-flex flex-wrap align-items-center gap-3 pt-2 border-top">
                                    <div class="input-group rounded-3 border overflow-hidden" style="width: 110px;">
                                        <button type="button" class="btn btn-light border-0 fw-bold px-3"
                                            onclick="if(parseInt(document.getElementById('qvQty').value)>1) document.getElementById('qvQty').value=parseInt(document.getElementById('qvQty').value)-1;">-</button>
                                        <input type="text" class="form-control border-0 text-center fw-bold p-0"
                                            value="1" readonly id="qvQty">
                                        <button type="button" class="btn btn-light border-0 fw-bold px-3"
                                            onclick="document.getElementById('qvQty').value=parseInt(document.getElementById('qvQty').value)+1;">+</button>
                                    </div>

                                    <button type="button"
                                        class="btn btn-dark btn-lg flex-grow-1 rounded-3 text-uppercase fw-semibold py-3 fs-6 d-flex align-items-center justify-content-center gap-2 add-to-cart-btn add-to-cart-btn-qv">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2">
                                            <circle cx="9" cy="21" r="1"></circle>
                                            <circle cx="20" cy="21" r="1"></circle>
                                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6">
                                            </path>
                                        </svg>
                                        {{ __('Add to Cart') }}
                                    </button>

                                    <button type="button"
                                        class="btn btn-outline-secondary btn-lg rounded-3 p-3 d-flex align-items-center justify-content-center"
                                        title="Save to Wishlist"
                                        onclick="showToast('Saved to your VIP Wishlist! ❤️');">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2">
                                            <path
                                                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>

                                <!-- Shipping / Returns Micro Note -->
                                <div class="mt-4 p-3 bg-light rounded-3 border d-flex align-items-center gap-3">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" class="text-success">
                                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                    </svg>
                                    <div style="font-size: 0.8rem;">
                                        <span class="d-block fw-bold text-dark">{{ __('Complimentary Express Shipping') }}</span>
                                        <span class="text-secondary">{{ __('Free 2-day delivery & 30-day effortless returns.') }}</span>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Account Interactive Modals -->
    <!-- 1. Profile & Account Settings Modal -->
    <div class="modal fade" id="modalProfile" tabindex="-1" aria-labelledby="modalProfileLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="modal-header bg-dark text-white p-4">
                    <h5 class="modal-title text-uppercase m-0 d-flex align-items-center gap-2" id="modalProfileLabel">
                        <svg width="22" height="22" viewBox="0 0 24 24">
                            <use xlink:href="#user"></use>
                        </svg> My Profile & Account Settings
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="border-bottom bg-light px-4 pt-3">
                    <ul class="nav nav-tabs border-0 gap-2" id="profileTabNav" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active d-flex align-items-center gap-2" id="navPhotoTab"
                                data-bs-toggle="tab" data-bs-target="#tabPhoto" type="button" role="tab"
                                aria-controls="tabPhoto" aria-selected="true">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path
                                        d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z">
                                    </path>
                                    <circle cx="12" cy="13" r="4"></circle>
                                </svg>
                                Photo
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link d-flex align-items-center gap-2" id="navPersonalTab"
                                data-bs-toggle="tab" data-bs-target="#tabPersonal" type="button" role="tab"
                                aria-controls="tabPersonal" aria-selected="false">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                Personal Details
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link d-flex align-items-center gap-2" id="navContactTab"
                                data-bs-toggle="tab" data-bs-target="#tabContact" type="button" role="tab"
                                aria-controls="tabContact" aria-selected="false">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path
                                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                    </path>
                                </svg>
                                Contact & Address
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link d-flex align-items-center gap-2" id="navPrefTab"
                                data-bs-toggle="tab" data-bs-target="#tabPreferences" type="button" role="tab"
                                aria-controls="tabPreferences" aria-selected="false">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="3"></circle>
                                    <path
                                        d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                    </path>
                                </svg>
                                Preferences
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link d-flex align-items-center gap-2" id="navSecurityTab"
                                data-bs-toggle="tab" data-bs-target="#tabSecurity" type="button" role="tab"
                                aria-controls="tabSecurity" aria-selected="false">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2">
                                    </rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                                Security
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="modal-body p-4">
                    <form id="formProfileDetails">
                        <div class="tab-content" id="profileTabContent">

                            <!-- TAB 1: PROFILE PHOTO -->
                            <div class="tab-pane fade show active" id="tabPhoto" role="tabpanel"
                                aria-labelledby="navPhotoTab">
                                <div class="text-center mb-4">
                                    <div class="avatar-upload-wrapper mb-3">
                                        <img src="{{ asset('images/insta-item1.jpg') }}" alt="Profile avatar preview"
                                            class="user-avatar-img rounded-circle object-fit-cover shadow"
                                            style="width: 120px; height: 120px; border: 4px solid var(--bs-primary, #8c907e);">
                                        <label for="profilePhotoInput" class="avatar-camera-overlay"
                                            style="width: 38px; height: 38px;" title="Upload new photo">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">
                                                <path
                                                    d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z">
                                                </path>
                                                <circle cx="12" cy="13" r="4"></circle>
                                            </svg>
                                        </label>
                                    </div>
                                    <h6 class="fw-bold mb-1 user-display-name">Elena Rostova</h6>
                                    <p class="text-muted small">JPG, PNG or WebP files allowed. Max file size: 5MB.
                                    </p>
                                </div>

                                <div class="avatar-dropzone mb-4" id="avatarDropzone"
                                    onclick="document.getElementById('profilePhotoInput').click()">
                                    <input type="file" id="profilePhotoInput" accept="image/*" class="d-none">
                                    <div class="mb-2">
                                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none"
                                            stroke="var(--bs-primary, #8c907e)" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                            <polyline points="17 8 12 3 7 8"></polyline>
                                            <line x1="12" y1="3" x2="12" y2="15">
                                            </line>
                                        </svg>
                                    </div>
                                    <div class="fw-medium text-dark mb-1">Drag and drop your new photo here</div>
                                    <small class="text-muted d-block mb-2">or <span class="text-primary fw-bold">click
                                            to browse computer</span></small>
                                </div>

                                <div class="preset-avatar-section mb-4 p-3 bg-light rounded-3 border">
                                    <label class="form-label text-uppercase fs-7 text-muted fw-bold mb-2">Or Choose a
                                        Preset Avatar</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <button type="button" class="btn preset-avatar-btn btn-preset-avatar"
                                            data-avatar-src="{{ asset('images/insta-item1.jpg') }}">
                                            <img src="{{ asset('images/insta-item1.jpg') }}" alt="Preset 1"
                                                class="w-100 h-100 object-fit-cover">
                                        </button>
                                        <button type="button" class="btn preset-avatar-btn btn-preset-avatar"
                                            data-avatar-src="{{ asset('images/insta-item2.jpg') }}">
                                            <img src="{{ asset('images/insta-item2.jpg') }}" alt="Preset 2"
                                                class="w-100 h-100 object-fit-cover">
                                        </button>
                                        <button type="button" class="btn preset-avatar-btn btn-preset-avatar"
                                            data-avatar-src="{{ asset('images/insta-item3.jpg') }}">
                                            <img src="{{ asset('images/insta-item3.jpg') }}" alt="Preset 3"
                                                class="w-100 h-100 object-fit-cover">
                                        </button>
                                        <button type="button" class="btn preset-avatar-btn btn-preset-avatar"
                                            data-avatar-src="{{ asset('images/insta-item4.jpg') }}">
                                            <img src="{{ asset('images/insta-item4.jpg') }}" alt="Preset 4"
                                                class="w-100 h-100 object-fit-cover">
                                        </button>
                                        <button type="button" class="btn preset-avatar-btn btn-preset-avatar"
                                            data-avatar-src="{{ asset('images/insta-item5.jpg') }}">
                                            <img src="{{ asset('images/insta-item5.jpg') }}" alt="Preset 5"
                                                class="w-100 h-100 object-fit-cover">
                                        </button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <button type="button" class="btn btn-outline-danger btn-sm" id="btnRemovePhoto">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" class="me-1">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path
                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                            </path>
                                        </svg> Remove Photo
                                    </button>
                                    <label for="profilePhotoInput" class="btn btn-primary px-4">Upload New
                                        Photo</label>
                                </div>
                            </div>

                            <!-- TAB 2: PERSONAL DETAILS -->
                            <div class="tab-pane fade" id="tabPersonal" role="tabpanel"
                                aria-labelledby="navPersonalTab">
                                <h6 class="text-uppercase text-muted border-bottom pb-2 mb-3"
                                    style="font-size: 0.8rem; letter-spacing: 1px;">Personal Information</h6>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label text-uppercase fs-7 text-muted fw-medium">First
                                            Name</label>
                                        <input type="text" name="firstName" class="form-control p-3"
                                            value="Elena" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-uppercase fs-7 text-muted fw-medium">Last
                                            Name</label>
                                        <input type="text" name="lastName" class="form-control p-3"
                                            value="Rostova" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-uppercase fs-7 text-muted fw-medium">Display
                                            Name / Username</label>
                                        <input type="text" name="displayName" class="form-control p-3"
                                            value="Elena Rostova">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-uppercase fs-7 text-muted fw-medium">Gender /
                                            Title</label>
                                        <select name="gender" class="form-select p-3">
                                            <option value="Female" selected>Female (Ms./Mrs.)</option>
                                            <option value="Male">Male (Mr.)</option>
                                            <option value="Non-binary">Non-binary (Mx.)</option>
                                            <option value="Prefer not to say">Prefer not to say</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-uppercase fs-7 text-muted fw-medium">Date of
                                            Birth</label>
                                        <input type="date" name="dob" class="form-control p-3"
                                            value="1995-06-15">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label text-uppercase fs-7 text-muted fw-medium">Bio / About
                                            Me</label>
                                        <textarea name="bio" class="form-control p-3" rows="3"
                                            placeholder="Tell us a little about your fashion style and preferences...">Fashion enthusiast & luxury lifestyle curator based in Vienna.</textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- TAB 3: CONTACT & ADDRESS -->
                            <div class="tab-pane fade" id="tabContact" role="tabpanel"
                                aria-labelledby="navContactTab">
                                <h6 class="text-uppercase text-muted border-bottom pb-2 mb-3"
                                    style="font-size: 0.8rem; letter-spacing: 1px;">Contact Details & Delivery Address
                                </h6>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label text-uppercase fs-7 text-muted fw-medium">Primary
                                            Email Address</label>
                                        <div class="input-group">
                                            <input type="email" name="email" class="form-control p-3"
                                                value="elena.rostova@example.com" required>
                                            <span
                                                class="input-group-text bg-success-subtle text-success border-success-subtle px-3 fw-bold"
                                                style="font-size: 0.75rem;">Verified ✓</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-uppercase fs-7 text-muted fw-medium">Secondary /
                                            Backup Email</label>
                                        <input type="email" name="secondaryEmail" class="form-control p-3"
                                            value="elena.backup@example.com">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-uppercase fs-7 text-muted fw-medium">Phone
                                            Number</label>
                                        <input type="tel" name="phone" class="form-control p-3"
                                            value="+43 720 11 52 78">
                                    </div>
                                    <div class="col-md-6">
                                        <label
                                            class="form-label text-uppercase fs-7 text-muted fw-medium">Country</label>
                                        <select name="country" class="form-select p-3">
                                            <option value="Austria" selected>Austria</option>
                                            <option value="Germany">Germany</option>
                                            <option value="France">France</option>
                                            <option value="Italy">Italy</option>
                                            <option value="United States">United States</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="Egypt">Egypt</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label text-uppercase fs-7 text-muted fw-medium">Street
                                            Address</label>
                                        <input type="text" name="address" class="form-control p-3"
                                            value="Kärntner Straße 18">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-uppercase fs-7 text-muted fw-medium">City</label>
                                        <input type="text" name="city" class="form-control p-3"
                                            value="Vienna">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-uppercase fs-7 text-muted fw-medium">Postal /
                                            ZIP Code</label>
                                        <input type="text" name="postalCode" class="form-control p-3"
                                            value="1010">
                                    </div>
                                </div>
                            </div>

                            <!-- TAB 4: PREFERENCES -->
                            <div class="tab-pane fade" id="tabPreferences" role="tabpanel"
                                aria-labelledby="navPrefTab">
                                <h6 class="text-uppercase text-muted border-bottom pb-2 mb-3"
                                    style="font-size: 0.8rem; letter-spacing: 1px;">Shopping & Account Preferences
                                </h6>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label text-uppercase fs-7 text-muted fw-medium">Preferred
                                            Style Aesthetic</label>
                                        <select name="preferredStyle" class="form-select p-3">
                                            <option value="Contemporary Luxury" selected>Contemporary Luxury</option>
                                            <option value="Minimalist Elegance">Minimalist Elegance</option>
                                            <option value="Evening & Haute Couture">Evening & Haute Couture</option>
                                            <option value="Vintage Chic">Vintage Chic</option>
                                            <option value="Urban Streetwear">Urban Streetwear</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-uppercase fs-7 text-muted fw-medium">Preferred
                                            Currency</label>
                                        <select name="currency" class="form-select p-3">
                                            <option value="USD ($)" selected>USD ($)</option>
                                            <option value="EUR (€)">EUR (€)</option>
                                            <option value="GBP (£)">GBP (£)</option>
                                            <option value="EGP (EGP)">EGP (EGP)</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label text-uppercase fs-7 text-muted fw-medium">Tops /
                                            Outerwear Size</label>
                                        <select name="topSize" class="form-select p-3">
                                            <option value="XS">XS</option>
                                            <option value="S (EU 36)" selected>S (EU 36)</option>
                                            <option value="M (EU 38)">M (EU 38)</option>
                                            <option value="L (EU 40)">L (EU 40)</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label text-uppercase fs-7 text-muted fw-medium">Bottoms
                                            Size</label>
                                        <select name="bottomSize" class="form-select p-3">
                                            <option value="EU 34">EU 34</option>
                                            <option value="EU 36" selected>EU 36</option>
                                            <option value="EU 38">EU 38</option>
                                            <option value="EU 40">EU 40</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label text-uppercase fs-7 text-muted fw-medium">Footwear
                                            Size</label>
                                        <select name="shoeSize" class="form-select p-3">
                                            <option value="EU 37">EU 37</option>
                                            <option value="EU 38" selected>EU 38</option>
                                            <option value="EU 39">EU 39</option>
                                            <option value="EU 40">EU 40</option>
                                        </select>
                                    </div>

                                    <div class="col-12 mt-4 border-top pt-3">
                                        <h6 class="text-uppercase text-muted mb-3"
                                            style="font-size: 0.8rem; letter-spacing: 1px;">Notification Settings</h6>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" name="emailNotif"
                                                id="emailNotif" checked>
                                            <label class="form-check-label fw-medium" for="emailNotif">Receive Email
                                                Newsletters & Exclusive VIP Offers</label>
                                        </div>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" name="smsNotif"
                                                id="smsNotif">
                                            <label class="form-check-label fw-medium" for="smsNotif">Receive Instant
                                                SMS Shipping Alerts</label>
                                        </div>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" name="orderNotif"
                                                id="orderNotif" checked>
                                            <label class="form-check-label fw-medium" for="orderNotif">Real-time
                                                Order & Delivery Status Notifications</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- TAB 5: SECURITY & PASSWORD -->
                            <div class="tab-pane fade" id="tabSecurity" role="tabpanel"
                                aria-labelledby="navSecurityTab">
                                <h6 class="text-uppercase text-danger border-bottom pb-2 mb-3"
                                    style="font-size: 0.8rem; letter-spacing: 1px;">Reset Password & Account Security
                                </h6>
                                <div class="row g-3 mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label text-muted fw-medium">Current Password</label>
                                        <input type="password" name="currentPassword" class="form-control p-3"
                                            placeholder="••••••••">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label text-muted fw-medium">New Password</label>
                                        <input type="password" name="newPassword" class="form-control p-3"
                                            placeholder="••••••••">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label text-muted fw-medium">Confirm New Password</label>
                                        <input type="password" name="confirmPassword" class="form-control p-3"
                                            placeholder="••••••••">
                                    </div>
                                </div>
                                <div class="p-3 bg-light rounded-3 border mb-4">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h6 class="m-0 fw-bold">Two-Factor Authentication (2FA)</h6>
                                            <small class="text-muted">Add an extra layer of security to your Kaira
                                                account</small>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="twoFactorAuth"
                                                checked style="width: 40px; height: 20px;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer border-top pt-3 px-0 justify-content-between">
                            <button type="button" class="btn btn-outline-secondary px-4 p-2"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary px-4 p-2 fw-medium">Save All
                                Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Size Chart & Fit Guide Modal -->
    <div class="modal fade" id="modalSizing" tabindex="-1" aria-labelledby="modalSizingLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

                <div class="modal-header bg-dark text-white p-4">
                    <div>
                        <h5 class="modal-title text-uppercase m-0 d-flex align-items-center gap-2"
                            id="modalSizingLabel">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <rect x="2" y="7" width="20" height="10" rx="2"></rect>
                                <line x1="6" y1="7" x2="6" y2="12"></line>
                                <line x1="10" y1="7" x2="10" y2="10"></line>
                                <line x1="14" y1="7" x2="14" y2="12"></line>
                                <line x1="18" y1="7" x2="18" y2="10"></line>
                            </svg>
                            Size Chart & Fit Guide
                        </h5>
                        <small class="text-white-50">Accurate body & garment measurements for Kaira luxury
                            collections</small>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div
                    class="border-bottom bg-light px-4 pt-3 d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <ul class="nav nav-tabs border-0 gap-2" id="sizeGuideTabNav" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active d-flex align-items-center gap-2 fw-semibold"
                                id="tabChart-tab" data-bs-toggle="tab" data-bs-target="#tabChart" type="button"
                                role="tab">
                                📏 Measurement Chart
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link d-flex align-items-center gap-2 fw-semibold" id="tabHowTo-tab"
                                data-bs-toggle="tab" data-bs-target="#tabHowTo" type="button" role="tab">
                                📐 How to Measure
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link d-flex align-items-center gap-2 fw-semibold" id="tabSavedPref-tab"
                                data-bs-toggle="tab" data-bs-target="#tabSavedPref" type="button" role="tab">
                                ⚙️ My Size Preferences
                            </button>
                        </li>
                    </ul>

                    <!-- Unit Switcher -->
                    <div class="btn-group btn-group-sm mb-2" role="group" aria-label="Measurement Unit">
                        <input type="radio" class="btn-check" name="sizeUnit" id="unitInches" checked
                            onclick="toggleSizeUnits('in');">
                        <label class="btn btn-outline-dark px-3 fw-bold" for="unitInches">IN (Inches)</label>
                        <input type="radio" class="btn-check" name="sizeUnit" id="unitCm"
                            onclick="toggleSizeUnits('cm');">
                        <label class="btn btn-outline-dark px-3 fw-bold" for="unitCm">CM (Centimeters)</label>
                    </div>
                </div>

                <div class="modal-body p-4">
                    <div class="tab-content" id="sizeGuideTabContent">

                        <!-- Tab 1: Detailed Size Chart Table -->
                        <div class="tab-pane fade show active" id="tabChart" role="tabpanel">
                            <div class="table-responsive rounded-3 border">
                                <table class="table table-striped table-hover align-middle m-0 text-center"
                                    style="font-size: 0.9rem;">
                                    <thead class="table-dark text-uppercase"
                                        style="font-size: 0.8rem; letter-spacing: 1px;">
                                        <tr>
                                            <th class="py-3 text-start ps-4">Size</th>
                                            <th class="py-3">US / EU</th>
                                            <th class="py-3">Bust / Chest</th>
                                            <th class="py-3">Waist</th>
                                            <th class="py-3">Hips</th>
                                            <th class="py-3">Shoulder Width</th>
                                            <th class="py-3">Garment Length</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="fw-bold text-dark text-start ps-4">XS</td>
                                            <td>US 0-2 / EU 34</td>
                                            <td class="size-val" data-in="31.5&quot; - 33.0&quot;"
                                                data-cm="80 - 84 cm">31.5" - 33.0"</td>
                                            <td class="size-val" data-in="24.5&quot; - 26.0&quot;"
                                                data-cm="62 - 66 cm">24.5" - 26.0"</td>
                                            <td class="size-val" data-in="34.5&quot; - 36.0&quot;"
                                                data-cm="88 - 92 cm">34.5" - 36.0"</td>
                                            <td class="size-val" data-in="15.0&quot;" data-cm="38 cm">15.0"</td>
                                            <td class="size-val" data-in="25.5&quot;" data-cm="65 cm">25.5"</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold text-dark text-start ps-4">S</td>
                                            <td>US 4-6 / EU 36</td>
                                            <td class="size-val" data-in="33.5&quot; - 35.0&quot;"
                                                data-cm="85 - 89 cm">33.5" - 35.0"</td>
                                            <td class="size-val" data-in="26.5&quot; - 28.0&quot;"
                                                data-cm="67 - 71 cm">26.5" - 28.0"</td>
                                            <td class="size-val" data-in="36.5&quot; - 38.0&quot;"
                                                data-cm="93 - 97 cm">36.5" - 38.0"</td>
                                            <td class="size-val" data-in="15.5&quot;" data-cm="39 cm">15.5"</td>
                                            <td class="size-val" data-in="26.0&quot;" data-cm="66 cm">26.0"</td>
                                        </tr>
                                        <tr class="table-primary table-active">
                                            <td class="fw-bold text-dark text-start ps-4">M <span
                                                    class="badge bg-primary ms-1"
                                                    style="font-size: 0.65rem;">POPULAR</span></td>
                                            <td>US 8-10 / EU 38</td>
                                            <td class="size-val" data-in="35.5&quot; - 37.0&quot;"
                                                data-cm="90 - 94 cm">35.5" - 37.0"</td>
                                            <td class="size-val" data-in="28.5&quot; - 30.0&quot;"
                                                data-cm="72 - 76 cm">28.5" - 30.0"</td>
                                            <td class="size-val" data-in="38.5&quot; - 40.0&quot;"
                                                data-cm="98 - 102 cm">38.5" - 40.0"</td>
                                            <td class="size-val" data-in="16.0&quot;" data-cm="41 cm">16.0"</td>
                                            <td class="size-val" data-in="26.5&quot;" data-cm="67 cm">26.5"</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold text-dark text-start ps-4">L</td>
                                            <td>US 12-14 / EU 40</td>
                                            <td class="size-val" data-in="37.5&quot; - 39.5&quot;"
                                                data-cm="95 - 100 cm">37.5" - 39.5"</td>
                                            <td class="size-val" data-in="30.5&quot; - 32.5&quot;"
                                                data-cm="77 - 83 cm">30.5" - 32.5"</td>
                                            <td class="size-val" data-in="40.5&quot; - 42.5&quot;"
                                                data-cm="103 - 108 cm">40.5" - 42.5"</td>
                                            <td class="size-val" data-in="16.8&quot;" data-cm="43 cm">16.8"</td>
                                            <td class="size-val" data-in="27.0&quot;" data-cm="69 cm">27.0"</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold text-dark text-start ps-4">XL</td>
                                            <td>US 16 / EU 42</td>
                                            <td class="size-val" data-in="40.0&quot; - 42.0&quot;"
                                                data-cm="101 - 107 cm">40.0" - 42.0"</td>
                                            <td class="size-val" data-in="33.0&quot; - 35.0&quot;"
                                                data-cm="84 - 89 cm">33.0" - 35.0"</td>
                                            <td class="size-val" data-in="43.0&quot; - 45.0&quot;"
                                                data-cm="109 - 114 cm">43.0" - 45.0"</td>
                                            <td class="size-val" data-in="17.5&quot;" data-cm="44 cm">17.5"</td>
                                            <td class="size-val" data-in="27.5&quot;" data-cm="70 cm">27.5"</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Fit Note -->
                            <div class="mt-3 p-3 bg-light rounded-3 border d-flex align-items-center gap-3">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" class="text-primary flex-shrink-0">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" y1="16" x2="12" y2="12"></line>
                                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                </svg>
                                <div style="font-size: 0.84rem;" class="text-secondary">
                                    <strong class="text-dark">Between sizes?</strong> If you prefer a tailored fit, we
                                    recommend sizing down. For a relaxed, oversized runway silhouette, choose your
                                    standard size.
                                </div>
                            </div>
                        </div>

                        <!-- Tab 2: How to Measure Instructions -->
                        <div class="tab-pane fade" id="tabHowTo" role="tabpanel">
                            <div class="row g-4 align-items-center">
                                <div class="col-md-6">
                                    <div class="d-flex flex-column gap-3">
                                        <div class="p-3 bg-light rounded-3 border">
                                            <h6 class="fw-bold text-dark mb-1">1. Bust / Chest Width</h6>
                                            <p class="text-secondary m-0 small">Measure around the fullest part of
                                                your bust/chest, keeping the measuring tape flat and parallel to the
                                                floor.</p>
                                        </div>
                                        <div class="p-3 bg-light rounded-3 border">
                                            <h6 class="fw-bold text-dark mb-1">2. Natural Waist Width</h6>
                                            <p class="text-secondary m-0 small">Measure around your natural waistline
                                                (the narrowest part of your torso, usually 1 inch above your belly
                                                button).</p>
                                        </div>
                                        <div class="p-3 bg-light rounded-3 border">
                                            <h6 class="fw-bold text-dark mb-1">3. Garment Length</h6>
                                            <p class="text-secondary m-0 small">Measured from the highest point of the
                                                shoulder seam straight down to the bottom hemline.</p>
                                        </div>
                                        <div class="p-3 bg-light rounded-3 border">
                                            <h6 class="fw-bold text-dark mb-1">4. Shoulder Width</h6>
                                            <p class="text-secondary m-0 small">Measured straight across the back from
                                                the tip of one shoulder seam to the other tip.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 text-center">
                                    <div class="p-4 bg-light rounded-4 border">
                                        <img src="{{ asset('images/post-image1.jpg') }}" alt="Measurement Guide"
                                            class="img-fluid rounded-3 mb-3 shadow-sm object-fit-cover"
                                            style="max-height: 220px;">
                                        <h6 class="fw-bold text-dark m-0">Need Personalized Sizing Advice?</h6>
                                        <p class="text-muted small mt-1 mb-3">Our VIP Stylists are available 24/7 to
                                            help you find your exact fit.</p>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalContact"
                                            class="btn btn-dark btn-sm px-4 rounded-pill text-uppercase fw-semibold"
                                            onclick="bootstrap.Modal.getInstance(document.getElementById('modalSizing'))?.hide();">Chat
                                            With Stylist</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tab 3: Saved Preferences Form -->
                        <div class="tab-pane fade" id="tabSavedPref" role="tabpanel">
                            <form
                                onsubmit="event.preventDefault(); showToast('Saved your size preferences!'); bootstrap.Modal.getInstance(this.closest('.modal'))?.hide();">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-dark">Preferred Tops / Coat
                                            Size</label>
                                        <select class="form-select p-3">
                                            <option>XS (EU 34)</option>
                                            <option selected>S (EU 36)</option>
                                            <option>M (EU 38)</option>
                                            <option>L (EU 40)</option>
                                            <option>XL (EU 42)</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-dark">Preferred Trousers
                                            Size</label>
                                        <select class="form-select p-3">
                                            <option>EU 34</option>
                                            <option selected>EU 36</option>
                                            <option>EU 38</option>
                                            <option>EU 40</option>
                                            <option>EU 42</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-dark">Preferred Shoe Size</label>
                                        <select class="form-select p-3">
                                            <option>EU 36 (US 6)</option>
                                            <option selected>EU 37 (US 6.5)</option>
                                            <option>EU 38 (US 7.5)</option>
                                            <option>EU 39 (US 8.5)</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-dark">Silhouette Fit
                                            Preference</label>
                                        <select class="form-select p-3">
                                            <option selected>Tailored / Fitted</option>
                                            <option>Regular Standard Fit</option>
                                            <option>Relaxed Oversized Fit</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-dark w-100 p-3 mt-4 text-uppercase fw-semibold"
                                    style="letter-spacing: 1px;">Save My Size Preferences</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. Order Tracking Modal -->
    <div class="modal fade" id="modalOrderTracking" tabindex="-1" aria-labelledby="modalOrderTrackingLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="modal-header bg-dark text-white p-4">
                    <h5 class="modal-title text-uppercase m-0 d-flex align-items-center gap-2"
                        id="modalOrderTrackingLabel">
                        <svg width="22" height="22" viewBox="0 0 24 24">
                            <use xlink:href="#shopping-bag"></use>
                        </svg> Live Shipment Tracking & History
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="card mb-4 border-primary border-opacity-25 bg-light">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <span class="badge bg-primary me-2">In Transit</span>
                                    <strong class="text-dark">Order #K-9482</strong>
                                </div>
                                <span class="text-muted fs-7">Estimated Delivery: Tomorrow, 2:00 PM</span>
                            </div>
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <img src="{{ asset('images/product-item-1.jpg') }}" alt="product"
                                    class="rounded object-fit-cover" style="width: 60px; height: 60px;">
                                <div>
                                    <h6 class="m-0 fw-bold">Classic Merino Wool Trench Coat</h6>
                                    <small class="text-muted">Color: Camel • Size: S • Qty: 1</small>
                                </div>
                                <div class="ms-auto fw-bold text-dark">$450.00</div>
                            </div>
                            <div class="tracking-steps d-flex justify-content-between position-relative mt-4 pt-2">
                                <div class="text-center position-relative z-1">
                                    <div class="rounded-circle bg-primary text-white mx-auto d-flex align-items-center justify-content-center"
                                        style="width: 32px; height: 32px;">✓</div>
                                    <small class="d-block mt-1 fw-medium">Confirmed</small>
                                </div>
                                <div class="text-center position-relative z-1">
                                    <div class="rounded-circle bg-primary text-white mx-auto d-flex align-items-center justify-content-center"
                                        style="width: 32px; height: 32px;">✓</div>
                                    <small class="d-block mt-1 fw-medium">Packed</small>
                                </div>
                                <div class="text-center position-relative z-1">
                                    <div class="rounded-circle bg-primary text-white mx-auto d-flex align-items-center justify-content-center"
                                        style="width: 32px; height: 32px;">🚚</div>
                                    <small class="d-block mt-1 fw-bold text-primary">In Transit</small>
                                </div>
                                <div class="text-center position-relative z-1">
                                    <div class="rounded-circle bg-secondary text-white mx-auto d-flex align-items-center justify-content-center"
                                        style="width: 32px; height: 32px;">🏠</div>
                                    <small class="d-block mt-1 text-muted">Delivered</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-uppercase text-muted fs-7 mb-3">Past Orders</h6>
                    <div class="list-group">
                        <div class="list-group-item d-flex justify-content-between align-items-center p-3">
                            <div>
                                <strong class="d-block">Order #K-8120 — $280.00</strong>
                                <small class="text-muted">Delivered on July 14, 2026 • Tailored Evening Blazer</small>
                            </div>
                            <button class="btn btn-sm btn-outline-dark"
                                onclick="alert('Receipt downloaded for Order #K-8120.');">Invoice</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- 4. Payment Modal -->
    <div class="modal fade" id="modalPayment" tabindex="-1" aria-labelledby="modalPaymentLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="modal-header bg-dark text-white p-4">
                    <h5 class="modal-title text-uppercase m-0 d-flex align-items-center gap-2"
                        id="modalPaymentLabel">
                        <svg width="22" height="22" viewBox="0 0 24 24">
                            <use xlink:href="#gift"></use>
                        </svg> Saved Payment Methods
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="card bg-dark text-white p-3 mb-3 rounded-3"
                        style="background: linear-gradient(135deg, #111 0%, #333 100%);">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <img src="{{ asset('images/visa-card.png') }}" alt="Visa" style="height: 24px;">
                            <span class="badge bg-primary">Default Card</span>
                        </div>
                        <div class="fs-5 tracking-wide mb-3">•••• •••• •••• 4242</div>
                        <div class="d-flex justify-content-between fs-7 text-white-50">
                            <span>ELENA ROSTOVA</span>
                            <span>EXPIRES 09/28</span>
                        </div>
                    </div>
                    <div
                        class="card border p-3 mb-4 rounded-3 d-flex flex-row align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ asset('images/master-card.png') }}" alt="MasterCard"
                                style="height: 24px;">
                            <div>
                                <strong class="d-block">MasterCard ending in 8819</strong>
                                <small class="text-muted">Expires 11/27</small>
                            </div>
                        </div>
                        <button class="btn btn-sm btn-outline-danger"
                            onclick="alert('Card removed.');">Remove</button>
                    </div>
                    <button class="btn btn-outline-dark w-100 p-2"
                        onclick="alert('Opening secure card reader...');">+ Add New Payment Method</button>
                </div>
            </div>
        </div>
    </div>

    <!-- 5. Addresses Modal -->
    <div class="modal fade" id="modalAddresses" tabindex="-1" aria-labelledby="modalAddressesLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="modal-header bg-dark text-white p-4">
                    <h5 class="modal-title text-uppercase m-0 d-flex align-items-center gap-2"
                        id="modalAddressesLabel">
                        <svg width="22" height="22" viewBox="0 0 24 24">
                            <use xlink:href="#calendar"></use>
                        </svg> Delivery Addresses
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="border rounded-3 p-3 mb-3 bg-light position-relative">
                        <span class="badge bg-primary position-absolute top-0 end-0 m-3">Default</span>
                        <h6 class="fw-bold m-0">Dashboard Address</h6>
                        <p class="text-muted m-0 fs-7 mt-1">104 Kensington High Street<br>Apartment 4B, London W8 4SG,
                            UK</p>
                    </div>
                    <div class="border rounded-3 p-3 mb-4 position-relative">
                        <h6 class="fw-bold m-0">Design Studio / Office</h6>
                        <p class="text-muted m-0 fs-7 mt-1">45 Mayfair Place, Suite 200<br>London W1J 8AJ, UK</p>
                    </div>
                    <button class="btn btn-outline-dark w-100 p-2" onclick="alert('Add address form opened.');">+
                        Add New Address</button>
                </div>
            </div>
        </div>
    </div>

    <!-- 6. Support Modal -->
    <div class="modal fade" id="modalSupport" tabindex="-1" aria-labelledby="modalSupportLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="modal-header bg-dark text-white p-4">
                    <h5 class="modal-title text-uppercase m-0 d-flex align-items-center gap-2"
                        id="modalSupportLabel">
                        <svg width="22" height="22" viewBox="0 0 24 24">
                            <use xlink:href="#check"></use>
                        </svg> Help & Support Concierge
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="accordion" id="accordionFAQ">
                        <div class="accordion-item border mb-2 rounded">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true">
                                    What are Kaira's global shipping rates and delivery times?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show"
                                data-bs-parent="#accordionFAQ">
                                <div class="accordion-body text-muted">
                                    We offer complimentary DHL Express express shipping on all orders over $250.
                                    Standard shipping arrives within 2-4 business days worldwide with live tracking.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border mb-2 rounded">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                    What is your return & exchange policy?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFAQ">
                                <div class="accordion-body text-muted">
                                    You may return unworn items with original tags within 30 days of delivery. Returns
                                    are free using our prepaid DHL return portal.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 7. Contact Modal -->
    <div class="modal fade" id="modalContact" tabindex="-1" aria-labelledby="modalContactLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="modal-header bg-dark text-white p-4">
                    <h5 class="modal-title text-uppercase m-0 d-flex align-items-center gap-2"
                        id="modalContactLabel">
                        <svg width="22" height="22" viewBox="0 0 24 24">
                            <use xlink:href="#link"></use>
                        </svg> Contact Kaira Stylist Concierge
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form
                        onsubmit="event.preventDefault(); alert('Message sent to Kaira Concierge! An advisor will reply within 1 hour.'); bootstrap.Modal.getInstance(this.closest('.modal'))?.hide();">
                        <div class="mb-3">
                            <label class="form-label text-muted">Subject</label>
                            <select class="form-select p-2">
                                <option>Private Styling Appointment</option>
                                <option>Order Query</option>
                                <option>Bespoke Tailoring Request</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted">Your Message</label>
                            <textarea class="form-control p-3" rows="4" placeholder="How can our stylists assist you today?" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 p-3">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- 8. Returns Modal -->
    <div class="modal fade" id="modalReturns" tabindex="-1" aria-labelledby="modalReturnsLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="modal-header bg-dark text-white p-4">
                    <h5 class="modal-title text-uppercase m-0 d-flex align-items-center gap-2"
                        id="modalReturnsLabel">
                        <svg width="22" height="22" viewBox="0 0 24 24">
                            <use xlink:href="#arrow-cycle"></use>
                        </svg> Global Returns & Exchange Portal
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form
                        onsubmit="event.preventDefault(); alert('Prepaid DHL Return Label generated and sent to your email!'); bootstrap.Modal.getInstance(this.closest('.modal'))?.hide();">
                        <div class="mb-3">
                            <label class="form-label text-muted">Select Eligible Order</label>
                            <select class="form-select p-2">
                                <option>Order #K-8120 — Tailored Evening Blazer ($280)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted">Reason for Return</label>
                            <select class="form-select p-2">
                                <option>Size / Fit Adjustment Needed</option>
                                <option>Color Difference</option>
                                <option>Item Exchange Request</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 p-3">Generate DHL Return Label</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- 10. Logout Modal -->
    <div class="modal fade" id="modalLogout" tabindex="-1" aria-labelledby="modalLogoutLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="modal-header bg-danger text-white p-4">
                    <h5 class="modal-title text-uppercase m-0 d-flex align-items-center gap-2"
                        id="modalLogoutLabel">
                        <svg width="22" height="22" viewBox="0 0 24 24">
                            <use xlink:href="#close"></use>
                        </svg> Log Out Confirmation
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 text-center">
                    <p class="fs-5 text-dark fw-medium mb-4">Are you sure you want to log out of your Kaira VIP
                        account?</p>
                    <div class="d-flex justify-content-center gap-3">
                        <button type="button" class="btn btn-outline-secondary px-4 p-2"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger px-4 p-2"
                            onclick="alert('You have successfully logged out.'); bootstrap.Modal.getInstance(this.closest('.modal'))?.hide();">Confirm
                            Log Out</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @auth
    @php
        $user = auth()->user();
        $orders = \App\Models\Order::where('user_id', $user->id)->latest()->get();
        $wishlistService = app(\App\Contracts\Wishlist\WishlistServiceInterface::class);
        $wishlist = $wishlistService->getUserWishlist($user->id);
        $policyPage = \App\Models\Page::where('slug', 'policy')->first();
    @endphp

    <!-- Modal: Orders -->
    <div class="modal fade" id="modalOrders" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="modal-header bg-dark text-white p-4">
                    <h5 class="modal-title text-uppercase m-0 d-flex align-items-center gap-2">
                        <svg width="22" height="22" viewBox="0 0 24 24" class="text-white"><use xlink:href="#shopping-bag"></use></svg> Order History
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4 bg-light">
                    @if($orders->isEmpty())
                        <div class="text-center py-5">
                            <i class="bi bi-bag-x text-muted mb-3 d-block" style="font-size: 3rem; opacity: 0.5;"></i>
                            <h5 class="fw-bold">You have no orders yet</h5>
                            <p class="text-muted">Looks like you haven't made any purchases with us yet.</p>
                        </div>
                    @else
                        <div class="table-responsive bg-white rounded-4 border shadow-sm">
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
                                    <tr>
                                        <td class="px-4 py-4 fw-bold text-dark" style="font-size: 0.95rem;">#{{ substr($order->id, 0, 8) }}</td>
                                        <td class="px-4 py-4 text-muted" style="font-size: 0.95rem;">{{ $order->created_at->format('M d, Y') }}</td>
                                        <td class="px-4 py-4">
                                            <span class="badge {{ $order->status === 'pending' ? 'bg-warning-subtle text-warning-emphasis' : ($order->status === 'completed' ? 'bg-success-subtle text-success-emphasis' : 'bg-secondary-subtle text-secondary-emphasis') }} px-3 py-2 rounded-pill fw-semibold" style="letter-spacing: 0.5px;">
                                                {{ __(ucfirst($order->status)) }}
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

    <!-- Modal: Wishlist -->
    <div class="modal fade" id="modalWishlist" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="modal-header bg-dark text-white p-4">
                    <h5 class="modal-title text-uppercase m-0 d-flex align-items-center gap-2">
                        <svg width="22" height="22" viewBox="0 0 24 24" class="text-white"><use xlink:href="#heart"></use></svg> 
                        My Saved Wishlist (<span class="wishlist-count">{{ count($wishlist) }}</span> Items)
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4 bg-light">
                    @if(count($wishlist) === 0)
                        <div class="text-center py-5">
                            <i class="bi bi-heart text-muted mb-3 d-block" style="font-size: 3rem; opacity: 0.5;"></i>
                            <h5 class="fw-bold">Your wishlist is empty</h5>
                            <p class="text-muted">Save your favorite items here.</p>
                        </div>
                    @else
                        <div class="row g-4">
                            @foreach($wishlist as $item)
                                @if(isset($item->product))
                                <div class="col-md-6 col-lg-4 wishlist-item-wrapper">
                                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative">
                                        @if($item->product->images && $item->product->images->isNotEmpty())
                                            <img src="{{ $item->product->images->first()->image_path }}" class="card-img-top object-fit-cover" style="height: 200px;" alt="{{ $item->product->name }}">
                                        @else
                                            <img src="https://placehold.co/400x400?text=No+Image" class="card-img-top object-fit-cover" style="height: 200px;" alt="{{ $item->product->name }}">
                                        @endif
                                        <div class="card-body p-3">
                                            <h6 class="fw-bold mb-1 text-truncate">{{ $item->product->name }}</h6>
                                            <p class="text-primary fw-bold my-1">${{ number_format($item->product->base_price, 2) }}</p>
                                            <button class="btn btn-primary btn-sm w-100 mt-2 add-to-cart-btn" data-product-id="{{ $item->product_id }}">Add to Cart</button>
                                        </div>
                                        <button class="btn btn-light btn-sm position-absolute top-0 end-0 m-2 rounded-circle shadow-sm d-flex align-items-center justify-content-center p-0" onclick="toggleWishlist(event, '{{ $item->product_id }}')" title="Remove from Wishlist" style="width: 32px; height: 32px;">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                        </button>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Returns Portal -->
    <div class="modal fade" id="modalReturns" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="modal-header bg-dark text-white p-4">
                    <h5 class="modal-title text-uppercase m-0 d-flex align-items-center gap-2">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.92-10.26l5.08 5.08"></path></svg> Returns Portal
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4 bg-light">
                    @if($orders->where('status', 'completed')->isEmpty())
                        <div class="text-center py-5">
                            <i class="bi bi-box text-muted mb-3 d-block" style="font-size: 3rem; opacity: 0.5;"></i>
                            <h5 class="fw-bold">No eligible orders for return</h5>
                            <p class="text-muted">You must have completed orders to initiate a return.</p>
                        </div>
                    @else
                        <h6 class="fw-bold mb-4">Select an order to return</h6>
                        <div class="list-group list-group-flush border rounded-4 overflow-hidden shadow-sm">
                            @foreach($orders->where('status', 'completed') as $order)
                            <a href="javascript:void(0)" onclick="alert('Return initiated for order #{{ substr($order->id, 0, 8) }}'); bootstrap.Modal.getInstance(this.closest('.modal'))?.hide();" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-3">
                                <div>
                                    <div class="fw-bold text-dark">Order #{{ substr($order->id, 0, 8) }}</div>
                                    <small class="text-muted">{{ $order->created_at->format('M d, Y') }} • ${{ number_format($order->grand_total, 2) }}</small>
                                </div>
                                <span class="btn btn-sm btn-outline-dark rounded-pill px-3 fw-bold text-uppercase" style="font-size: 0.75rem;">Initiate Return</span>
                            </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Contact Support -->
    <div class="modal fade" id="modalContact" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="modal-header bg-dark text-white p-4">
                    <h5 class="modal-title text-uppercase m-0 d-flex align-items-center gap-2">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg> Contact Support
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4 bg-light">
                    <form onsubmit="event.preventDefault(); alert('Message sent successfully!'); bootstrap.Modal.getInstance(this.closest('.modal'))?.hide();">
                        <div class="mb-3">
                            <label class="form-label text-uppercase fs-7 text-muted fw-bold">Subject</label>
                            <input type="text" class="form-control p-3 rounded-3" placeholder="How can we help?" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label text-uppercase fs-7 text-muted fw-bold">Message</label>
                            <textarea class="form-control p-3 rounded-3" rows="5" placeholder="Describe your issue..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-dark w-100 p-3 text-uppercase fw-bold rounded-3">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Policy -->
    <div class="modal fade" id="modalPolicy" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="modal-header bg-dark text-white p-4">
                    <h5 class="modal-title text-uppercase m-0 d-flex align-items-center gap-2">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Our Policy
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-5 bg-white text-dark">
                    @if($policyPage)
                        <div class="prose max-w-none">
                            {!! $policyPage->content !!}
                        </div>
                    @else
                        <h4 class="fw-bold mb-3">Store Policies</h4>
                        <p class="mb-2">We offer a 30-day return policy for unworn items in their original packaging. Refunds are processed within 5-7 business days of receiving the returned item.</p>
                        <p>For exchanges, please return your original item and place a new order online.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endauth

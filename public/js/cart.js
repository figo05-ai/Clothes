document.addEventListener('DOMContentLoaded', function() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Function to render cart in offcanvas
    window.renderCart = function(cart) {
        const cartBody = document.querySelector('#offcanvasCart .list-group');
        const cartBadge = document.querySelectorAll('.badge.bg-primary.rounded-pill, .cart-count');
        const cartTotal = document.querySelector('#offcanvasCart .list-group-item:last-child strong');
        const checkoutBtn = document.querySelector('#offcanvasCart .btn-primary');

        if (!cartBody) return;

        // Update badges
        let itemCount = 0;
        let total = 0;

        cartBody.innerHTML = ''; // clear current except total

        if (!cart || !cart.items || cart.items.length === 0) {
            cartBody.innerHTML = '<li class="list-group-item d-flex justify-content-center text-muted py-4">Your cart is empty</li>';
            cartBody.innerHTML += `
            <li class="list-group-item d-flex justify-content-between">
                <span>Total (USD)</span>
                <strong>$0.00</strong>
            </li>`;
            cartBadge.forEach(b => b.textContent = 0);
            if(checkoutBtn) checkoutBtn.disabled = true;
            return;
        }

        if(checkoutBtn) checkoutBtn.disabled = false;

        cart.items.forEach(item => {
            itemCount += item.quantity;
            total += (item.price * item.quantity);

            cartBody.innerHTML += `
            <li class="list-group-item d-flex justify-content-between lh-sm">
                <div class="d-flex gap-2 align-items-center">
                    <img src="${item.image || 'https://via.placeholder.com/50'}" alt="${item.name}" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;">
                    <div>
                        <h6 class="my-0">${item.name}</h6>
                        <small class="text-body-secondary">Qty: ${item.quantity}</small>
                        <div>
                            <a href="#" class="text-danger small text-decoration-none remove-from-cart" data-id="${item.product_id}">Remove</a>
                        </div>
                    </div>
                </div>
                <span class="text-body-secondary">$${(item.price * item.quantity).toFixed(2)}</span>
            </li>
            `;
        });

        // Add total row
        cartBody.innerHTML += `
        <li class="list-group-item d-flex justify-content-between bg-light mt-2">
            <span>Total (USD)</span>
            <strong>$${cart.summary.total_price.toFixed(2)}</strong>
        </li>`;

        cartBadge.forEach(b => b.textContent = itemCount);

        // Re-attach remove listeners
        document.querySelectorAll('.remove-from-cart').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const productId = this.getAttribute('data-id');
                removeFromCart(productId);
            });
        });
    }

    // Fetch initial cart
    window.fetchCart = function() {
        fetch('/api/cart', {
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(res => {
            if (res.status === 401) {
                console.log("Not authenticated, cart might be empty or session-based.");
                return null;
            }
            return res.json();
        })
        .then(data => {
            if (data && data.data) {
                renderCart(data.data);
            }
        })
        .catch(err => console.error(err));
    }

    window.addToCart = function(productId, quantity = 1) {
        fetch('/api/cart', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: quantity
            })
        })
        .then(res => {
            if (res.status === 401) {
                window.location.href = '/login';
                return;
            }
            return res.json();
        })
        .then(data => {
            if (data && data.data) {
                renderCart(data.data);
                // Optionally open the offcanvas
                const offcanvasCart = new bootstrap.Offcanvas(document.getElementById('offcanvasCart'));
                offcanvasCart.show();
            }
        })
        .catch(err => console.error(err));
    }

    window.removeFromCart = function(productId) {
        fetch(`/api/cart/${productId}`, {
            method: 'DELETE',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data && data.data) {
                renderCart(data.data);
            }
        })
        .catch(err => console.error(err));
    }

    // Attach listeners to "Add to Cart" buttons
    document.body.addEventListener('click', function(e) {
        if (e.target.closest('.add-to-cart-btn')) {
            e.preventDefault();
            const btn = e.target.closest('.add-to-cart-btn');
            const productId = btn.getAttribute('data-product-id');
            // Check if there is a quantity input nearby
            let qtyInput = document.querySelector('#product-quantity');
            if (btn.closest('#modalQuickView')) {
                qtyInput = document.querySelector('#qvQty');
            }
            const quantity = qtyInput ? parseInt(qtyInput.value) : 1;

            if (productId) {
                addToCart(productId, quantity);
                if (typeof showToast === 'function') {
                    const title = btn.closest('#modalQuickView') ? document.getElementById('qvTitle').textContent : 'Item';
                    showToast('Added ' + title + ' to your shopping cart!');
                }
                const modalQuickView = document.getElementById('modalQuickView');
                if (modalQuickView && btn.closest('#modalQuickView')) {
                    bootstrap.Modal.getInstance(modalQuickView)?.hide();
                }
            } else {
                console.error('No product ID found for add to cart');
            }
        }
    });

    window.toggleWishlist = function(e, productId) {
        e.preventDefault();
        
        fetch('/api/wishlist/toggle', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify({ product_id: productId })
        })
        .then(response => {
            if (response.status === 401) {
                window.location.href = '/login';
                throw new Error('Unauthorized');
            }
            return response.json();
        })
        .then(data => {
            if (data.message) {
                const toast = document.getElementById('wishlistToast');
                const toastBody = document.getElementById('wishlistToastBody');
                
                if (toastBody) toastBody.innerText = data.message;
                
                if (data.action === 'added') {
                    if (toast) {
                        toast.classList.replace('bg-danger', 'bg-success');
                        toast.classList.replace('bg-dark', 'bg-success');
                        toast.classList.add('bg-success');
                    }
                    
                    document.querySelectorAll(`.btn-wishlist[data-product-id="${productId}"], .wishlist-btn[data-product-id="${productId}"]`).forEach(el => {
                        // Change state to added
                        if (el.tagName.toLowerCase() === 'button') {
                            el.innerHTML = '<i class="bi bi-heart-fill me-2"></i> Added to Wishlist';
                            el.classList.replace('btn-outline-danger', 'btn-danger');
                        } else {
                            const svg = el.querySelector('svg');
                            if (svg) {
                                svg.style.color = 'red';
                                svg.style.fill = 'red';
                            } else {
                                el.innerHTML = '<i class="bi bi-heart-fill text-danger fs-5"></i>';
                            }
                        }
                    });
                    
                    // Add item to modal dynamically
                    if (data.product) {
                        const modalBody = document.querySelector('#modalWishlist .modal-body');
                        let row = modalBody ? modalBody.querySelector('.row') : null;
                        
                        if (modalBody && !row) {
                            modalBody.innerHTML = '<div class="row g-4"></div>';
                            row = modalBody.querySelector('.row');
                        }
                        
                        if (row && !row.querySelector(`.wishlist-btn[data-product-id="${data.product.id}"]`)) {
                            const newCard = document.createElement('div');
                            newCard.className = 'col-md-6 col-lg-4 wishlist-item-wrapper';
                            newCard.innerHTML = `
                                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative">
                                    <img src="${data.product.image}" class="card-img-top object-fit-cover" style="height: 200px;" alt="${data.product.name}">
                                    <div class="card-body p-3">
                                        <h6 class="fw-bold mb-1 text-truncate">${data.product.name}</h6>
                                        <p class="text-primary fw-bold my-1">$${data.product.price}</p>
                                        <button class="btn btn-primary btn-sm w-100 mt-2 add-to-cart-btn" data-product-id="${data.product.id}">Add to Cart</button>
                                    </div>
                                    <button class="btn btn-light wishlist-btn btn-sm position-absolute top-0 end-0 m-2 rounded-circle shadow-sm d-flex align-items-center justify-content-center p-0" data-product-id="${data.product.id}" onclick="toggleWishlist(event, '${data.product.id}')" title="Remove from Wishlist" style="width: 32px; height: 32px;">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                    </button>
                                </div>
                            `;
                            row.appendChild(newCard);
                            
                            // Update counts
                            document.querySelectorAll('.badge.bg-light, .wishlist-count, .modal-title .badge').forEach(badge => {
                                const currentText = badge.innerText;
                                const match = currentText.match(/(\d+)/);
                                if (match) {
                                    const currentCount = parseInt(match[1]);
                                    badge.innerText = badge.innerText.replace(match[1], currentCount + 1);
                                }
                            });
                        }
                    }
                    
                    
                } else if (data.action === 'removed') {
                    if (toast) {
                        toast.classList.replace('bg-success', 'bg-dark');
                        toast.classList.replace('bg-danger', 'bg-dark');
                        toast.classList.add('bg-dark');
                    }
                    
                    document.querySelectorAll(`.btn-wishlist[data-product-id="${productId}"], .wishlist-btn[data-product-id="${productId}"]`).forEach(el => {
                        // Change state to removed
                        if (el.tagName.toLowerCase() === 'button' && !el.classList.contains('rounded-circle')) {
                            el.innerHTML = '<i class="bi bi-heart me-2"></i> Add to Wishlist';
                            el.classList.replace('btn-danger', 'btn-outline-danger');
                        } else if (!el.classList.contains('rounded-circle')) {
                            const svg = el.querySelector('svg');
                            if (svg) {
                                svg.style.color = '';
                                svg.style.fill = 'none';
                            } else {
                                el.innerHTML = '<i class="bi bi-heart fs-5"></i>';
                            }
                        }
                        
                        const productCard = el.closest('.col-6, .wishlist-item-wrapper, .col-md-6');
                        if (productCard && (window.location.pathname === '/wishlist' || el.closest('#modalWishlist'))) {
                            productCard.style.transition = 'opacity 0.3s ease';
                            productCard.style.opacity = '0';
                            setTimeout(() => {
                                productCard.remove();
                                document.querySelectorAll('.badge.bg-light, .wishlist-count, .modal-title .badge').forEach(badge => {
                                    const currentText = badge.innerText;
                                    const match = currentText.match(/(\d+)/);
                                    if (match) {
                                        const currentCount = parseInt(match[1]);
                                        badge.innerText = badge.innerText.replace(match[1], Math.max(0, currentCount - 1));
                                    }
                                });
                            }, 300);
                        }
                    });
                }
                
                if (toast && typeof bootstrap !== 'undefined') {
                    try {
                        const bsToast = new bootstrap.Toast(toast);
                        bsToast.show();
                    } catch (e) {
                        console.error('Toast error:', e);
                    }
                }
            }
        })
        .catch(error => {
            if (error.message !== 'Unauthorized') {
                console.error('Error:', error);
            }
        });
    };

    // Handle Review Form Submission
    const reviewForm = document.getElementById('review-form');
    if (reviewForm) {
        reviewForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const alertBox = document.getElementById('review-alert');
            alertBox.classList.add('d-none');

            const formData = new FormData(reviewForm);
            const data = Object.fromEntries(formData.entries());

            fetch(reviewForm.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(data)
            })
            .then(res => res.json())
            .then(data => {
                alertBox.classList.remove('d-none');
                if (data.success) {
                    alertBox.className = 'mt-3 alert alert-success';
                    alertBox.textContent = data.message;
                    reviewForm.reset();
                } else {
                    alertBox.className = 'mt-3 alert alert-danger';
                    alertBox.textContent = data.message || 'Error submitting review.';
                }
            })
            .catch(err => {
                alertBox.classList.remove('d-none');
                alertBox.className = 'mt-3 alert alert-danger';
                alertBox.textContent = 'An error occurred. Please try again.';
                console.error(err);
            });
        });
    }

    // Initial fetch
    fetchCart();
});

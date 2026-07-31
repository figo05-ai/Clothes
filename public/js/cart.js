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
            const qtyInput = document.querySelector('#product-quantity');
            const quantity = qtyInput ? parseInt(qtyInput.value) : 1;

            addToCart(productId, quantity);
        }
    });

    window.toggleWishlist = function(e, productId) {
        e.preventDefault();
        const btn = e.currentTarget;

        fetch('/api/wishlist/toggle', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ product_id: productId })
        })
        .then(res => {
            if (res.status === 401) {
                window.location.href = '/login';
                return;
            }
            return res.json();
        })
        .then(data => {
            if (data && data.success) {
                // Toggle active state visually (e.g. fill red heart)
                btn.classList.toggle('active');
                const svg = btn.querySelector('svg');
                if (btn.classList.contains('active') || data.message.includes('added')) {
                    svg.style.fill = 'red';
                } else {
                    svg.style.fill = 'none';
                }

                // If we are on the wishlist page and removed an item, we could reload
                if (window.location.pathname === '/wishlist' && data.message.includes('removed')) {
                    window.location.reload();
                }
            }
        })
        .catch(err => console.error(err));
    }

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

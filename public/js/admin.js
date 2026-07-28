document.addEventListener('DOMContentLoaded', () => {
    const contentDiv = document.getElementById('admin-content');
    const pageTitle = document.getElementById('page-title');
    const navLinks = document.querySelectorAll('.admin-nav-link');

    function router() {
        const path = window.location.pathname;
        let page = path.split('/')[2] || 'dashboard';
        
        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.dataset.page === page) link.classList.add('active');
        });
        loadPage(page);
    }

    window.addEventListener('popstate', router);
    
    document.getElementById('sidebar-nav').addEventListener('click', e => {
        if (e.target.tagName === 'A' && e.target.classList.contains('admin-nav-link')) {
            e.preventDefault();
            const url = e.target.getAttribute('href');
            history.pushState(null, '', url);
            router();
        }
    });

    async function loadPage(page) {
        contentDiv.innerHTML = `<div class="text-center py-5"><div class="spinner-border" style="color: var(--gold);" role="status"></div></div>`;
        try {
            if (page === 'dashboard') {
                pageTitle.innerText = 'Dashboard Overview';
                await renderDashboard();
            } else if (page === 'orders') {
                pageTitle.innerText = 'Order Management';
                await renderOrders();
            } else if (page === 'products') {
                pageTitle.innerText = 'Product Portfolio';
                await renderProducts();
            } else if (page === 'categories') {
                pageTitle.innerText = 'Categories';
                await renderCategories();
            } else if (page === 'users') {
                pageTitle.innerText = 'User Registry';
                await renderUsers();
            } else if (page === 'reviews') {
                pageTitle.innerText = 'Pending Reviews';
                await renderReviews();
            } else if (page === 'tickets') {
                pageTitle.innerText = 'Support Tickets';
                await renderTickets();
            } else {
                contentDiv.innerHTML = '<h4 class="text-muted">Page not found</h4>';
            }
        } catch (err) {
            console.error(err);
            contentDiv.innerHTML = `<div class="alert alert-danger" style="background-color: rgba(220,53,69,0.1); border-color: rgba(220,53,69,0.3); color: #ff6b6b;">Error loading data: ${err.message}</div>`;
        }
    }

    function showToast(message, type = 'success') {
        const toastId = 'toast-' + Date.now();
        const toastHTML = `
            <div id="${toastId}" class="toast align-items-center border-0 show" role="alert" style="margin-bottom: 10px; background-color: var(--bg-card); color: ${type === 'success' ? 'var(--gold)' : '#ff6b6b'}; border: 1px solid ${type === 'success' ? 'var(--gold)' : '#ff6b6b'};">
              <div class="d-flex">
                <div class="toast-body">${message}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" onclick="this.parentElement.parentElement.remove()"></button>
              </div>
            </div>
        `;
        document.getElementById('toast-container').insertAdjacentHTML('beforeend', toastHTML);
        setTimeout(() => { const el = document.getElementById(toastId); if(el) el.remove(); }, 4000);
    }

    async function renderDashboard() {
        const res = await fetch('/admin/api/analytics/dashboard');
        const data = await res.ok ? await res.json() : { data: { revenue: 0, orders: 0, customers: 0, products: 0 }};
        const stats = data.data || data;

        contentDiv.innerHTML = `
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card p-4 text-center">
                        <h6 class="text-muted text-uppercase mb-3" style="letter-spacing: 1px;">Total Revenue</h6>
                        <h2 class="stat-value">$${(stats.revenue || 0).toLocaleString()}</h2>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-4 text-center">
                        <h6 class="text-muted text-uppercase mb-3" style="letter-spacing: 1px;">Total Orders</h6>
                        <h2 class="stat-value">${stats.orders || 0}</h2>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-4 text-center">
                        <h6 class="text-muted text-uppercase mb-3" style="letter-spacing: 1px;">Customers</h6>
                        <h2 class="stat-value">${stats.customers || 0}</h2>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-4 text-center">
                        <h6 class="text-muted text-uppercase mb-3" style="letter-spacing: 1px;">Products Active</h6>
                        <h2 class="stat-value">${stats.products || 0}</h2>
                    </div>
                </div>
            </div>
            <div class="card p-5 text-center" style="border: 1px solid rgba(197, 169, 117, 0.2);">
                <h4 class="font-marcellus mb-3" style="color: var(--gold);">Welcome to the Executive Suite</h4>
                <p class="text-muted mx-auto" style="max-width: 600px;">Use the navigation menu to oversee operations, manage inventory, and handle high-level customer interactions.</p>
            </div>
        `;
    }

    async function renderOrders() {
        const res = await fetch('/admin/api/orders');
        const data = await res.json();
        const orders = data.data || [];

        let html = `
            <div class="card p-4">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Order Ref</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
        `;
        
        if (orders.length === 0) html += `<tr><td colspan="6" class="text-center py-4 text-muted">No orders found.</td></tr>`;

        orders.forEach(order => {
            html += `
                <tr>
                    <td class="font-marcellus" style="color: var(--gold);">#${order.id.slice(0,8)}</td>
                    <td>${order.user_id || 'Guest'}</td>
                    <td>$${order.total_amount || 0}</td>
                    <td><span class="badge bg-${order.status === 'completed' ? 'success' : 'warning'}">${order.status}</span></td>
                    <td>${new Date(order.created_at).toLocaleDateString()}</td>
                    <td>
                        <select class="form-select form-select-sm d-inline-block w-auto status-select" data-id="${order.id}">
                            <option value="pending" ${order.status === 'pending' ? 'selected' : ''}>Pending</option>
                            <option value="processing" ${order.status === 'processing' ? 'selected' : ''}>Processing</option>
                            <option value="completed" ${order.status === 'completed' ? 'selected' : ''}>Completed</option>
                            <option value="cancelled" ${order.status === 'cancelled' ? 'selected' : ''}>Cancelled</option>
                        </select>
                    </td>
                </tr>
            `;
        });

        html += `</tbody></table></div></div>`;
        contentDiv.innerHTML = html;

        document.querySelectorAll('.status-select').forEach(select => {
            select.addEventListener('change', async (e) => {
                const id = e.target.dataset.id;
                const newStatus = e.target.value;
                try {
                    const updateRes = await fetch(`/admin/api/orders/${id}/status`, {
                        method: 'PUT',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '' },
                        body: JSON.stringify({ status: newStatus })
                    });
                    if (updateRes.ok) showToast(`Order #${id.slice(0,8)} status updated to ${newStatus}`);
                    else throw new Error('Update failed');
                } catch(err) { showToast(err.message, 'danger'); }
            });
        });
    }

    async function renderProducts() {
        const res = await fetch('/admin/api/products');
        const data = await res.json();
        const products = data.data || [];

        let html = `
            <div class="card p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0 font-marcellus" style="color: var(--gold);">Catalog</h5>
                    <button class="btn btn-dark btn-sm" onclick="alert('Product creation coming soon!')">New Product</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
        `;
        
        if (products.length === 0) html += `<tr><td colspan="5" class="text-center py-4 text-muted">No products found.</td></tr>`;

        products.forEach(p => {
            html += `
                <tr>
                    <td class="text-muted">#${p.id}</td>
                    <td class="font-marcellus">${p.name}</td>
                    <td style="color: var(--gold);">$${p.price}</td>
                    <td><span class="badge bg-secondary">${p.is_active ? 'Active' : 'Inactive'}</span></td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-outline-primary edit-product-btn me-2" data-id="${p.id}" data-name="${p.name}" data-price="${p.price}">Edit</button>
                        <button class="btn btn-sm btn-outline-danger delete-product-btn" data-id="${p.id}" style="border-color: #ff6b6b; color: #ff6b6b;">Del</button>
                    </td>
                </tr>
            `;
        });

        html += `</tbody></table></div></div>`;
        contentDiv.innerHTML = html;

        document.querySelectorAll('.delete-product-btn').forEach(btn => {
            btn.addEventListener('click', async (e) => {
                if(confirm('Delete this product permanently?')) {
                    const id = e.target.dataset.id;
                    try {
                        const res = await fetch(`/admin/api/products/${id}`, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '' } });
                        if(res.ok) { showToast('Product removed'); renderProducts(); }
                    } catch (err) { showToast(err.message, 'danger'); }
                }
            });
        });

        document.querySelectorAll('.edit-product-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const { id, name, price } = e.target.dataset;
                const newName = prompt('Update Name:', name);
                if (newName) {
                    const newPrice = prompt('Update Price:', price);
                    if (newPrice) {
                        fetch(`/admin/api/products/${id}`, {
                            method: 'PUT',
                            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '' },
                            body: JSON.stringify({ name: newName, price: parseFloat(newPrice) })
                        }).then(res => {
                            if(res.ok) { showToast('Product updated'); renderProducts(); }
                            else { showToast('Update failed', 'danger'); }
                        });
                    }
                }
            });
        });
    }

    async function renderCategories() {
        const res = await fetch('/admin/api/categories');
        const data = await res.json();
        const categories = data.data || [];

        let html = `
            <div class="card p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0 font-marcellus" style="color: var(--gold);">Categories</h5>
                    <button class="btn btn-dark btn-sm">New Category</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
        `;
        
        if (categories.length === 0) html += `<tr><td colspan="3" class="text-center py-4 text-muted">No categories found.</td></tr>`;

        categories.forEach(c => {
            html += `
                <tr>
                    <td class="font-marcellus text-white">${c.name}</td>
                    <td class="text-muted">${c.description || '-'}</td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-outline-primary me-2">Edit</button>
                        <button class="btn btn-sm btn-outline-danger" style="border-color: #ff6b6b; color: #ff6b6b;">Del</button>
                    </td>
                </tr>
            `;
        });

        html += `</tbody></table></div></div>`;
        contentDiv.innerHTML = html;
    }

    async function renderUsers() {
        const res = await fetch('/admin/api/users');
        const data = await res.json();
        const users = data.data || [];

        let html = `
            <div class="card p-4">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Joined</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
        `;
        
        if (users.length === 0) html += `<tr><td colspan="4" class="text-center py-4 text-muted">No users found.</td></tr>`;

        users.forEach(u => {
            const isAdmin = u.roles && u.roles.some(r => r.name === 'admin');
            html += `
                <tr>
                    <td class="text-white">${u.name}</td>
                    <td class="text-muted">${u.email}</td>
                    <td class="text-muted">${new Date(u.created_at).toLocaleDateString()}</td>
                    <td><span class="badge ${isAdmin ? 'bg-warning' : 'bg-secondary'}">${isAdmin ? 'Admin' : 'Customer'}</span></td>
                </tr>
            `;
        });

        html += `</tbody></table></div></div>`;
        contentDiv.innerHTML = html;
    }

    async function renderReviews() {
        const res = await fetch('/admin/api/reviews/pending');
        const data = await res.ok ? await res.json() : { data: [] };
        const reviews = data.data || [];

        let html = `
            <div class="card p-4">
                <h5 class="mb-4 font-marcellus" style="color: var(--gold);">Pending Reviews</h5>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Product ID</th>
                                <th>User ID</th>
                                <th>Rating</th>
                                <th>Comment</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
        `;
        
        if (reviews.length === 0) html += `<tr><td colspan="5" class="text-center py-5 text-muted">No pending reviews to moderate.</td></tr>`;

        reviews.forEach(r => {
            html += `
                <tr>
                    <td>#${r.product_id}</td>
                    <td>${r.user_id}</td>
                    <td style="color: var(--gold);">${'★'.repeat(r.rating)}${'☆'.repeat(5-r.rating)}</td>
                    <td class="text-muted">"${r.comment}"</td>
                    <td>
                        <button class="btn btn-sm btn-outline-primary" onclick="alert('Approved!')">Approve</button>
                        <button class="btn btn-sm btn-outline-danger" style="border-color: #ff6b6b; color: #ff6b6b;" onclick="alert('Rejected!')">Reject</button>
                    </td>
                </tr>
            `;
        });

        html += `</tbody></table></div></div>`;
        contentDiv.innerHTML = html;
    }

    async function renderTickets() {
        const res = await fetch('/admin/api/support/tickets');
        const data = await res.ok ? await res.json() : { data: [] };
        const tickets = data.data || [];

        let html = `
            <div class="card p-4">
                <h5 class="mb-4 font-marcellus" style="color: var(--gold);">Support Inbox</h5>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Ticket ID</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
        `;
        
        if (tickets.length === 0) html += `<tr><td colspan="5" class="text-center py-5 text-muted">No open support tickets.</td></tr>`;

        tickets.forEach(t => {
            html += `
                <tr>
                    <td class="text-muted">#${t.id.slice(0,8)}</td>
                    <td class="text-white">${t.subject}</td>
                    <td><span class="badge ${t.status === 'open' ? 'bg-warning' : 'bg-success'}">${t.status}</span></td>
                    <td class="text-muted">${new Date(t.created_at).toLocaleDateString()}</td>
                    <td><button class="btn btn-sm btn-outline-primary">View / Reply</button></td>
                </tr>
            `;
        });

        html += `</tbody></table></div></div>`;
        contentDiv.innerHTML = html;
    }

    router();
});

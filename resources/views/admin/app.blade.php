<!DOCTYPE html>
<html lang="en">
<head>
  <title>Kaira Admin | Luxury Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/vendor.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('style.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Marcellus&display=swap" rel="stylesheet">
  <!-- Dark Luxury Admin Styles -->
  <style>
    :root {
      --bg-dark: #0f0f11;
      --bg-card: #1a1a1c;
      --gold: #c5a975;
      --gold-hover: #d4b884;
      --text-muted: #888888;
      --text-light: #f4f4f4;
      --border-color: #2a2a2c;
    }
    body { font-family: 'Jost', sans-serif; background-color: var(--bg-dark); color: var(--text-light); margin: 0; }
    h1, h2, h3, h4, h5, h6, .font-marcellus { font-family: 'Marcellus', serif; }
    
    .sidebar { min-height: 100vh; background-color: #080809; border-right: 1px solid var(--border-color); color: var(--text-light); position: relative; }
    .sidebar::after { content: ''; position: absolute; top: 0; right: -1px; width: 1px; height: 100%; background: linear-gradient(to bottom, transparent, var(--gold), transparent); opacity: 0.3; }
    .sidebar a { color: var(--text-muted); text-decoration: none; padding: 14px 20px; display: block; border-radius: 6px; margin-bottom: 8px; font-size: 0.95rem; text-transform: uppercase; letter-spacing: 1.5px; transition: all 0.3s ease; }
    .sidebar a:hover, .sidebar a.active { color: var(--gold); background-color: rgba(197, 169, 117, 0.05); transform: translateX(5px); }
    
    .content-area { padding: 30px; overflow-y: auto; height: 100vh; }
    .top-navbar { background-color: rgba(26, 26, 28, 0.8) !important; backdrop-filter: blur(10px); border-bottom: 1px solid var(--border-color); border-radius: 12px; margin-bottom: 30px; }
    
    .card { background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); transition: transform 0.3s ease; }
    .card:hover { transform: translateY(-3px); border-color: rgba(197, 169, 117, 0.3); }
    
    .table { color: var(--text-light); border-color: var(--border-color); margin-bottom: 0; }
    .table-light { background-color: #1f1f22; color: var(--text-muted); }
    .table th { font-weight: 500; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 1.5px; border-bottom: 1px solid var(--border-color) !important; background-color: #151516; color: var(--gold); padding: 15px; }
    .table td { vertical-align: middle; padding: 15px; border-color: var(--border-color); background-color: transparent !important; color: var(--text-light); }
    .table-hover tbody tr:hover td { background-color: rgba(255,255,255,0.02) !important; }
    
    .btn-dark { background-color: var(--gold); color: #000; border: none; font-weight: 500; transition: all 0.3s; }
    .btn-dark:hover { background-color: var(--gold-hover); color: #000; box-shadow: 0 4px 15px rgba(197,169,117,0.3); }
    .btn-outline-primary { color: var(--gold); border-color: var(--gold); }
    .btn-outline-primary:hover { background-color: var(--gold); color: #000; }
    
    .form-select, .form-control { background-color: #111; border: 1px solid var(--border-color); color: var(--text-light); }
    .form-select:focus, .form-control:focus { background-color: #111; color: var(--text-light); border-color: var(--gold); box-shadow: 0 0 0 0.25rem rgba(197, 169, 117, 0.25); }
    
    .badge { padding: 6px 10px; font-weight: 400; letter-spacing: 0.5px; }
    .badge.bg-success { background-color: rgba(40, 167, 69, 0.2) !important; color: #28a745 !important; border: 1px solid rgba(40, 167, 69, 0.3); }
    .badge.bg-warning { background-color: rgba(255, 193, 7, 0.1) !important; color: #ffc107 !important; border: 1px solid rgba(255, 193, 7, 0.3); }
    .badge.bg-secondary { background-color: rgba(255, 255, 255, 0.05) !important; color: var(--text-muted) !important; border: 1px solid rgba(255, 255, 255, 0.1); }
    
    .toast-container { position: fixed; top: 20px; right: 20px; z-index: 1055; }
    .toast { background-color: var(--bg-card); color: var(--gold); border: 1px solid var(--gold); box-shadow: 0 4px 20px rgba(0,0,0,0.5); }
    .toast-body { font-size: 0.95rem; }
    
    .stat-value { font-size: 2.5rem; color: var(--gold); font-family: 'Marcellus', serif; }
  </style>
</head>
<body>
  <div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar p-4" style="width: 260px;">
      <h3 class="mb-5 mt-2 text-center" style="color: var(--gold); letter-spacing: 2px;">KAIRA</h3>
      <nav id="sidebar-nav">
        <a href="/admin/dashboard" data-page="dashboard" class="admin-nav-link active">Dashboard</a>
        <a href="/admin/orders" data-page="orders" class="admin-nav-link">Orders</a>
        <a href="/admin/products" data-page="products" class="admin-nav-link">Products</a>
        <a href="/admin/categories" data-page="categories" class="admin-nav-link">Categories</a>
        <a href="/admin/users" data-page="users" class="admin-nav-link">Users</a>
        <a href="/admin/reviews" data-page="reviews" class="admin-nav-link">Reviews</a>
        <a href="/admin/tickets" data-page="tickets" class="admin-nav-link">Support Tickets</a>
        <a href="/" class="mt-5" style="border-top: 1px solid var(--border-color); padding-top: 20px; color: var(--text-muted);">Back to Store</a>
      </nav>
    </div>
    
    
    <!-- Main Content -->
    <div class="flex-grow-1 content-area">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg top-navbar p-3 d-flex justify-content-between">
        <span class="navbar-brand mb-0 h4 font-marcellus text-white" id="page-title">Dashboard</span>
        <div class="d-flex align-items-center">
          <span class="me-3" style="color: var(--gold);">{{ auth()->user()->name ?? 'Admin User' }}</span>
          <form method="POST" action="{{ route('logout') }}" class="d-inline">
             @csrf
             <button type="submit" class="btn btn-outline-light btn-sm" style="border-color: var(--border-color);">Logout</button>
          </form>
        </div>
      </nav>

      <!-- Dynamic Content Wrapper -->
      <div id="admin-content">
        <div class="text-center py-5">
          <div class="spinner-border" style="color: var(--gold);" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="toast-container" id="toast-container"></div>
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>

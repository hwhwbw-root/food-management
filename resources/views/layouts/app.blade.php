<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FoodSaver') — FoodSaver</title>

    <!-- Fonts: DM Serif Display (display) + Plus Jakarta Sans (body) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* ── Design System ── */
        :root {
            --forest:  #1B4332;
            --forest-light: #2D6A4F;
            --amber:   #D97706;
            --amber-light: #F59E0B;
            --cream:   #FAFAF7;
            --dark:    #1C1917;
            --muted:   #78716C;
            --border:  #E7E5E4;
            --white:   #FFFFFF;
            --danger:  #DC2626;
            --shadow:  0 2px 12px rgba(27,67,50,.10);
            --shadow-hover: 0 8px 28px rgba(27,67,50,.16);
        }

        /* ── Base ── */
        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--cream);
            color: var(--dark);
            font-size: 15px;
            line-height: 1.6;
        }

        h1, h2, h3, h4, h5, .display-font {
            font-family: 'DM Serif Display', serif;
            letter-spacing: -0.01em;
        }

        /* ── Navbar ── */
        .navbar {
            background-color: var(--forest) !important;
            padding: 0.9rem 0;
            border-bottom: 3px solid var(--amber);
        }

        .navbar-brand {
            font-family: 'DM Serif Display', serif;
            font-size: 1.5rem;
            color: var(--white) !important;
            letter-spacing: -0.02em;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .navbar-brand .brand-dot {
            color: var(--amber);
        }

        .navbar .nav-link {
            color: rgba(255,255,255,.75) !important;
            font-size: 0.875rem;
            font-weight: 500;
            padding: 0.4rem 0.8rem !important;
            border-radius: 6px;
            transition: color .2s, background .2s;
        }

        .navbar .nav-link:hover {
            color: var(--white) !important;
            background: rgba(255,255,255,.08);
        }

        .navbar .dropdown-menu {
            border: 1px solid var(--border);
            border-radius: 10px;
            box-shadow: var(--shadow-hover);
            padding: 0.4rem;
        }

        .navbar .dropdown-item {
            border-radius: 6px;
            font-size: 0.875rem;
            padding: 0.5rem 0.9rem;
        }

        .btn-navbar-cta {
            background-color: var(--amber);
            color: var(--dark) !important;
            font-weight: 700;
            font-size: 0.8rem;
            padding: 0.45rem 1rem;
            border-radius: 8px;
            border: none;
            transition: background .2s, transform .15s;
            text-decoration: none;
        }

        .btn-navbar-cta:hover {
            background-color: var(--amber-light);
            color: var(--dark) !important;
            transform: translateY(-1px);
        }

        .user-badge {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: rgba(255,255,255,.85) !important;
            font-size: 0.875rem;
            font-weight: 500;
        }

        /* ── Main ── */
        main.container {
            padding-top: 2.5rem;
            padding-bottom: 3rem;
            min-height: calc(100vh - 160px);
        }

        /* ── Cards ── */
        .card {
            border: 1px solid var(--border);
            border-radius: 14px;
            box-shadow: var(--shadow);
            background: var(--white);
            transition: box-shadow .2s, transform .2s;
        }

        .card:hover { box-shadow: var(--shadow-hover); }

        /* ── Food Listing Cards (the memorable anchor) ── */
        .food-card {
            border-left: 4px solid var(--amber);
            border-radius: 14px;
            overflow: hidden;
            transition: transform .2s, box-shadow .2s;
        }

        .food-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
        }

        .food-card .price-tag {
            font-family: 'DM Serif Display', serif;
            font-size: 1.4rem;
            color: var(--forest);
            line-height: 1;
        }

        .food-card .price-tag.free {
            color: var(--amber);
        }

        .food-card .card-img-top {
            height: 180px;
            object-fit: cover;
        }

        /* ── Buttons ── */
        .btn-primary {
            background-color: var(--forest);
            border-color: var(--forest);
            color: var(--white);
            font-weight: 600;
            border-radius: 8px;
            padding: 0.5rem 1.25rem;
            transition: background .2s, transform .15s;
        }

        .btn-primary:hover, .btn-primary:focus {
            background-color: var(--forest-light);
            border-color: var(--forest-light);
            color: var(--white);
            transform: translateY(-1px);
        }

        .btn-amber {
            background-color: var(--amber);
            border: none;
            color: var(--dark);
            font-weight: 700;
            border-radius: 8px;
            padding: 0.5rem 1.25rem;
            transition: background .2s, transform .15s;
        }

        .btn-amber:hover {
            background-color: var(--amber-light);
            color: var(--dark);
            transform: translateY(-1px);
        }

        .btn-outline-primary {
            border-color: var(--forest);
            color: var(--forest);
            font-weight: 600;
            border-radius: 8px;
        }

        .btn-outline-primary:hover {
            background-color: var(--forest);
            border-color: var(--forest);
            color: var(--white);
        }

        .btn-outline-secondary {
            border-color: var(--border);
            color: var(--muted);
            font-weight: 500;
            border-radius: 8px;
        }

        .btn-outline-secondary:hover {
            background-color: var(--cream);
            border-color: var(--border);
            color: var(--dark);
        }

        .btn-outline-danger {
            border-color: #FECACA;
            color: var(--danger);
            font-weight: 500;
            border-radius: 8px;
            font-size: 0.8rem;
        }

        .btn-outline-danger:hover {
            background-color: #FEF2F2;
            border-color: #FECACA;
            color: var(--danger);
        }

        /* ── Badges ── */
        .badge-available  { background: #DCFCE7; color: #166534; }
        .badge-reserved   { background: #FEF9C3; color: #854D0E; }
        .badge-claimed    { background: #DBEAFE; color: #1E40AF; }
        .badge-expired    { background: #F3F4F6; color: #6B7280; }
        .badge-pending    { background: #FEF9C3; color: #854D0E; }
        .badge-confirmed  { background: #DCFCE7; color: #166534; }
        .badge-cancelled  { background: #FEE2E2; color: #991B1B; }
        .badge-completed  { background: #DBEAFE; color: #1E40AF; }
        .badge-vendor     { background: #D1FAE5; color: #065F46; }
        .badge-buyer      { background: #DBEAFE; color: #1E40AF; }
        .badge-admin      { background: #FEE2E2; color: #991B1B; }

        .status-badge {
            display: inline-block;
            padding: 0.3rem 0.75rem;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        /* ── Tables ── */
        .fs-table {
            background: var(--white);
            border-radius: 14px;
            overflow: hidden;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
        }

        .fs-table thead th {
            background: var(--cream);
            border-bottom: 2px solid var(--border);
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--muted);
            padding: 0.9rem 1.1rem;
        }

        .fs-table tbody td {
            padding: 0.85rem 1.1rem;
            border-bottom: 1px solid var(--border);
            font-size: 0.875rem;
            vertical-align: middle;
            color: var(--dark);
        }

        .fs-table tbody tr:last-child td { border-bottom: none; }
        .fs-table tbody tr:hover td { background: #F9FBF9; }

        /* ── Forms ── */
        .form-label {
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--muted);
            margin-bottom: 0.35rem;
        }

        .form-control, .form-select {
            border: 1.5px solid var(--border);
            border-radius: 9px;
            padding: 0.6rem 0.9rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.9rem;
            background: var(--white);
            color: var(--dark);
            transition: border-color .2s, box-shadow .2s;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--forest);
            box-shadow: 0 0 0 3px rgba(27,67,50,.12);
            outline: none;
        }

        /* ── Alerts ── */
        .alert {
            border-radius: 10px;
            border: none;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .alert-success {
            background: #DCFCE7;
            color: #166534;
        }

        .alert-danger {
            background: #FEE2E2;
            color: #991B1B;
        }

        /* ── Section headings ── */
        .page-heading {
            font-family: 'DM Serif Display', serif;
            font-size: 1.75rem;
            color: var(--forest);
            margin-bottom: 0;
        }

        .page-subheading {
            color: var(--muted);
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        /* ── Stat cards (admin) ── */
        .stat-card {
            border-radius: 14px;
            padding: 1.4rem 1.6rem;
            border: 1px solid var(--border);
            background: var(--white);
            box-shadow: var(--shadow);
        }

        .stat-card .stat-value {
            font-family: 'DM Serif Display', serif;
            font-size: 2.4rem;
            line-height: 1;
            color: var(--forest);
        }

        .stat-card .stat-label {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--muted);
            margin-top: 0.3rem;
        }

        .stat-card .stat-icon {
            font-size: 1.5rem;
            color: var(--amber);
        }

        /* ── Empty state ── */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--muted);
        }

        .empty-state i {
            font-size: 3rem;
            color: var(--border);
            display: block;
            margin-bottom: 1rem;
        }

        /* ── Footer ── */
        footer {
            background: var(--forest);
            color: rgba(255,255,255,.5);
            font-size: 0.8rem;
            padding: 1.5rem 0;
            text-align: center;
            margin-top: 4rem;
        }

        footer span { color: var(--amber); }

        /* ── Pagination ── */
        .pagination .page-link {
            color: var(--forest);
            border-color: var(--border);
            border-radius: 8px;
            margin: 0 2px;
            font-size: 0.875rem;
        }

        .pagination .page-item.active .page-link {
            background-color: var(--forest);
            border-color: var(--forest);
        }

        /* ── Divider ── */
        .amber-divider {
            height: 3px;
            background: linear-gradient(90deg, var(--amber), transparent);
            border: none;
            border-radius: 3px;
            margin: 1.5rem 0;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="bi bi-leaf-fill brand-dot"></i>
                FoodSaver<span class="brand-dot">.</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu"
                    style="color: rgba(255,255,255,.7);">
                <i class="bi bi-list" style="font-size:1.4rem;"></i>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto align-items-center gap-1">
                    @guest
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item ms-1">
                            <a class="btn-navbar-cta" href="{{ route('register') }}">Join Free</a>
                        </li>
                    @else
                        @if(auth()->user()->isVendor())
                            <li class="nav-item"><a class="nav-link" href="{{ route('vendor.listings.index') }}">My Listings</a></li>
                            <li class="nav-item ms-1">
                                <a class="btn-navbar-cta" href="{{ route('vendor.listings.create') }}">
                                    <i class="bi bi-plus-lg me-1"></i>Post Food
                                </a>
                            </li>
                        @elseif(auth()->user()->isBuyer())
                            <li class="nav-item"><a class="nav-link" href="{{ route('buyer.listings.index') }}">Browse Food</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('buyer.reservations') }}">My Reservations</a></li>
                        @elseif(auth()->user()->isAdmin())
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.users') }}">Users</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.listings') }}">Listings</a></li>
                        @endif

                        <li class="nav-item dropdown ms-2">
                            <a class="nav-link dropdown-toggle user-badge" href="#" data-bs-toggle="dropdown">
                                <span style="width:30px;height:30px;border-radius:50%;background:var(--amber);display:inline-flex;align-items:center;justify-content:center;color:var(--dark);font-weight:700;font-size:.75rem;">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </span>
                                {{ explode(' ', auth()->user()->name)[0] }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li class="px-3 py-2 border-bottom" style="font-size:.8rem;color:var(--muted);">
                                    Signed in as <strong style="color:var(--dark);">{{ auth()->user()->name }}</strong>
                                </li>
                                <li class="mt-1">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="dropdown-item text-danger fw-600" type="submit">
                                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4 d-flex align-items-center gap-2">
                <i class="bi bi-check-circle-fill"></i>
                {{ session('success') }}
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4 d-flex align-items-center gap-2">
                <i class="bi bi-exclamation-circle-fill"></i>
                {{ session('error') }}
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <footer>
        &copy; {{ date('Y') }} <span>FoodSaver</span> — Reducing food waste in Malaysia &nbsp;·&nbsp; BIIT 2305
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

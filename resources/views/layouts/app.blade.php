<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FoodSaver') · FoodSaver</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,300..800&family=Chivo:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* ── Design Tokens (OKLCH) ── */
        :root {
            --forest:        oklch(28% 0.075 155);
            --forest-light:  oklch(40% 0.085 155);
            --amber:         oklch(64% 0.165 68);
            --amber-light:   oklch(72% 0.17 70);
            --cream:         oklch(99% 0.006 90);
            --dark:          oklch(14% 0.01 50);
            --muted:         oklch(51% 0.015 50);
            --border:        oklch(92% 0.005 50);
            --white:         oklch(99.5% 0.003 90);
            --danger:        oklch(55% 0.22 27);
            --shadow:        0 2px 12px oklch(28% 0.075 155 / 0.08);
            --shadow-hover:  0 8px 32px oklch(28% 0.075 155 / 0.14);
            --ease-out:      cubic-bezier(0.16, 1, 0.3, 1);
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'Chivo', sans-serif;
            background-color: var(--cream);
            color: var(--dark);
            font-size: 15px;
            line-height: 1.6;
        }

        h1, h2, h3, h4, h5, .display-font {
            font-family: 'Bricolage Grotesque', sans-serif;
            font-weight: 700;
            letter-spacing: -0.02em;
        }

        /* ── Navbar ── */
        .navbar {
            background-color: var(--forest) !important;
            padding: 0.85rem 0;
            border-bottom: 1px solid oklch(64% 0.165 68 / 0.25);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar-brand {
            font-family: 'Bricolage Grotesque', sans-serif;
            font-size: 1.45rem;
            font-weight: 800;
            color: var(--white) !important;
            letter-spacing: -0.03em;
            display: flex;
            align-items: center;
            gap: 0.35rem;
        }

        .navbar-brand .brand-dot { color: var(--amber); }

        .navbar .nav-link {
            color: oklch(99.5% 0.003 90 / 0.7) !important;
            font-size: 0.875rem;
            font-weight: 500;
            padding: 0.4rem 0.8rem !important;
            border-radius: 6px;
            transition: color 0.2s var(--ease-out), background 0.2s var(--ease-out);
        }

        .navbar .nav-link:hover {
            color: var(--white) !important;
            background: oklch(99.5% 0.003 90 / 0.09);
        }

        .navbar .dropdown-menu {
            border: 1px solid var(--border);
            border-radius: 12px;
            box-shadow: var(--shadow-hover);
            padding: 0.4rem;
        }

        .navbar .dropdown-item {
            border-radius: 8px;
            font-size: 0.875rem;
            padding: 0.5rem 0.9rem;
            transition: background 0.15s var(--ease-out);
        }

        .btn-navbar-cta {
            background-color: var(--amber);
            color: var(--dark) !important;
            font-weight: 700;
            font-size: 0.8rem;
            padding: 0.45rem 1.1rem;
            border-radius: 8px;
            border: none;
            transition: background 0.25s var(--ease-out), transform 0.2s var(--ease-out);
            text-decoration: none;
            display: inline-block;
        }

        .btn-navbar-cta:hover  { background-color: var(--amber-light); transform: translateY(-1px); }
        .btn-navbar-cta:active { transform: translateY(0) scale(0.98); }

        .user-badge {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: oklch(99.5% 0.003 90 / 0.85) !important;
            font-size: 0.875rem;
            font-weight: 500;
        }

        /* ── Main ── */
        main.container {
            padding-top: 2.5rem;
            padding-bottom: 3.5rem;
            min-height: calc(100vh - 160px);
        }

        /* ── Cards ── */
        .card {
            border: 1px solid var(--border);
            border-radius: 14px;
            box-shadow: var(--shadow);
            background: var(--white);
            transition: box-shadow 0.3s var(--ease-out), transform 0.3s var(--ease-out);
        }

        .card:hover { box-shadow: var(--shadow-hover); }

        /* ── Food Listing Cards ── */
        .food-card {
            border: 1.5px solid oklch(64% 0.165 68 / 0.22);
            border-radius: 14px;
            overflow: hidden;
            background: var(--white);
            transition: transform 0.3s var(--ease-out), box-shadow 0.3s var(--ease-out), border-color 0.3s var(--ease-out);
        }

        .food-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
            border-color: oklch(64% 0.165 68 / 0.55);
        }

        .food-card .price-tag {
            font-family: 'Bricolage Grotesque', sans-serif;
            font-weight: 800;
            font-size: 1.45rem;
            color: var(--forest);
            line-height: 1;
            letter-spacing: -0.02em;
        }

        .food-card .price-tag.free { color: var(--amber); }

        .food-card .card-img-top {
            height: 200px;
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
            transition: background 0.25s var(--ease-out), transform 0.2s var(--ease-out), box-shadow 0.2s var(--ease-out);
        }

        .btn-primary:hover, .btn-primary:focus {
            background-color: var(--forest-light);
            border-color: var(--forest-light);
            color: var(--white);
            transform: translateY(-1px);
        }

        .btn-primary:active { transform: translateY(1px) scale(0.98); }

        .btn-amber {
            background-color: var(--amber);
            border: none;
            color: var(--dark);
            font-weight: 700;
            border-radius: 8px;
            padding: 0.5rem 1.25rem;
            display: inline-block;
            transition: background 0.25s var(--ease-out), transform 0.2s var(--ease-out);
        }

        .btn-amber:hover  { background-color: var(--amber-light); color: var(--dark); transform: translateY(-1px); }
        .btn-amber:active { transform: translateY(1px) scale(0.98); }

        .btn-outline-primary {
            border-color: var(--forest);
            color: var(--forest);
            font-weight: 600;
            border-radius: 8px;
            transition: background 0.2s var(--ease-out), color 0.2s var(--ease-out), transform 0.2s var(--ease-out);
        }

        .btn-outline-primary:hover  { background-color: var(--forest); border-color: var(--forest); color: var(--white); }
        .btn-outline-primary:active { transform: scale(0.98); }

        .btn-outline-secondary {
            border-color: var(--border);
            color: var(--muted);
            font-weight: 500;
            border-radius: 8px;
            transition: background 0.2s var(--ease-out), color 0.2s var(--ease-out), transform 0.2s var(--ease-out);
        }

        .btn-outline-secondary:hover  { background-color: var(--cream); border-color: var(--border); color: var(--dark); }
        .btn-outline-secondary:active { transform: scale(0.98); }

        .btn-outline-danger {
            border-color: oklch(87% 0.08 27);
            color: var(--danger);
            font-weight: 500;
            border-radius: 8px;
            font-size: 0.8rem;
            transition: background 0.2s var(--ease-out), transform 0.2s var(--ease-out);
        }

        .btn-outline-danger:hover  { background-color: oklch(97% 0.04 27); border-color: oklch(87% 0.08 27); color: var(--danger); }
        .btn-outline-danger:active { transform: scale(0.98); }

        /* ── Status Badges ── */
        .badge-available  { background: oklch(96% 0.06 142);   color: oklch(32% 0.1 142); }
        .badge-reserved   { background: oklch(97.5% 0.07 88);  color: oklch(42% 0.13 68); }
        .badge-claimed    { background: oklch(94% 0.04 240);   color: oklch(34% 0.12 252); }
        .badge-expired    { background: oklch(96% 0.003 50);   color: oklch(55% 0.01 50); }
        .badge-pending    { background: oklch(97.5% 0.07 88);  color: oklch(42% 0.13 68); }
        .badge-confirmed  { background: oklch(96% 0.06 142);   color: oklch(32% 0.1 142); }
        .badge-cancelled  { background: oklch(96% 0.06 27);    color: oklch(35% 0.14 27); }
        .badge-completed  { background: oklch(94% 0.04 240);   color: oklch(34% 0.12 252); }
        .badge-vendor     { background: oklch(95% 0.055 160);  color: oklch(30% 0.1 160); }
        .badge-buyer      { background: oklch(94% 0.04 240);   color: oklch(34% 0.12 252); }
        .badge-admin      { background: oklch(96% 0.06 27);    color: oklch(35% 0.14 27); }

        .status-badge {
            display: inline-block;
            padding: 0.28rem 0.75rem;
            border-radius: 999px;
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
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
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.07em;
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
        .fs-table tbody tr { transition: background 0.15s var(--ease-out); }
        .fs-table tbody tr:hover td { background: oklch(98.5% 0.015 155); }

        /* ── Forms ── */
        .form-label {
            font-family: 'Chivo', sans-serif;
            font-size: 0.78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--muted);
            margin-bottom: 0.35rem;
        }

        .form-control, .form-select {
            border: 1.5px solid var(--border);
            border-radius: 9px;
            padding: 0.6rem 0.9rem;
            font-family: 'Chivo', sans-serif;
            font-size: 0.9rem;
            background: var(--white);
            color: var(--dark);
            transition: border-color 0.2s var(--ease-out), box-shadow 0.2s var(--ease-out);
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--forest);
            box-shadow: 0 0 0 3px oklch(28% 0.075 155 / 0.1);
            outline: none;
        }

        /* ── Alerts ── */
        .alert {
            border-radius: 10px;
            border: none;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .alert-success { background: oklch(96% 0.06 142); color: oklch(32% 0.1 142); }
        .alert-danger  { background: oklch(96% 0.06 27);  color: oklch(35% 0.14 27); }

        /* ── Section headings ── */
        .page-heading {
            font-family: 'Bricolage Grotesque', sans-serif;
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--forest);
            margin-bottom: 0;
            letter-spacing: -0.02em;
        }

        .page-subheading {
            color: var(--muted);
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        /* ── Stat cards ── */
        .stat-card {
            border-radius: 14px;
            padding: 1.5rem 1.75rem;
            border: 1px solid var(--border);
            background: var(--white);
            box-shadow: var(--shadow);
            transition: box-shadow 0.3s var(--ease-out), transform 0.3s var(--ease-out);
        }

        .stat-card:hover { box-shadow: var(--shadow-hover); transform: translateY(-2px); }

        .stat-card .stat-value {
            font-family: 'Bricolage Grotesque', sans-serif;
            font-weight: 800;
            font-size: 2.6rem;
            line-height: 1;
            color: var(--forest);
            letter-spacing: -0.03em;
        }

        .stat-card .stat-value-lg {
            font-family: 'Bricolage Grotesque', sans-serif;
            font-weight: 800;
            font-size: 3.8rem;
            line-height: 1;
            color: var(--forest);
            letter-spacing: -0.03em;
        }

        .stat-card .stat-label {
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            color: var(--muted);
            margin-top: 0.4rem;
        }

        .stat-card .stat-icon { font-size: 1.4rem; color: var(--amber); }

        /* ── Empty state ── */
        .empty-state {
            text-align: center;
            padding: 4.5rem 2rem;
            color: var(--muted);
        }

        .empty-state i {
            font-size: 3rem;
            color: var(--border);
            display: block;
            margin-bottom: 1.1rem;
        }

        /* ── Footer ── */
        footer {
            background: var(--forest);
            color: oklch(99.5% 0.003 90 / 0.45);
            font-size: 0.78rem;
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
            transition: background 0.2s var(--ease-out), color 0.2s var(--ease-out);
        }

        .pagination .page-item.active .page-link {
            background-color: var(--forest);
            border-color: var(--forest);
        }

        /* ── Divider ── */
        .amber-divider {
            height: 2px;
            background: linear-gradient(90deg, var(--amber), transparent);
            border: none;
            border-radius: 2px;
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
                    style="color:oklch(99.5% 0.003 90 / 0.7);">
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
                                        <button class="dropdown-item text-danger" type="submit" style="font-weight:600;">
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
        &copy; {{ date('Y') }} <span>FoodSaver</span> &nbsp;&middot;&nbsp; Reducing food waste in Malaysia &nbsp;&middot;&nbsp; BIIT 2305
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

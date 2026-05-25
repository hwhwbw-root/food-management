@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-start mb-5 flex-wrap gap-2">
    <div>
        <h1 class="page-heading">Admin Dashboard</h1>
        <p class="page-subheading">Platform health overview</p>
    </div>
    <div style="font-size:.75rem;color:var(--muted);text-align:right;line-height:1.5;">
        Last updated<br><strong style="color:var(--dark);">{{ now()->format('d M Y, h:i A') }}</strong>
    </div>
</div>

{{-- Bento top row: 2 anchor stats --}}
<div class="row g-3 mb-3">
    <div class="col-md-6">
        <div class="stat-card" style="border-color:oklch(64% 0.165 68 / 0.3);">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value-lg">{{ $totalUsers }}</div>
                    <div class="stat-label">Total Users</div>
                </div>
                <i class="bi bi-people-fill stat-icon" style="font-size:2rem;"></i>
            </div>
            <div style="margin-top:1rem;padding-top:1rem;border-top:1px solid var(--border);display:flex;gap:1.5rem;">
                <div>
                    <div style="font-family:'Bricolage Grotesque',sans-serif;font-weight:800;font-size:1.3rem;color:var(--forest);letter-spacing:-0.02em;">{{ $vendors }}</div>
                    <div style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:var(--muted);">Vendors</div>
                </div>
                <div>
                    <div style="font-family:'Bricolage Grotesque',sans-serif;font-weight:800;font-size:1.3rem;color:var(--forest);letter-spacing:-0.02em;">{{ $buyers }}</div>
                    <div style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:var(--muted);">Buyers</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="stat-card" style="border-color:oklch(28% 0.075 155 / 0.3);">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value-lg">{{ $totalListings }}</div>
                    <div class="stat-label">Total Listings</div>
                </div>
                <i class="bi bi-card-list stat-icon" style="font-size:2rem;"></i>
            </div>
            <div style="margin-top:1rem;padding-top:1rem;border-top:1px solid var(--border);display:flex;gap:1.5rem;">
                <div>
                    <div style="font-family:'Bricolage Grotesque',sans-serif;font-weight:800;font-size:1.3rem;color:var(--forest);letter-spacing:-0.02em;">{{ $active }}</div>
                    <div style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:var(--muted);">Active</div>
                </div>
                <div>
                    <div style="font-family:'Bricolage Grotesque',sans-serif;font-weight:800;font-size:1.3rem;color:var(--forest);letter-spacing:-0.02em;">{{ $reservations }}</div>
                    <div style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:var(--muted);">Reservations</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Quick actions --}}
<hr class="amber-divider" style="margin:2rem 0;">

<p style="font-size:.72rem;font-weight:800;letter-spacing:.1em;text-transform:uppercase;color:var(--muted);margin-bottom:1rem;">Quick Actions</p>

<div class="row g-3">
    <div class="col-md-6">
        <a href="{{ route('admin.users') }}" class="card p-4 text-decoration-none" style="display:block;transition:transform .25s var(--ease-out),box-shadow .25s var(--ease-out);">
            <div class="d-flex align-items-center gap-3">
                <div style="width:48px;height:48px;border-radius:12px;background:oklch(97.5% 0.07 88);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="bi bi-people" style="color:var(--amber);font-size:1.3rem;"></i>
                </div>
                <div>
                    <div style="font-weight:700;color:var(--dark);font-size:.95rem;">Manage Users</div>
                    <div style="font-size:.8rem;color:var(--muted);">View, search and remove accounts</div>
                </div>
                <i class="bi bi-arrow-right ms-auto" style="color:var(--border);"></i>
            </div>
        </a>
    </div>
    <div class="col-md-6">
        <a href="{{ route('admin.listings') }}" class="card p-4 text-decoration-none" style="display:block;transition:transform .25s var(--ease-out),box-shadow .25s var(--ease-out);">
            <div class="d-flex align-items-center gap-3">
                <div style="width:48px;height:48px;border-radius:12px;background:oklch(95% 0.055 160);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="bi bi-card-list" style="color:var(--forest);font-size:1.3rem;"></i>
                </div>
                <div>
                    <div style="font-weight:700;color:var(--dark);font-size:.95rem;">Manage Listings</div>
                    <div style="font-size:.8rem;color:var(--muted);">Review and remove food listings</div>
                </div>
                <i class="bi bi-arrow-right ms-auto" style="color:var(--border);"></i>
            </div>
        </a>
    </div>
</div>
@endsection

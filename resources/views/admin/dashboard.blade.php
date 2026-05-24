@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="mb-4">
    <h1 class="page-heading">Admin Dashboard</h1>
    <p class="page-subheading">Platform health overview</p>
</div>

{{-- Stat cards --}}
<div class="row g-3 mb-5">
    @foreach([
        ['bi-people-fill',      $totalUsers,   'Total Users',   null],
        ['bi-shop-window-fill', $vendors,      'Vendors',       null],
        ['bi-bag-heart-fill',   $buyers,       'Buyers',        null],
        ['bi-card-list',        $totalListings,'Total Listings', null],
        ['bi-check-circle-fill',$active,       'Active',        null],
        ['bi-bookmark-fill',    $reservations, 'Reservations',  null],
    ] as [$icon, $value, $label, $_])
    <div class="col-6 col-md-4 col-lg-2">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <div class="stat-value">{{ $value }}</div>
                <i class="bi {{ $icon }} stat-icon"></i>
            </div>
            <div class="stat-label">{{ $label }}</div>
        </div>
    </div>
    @endforeach
</div>

<hr class="amber-divider">

{{-- Quick actions --}}
<h2 class="page-heading mb-3" style="font-size:1.2rem;">Quick Actions</h2>
<div class="d-flex gap-3 flex-wrap">
    <a href="{{ route('admin.users') }}" class="btn btn-primary" style="padding:.7rem 1.75rem;">
        <i class="bi bi-people me-2"></i>Manage Users
    </a>
    <a href="{{ route('admin.listings') }}" class="btn btn-outline-primary" style="padding:.7rem 1.75rem;">
        <i class="bi bi-card-list me-2"></i>Manage Listings
    </a>
</div>
@endsection

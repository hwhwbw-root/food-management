@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<h4 class="fw-bold mb-4">Admin Dashboard</h4>

<div class="row g-4 mb-4">
    <div class="col-md-2">
        <div class="card p-3 text-center">
            <div class="fs-2 fw-bold text-primary">{{ $totalUsers }}</div>
            <div class="small text-muted">Total Users</div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card p-3 text-center">
            <div class="fs-2 fw-bold text-success">{{ $vendors }}</div>
            <div class="small text-muted">Vendors</div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card p-3 text-center">
            <div class="fs-2 fw-bold text-info">{{ $buyers }}</div>
            <div class="small text-muted">Buyers</div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card p-3 text-center">
            <div class="fs-2 fw-bold text-warning">{{ $totalListings }}</div>
            <div class="small text-muted">Listings</div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card p-3 text-center">
            <div class="fs-2 fw-bold text-success">{{ $active }}</div>
            <div class="small text-muted">Active</div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card p-3 text-center">
            <div class="fs-2 fw-bold text-secondary">{{ $reservations }}</div>
            <div class="small text-muted">Reservations</div>
        </div>
    </div>
</div>

<div class="d-flex gap-3">
    <a href="{{ route('admin.users') }}" class="btn btn-outline-primary">Manage Users</a>
    <a href="{{ route('admin.listings') }}" class="btn btn-outline-warning">Manage Listings</a>
</div>
@endsection

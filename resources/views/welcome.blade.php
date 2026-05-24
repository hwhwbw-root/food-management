@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
<div class="text-center py-5">
    <i class="bi bi-leaf-fill text-success" style="font-size: 4rem;"></i>
    <h1 class="display-5 fw-bold mt-3">FoodSaver Malaysia</h1>
    <p class="lead text-muted col-md-6 mx-auto">
        Connecting food vendors with consumers to reduce food waste — one meal at a time.
    </p>
    <div class="d-flex justify-content-center gap-3 mt-4">
        <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Get Started</a>
        <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg">Login</a>
    </div>
</div>

<div class="row g-4 mt-4">
    <div class="col-md-4">
        <div class="card p-4 text-center h-100">
            <i class="bi bi-shop text-success fs-2 mb-3"></i>
            <h5>For Vendors</h5>
            <p class="text-muted small">Post surplus food, reduce waste, and help your community while recovering costs.</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-4 text-center h-100">
            <i class="bi bi-bag-heart text-success fs-2 mb-3"></i>
            <h5>For Buyers</h5>
            <p class="text-muted small">Browse affordable or free food listings from local businesses near you.</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-4 text-center h-100">
            <i class="bi bi-globe2 text-success fs-2 mb-3"></i>
            <h5>For the Planet</h5>
            <p class="text-muted small">Every meal saved is a step toward reducing methane emissions and landfill waste.</p>
        </div>
    </div>
</div>
@endsection

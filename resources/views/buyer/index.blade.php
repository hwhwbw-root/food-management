@extends('layouts.app')

@section('title', 'Browse Food')

@section('content')
<h4 class="fw-bold mb-4">Available Food Listings</h4>

<form method="GET" class="row g-2 mb-4">
    <div class="col-md-5">
        <input type="text" name="search" class="form-control" placeholder="Search by title or location..."
               value="{{ request('search') }}">
    </div>
    <div class="col-md-4">
        <select name="category" class="form-select">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <button class="btn btn-primary w-100">Filter</button>
    </div>
    @if(request()->hasAny(['search','category']))
        <div class="col-md-1">
            <a href="{{ route('buyer.listings.index') }}" class="btn btn-outline-secondary w-100">Clear</a>
        </div>
    @endif
</form>

@if($listings->isEmpty())
    <div class="text-center text-muted py-5">
        <i class="bi bi-search fs-1 mb-3"></i>
        <p>No food listings available right now. Check back soon!</p>
    </div>
@else
    <div class="row g-4">
        @foreach($listings as $listing)
        <div class="col-md-4">
            <div class="card h-100">
                @if($listing->image)
                    <img src="{{ asset('storage/' . $listing->image) }}" class="card-img-top"
                         style="height:180px; object-fit:cover;" alt="{{ $listing->title }}">
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center" style="height:180px;">
                        <i class="bi bi-image text-muted" style="font-size:2.5rem;"></i>
                    </div>
                @endif
                <div class="card-body d-flex flex-column">
                    <h6 class="card-title fw-bold">{{ $listing->title }}</h6>
                    <p class="card-text text-muted small mb-1">
                        <i class="bi bi-geo-alt"></i> {{ $listing->pickup_location }}
                    </p>
                    <p class="card-text text-muted small mb-2">
                        <i class="bi bi-person"></i> {{ $listing->vendor->name }}
                        @if($listing->category)
                            &nbsp;·&nbsp;<i class="bi bi-tag"></i> {{ $listing->category->name }}
                        @endif
                    </p>
                    <div class="d-flex justify-content-between align-items-center mt-auto">
                        <span class="fw-bold text-success">
                            {{ $listing->price == 0 ? 'Free' : 'RM ' . number_format($listing->price, 2) }}
                        </span>
                        <span class="text-muted small">Qty: {{ $listing->quantity }}</span>
                    </div>
                    @if($listing->expiry_time)
                        <p class="text-danger small mt-1 mb-0">
                            <i class="bi bi-clock"></i> Expires: {{ $listing->expiry_time->format('d M, h:i A') }}
                        </p>
                    @endif
                    <a href="{{ route('buyer.listings.show', $listing->id) }}" class="btn btn-primary btn-sm mt-3">View & Reserve</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-4">{{ $listings->links() }}</div>
@endif
@endsection

@extends('layouts.app')

@section('title', 'Browse Food')

@section('content')
<div class="mb-4">
    <h1 class="page-heading">Browse Food</h1>
    <p class="page-subheading">Fresh surplus from local businesses — reserve before it's gone</p>
</div>

{{-- Filter bar --}}
<form method="GET" class="card p-3 mb-4" style="border-radius:14px;">
    <div class="row g-2 align-items-end">
        <div class="col-md-5">
            <label class="form-label">Search</label>
            <input type="text" name="search" class="form-control" placeholder="Food name or pickup location…"
                   value="{{ request('search') }}">
        </div>
        <div class="col-md-4">
            <label class="form-label">Category</label>
            <select name="category" class="form-select">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button class="btn btn-primary flex-grow-1">
                <i class="bi bi-search me-1"></i> Filter
            </button>
            @if(request()->hasAny(['search','category']))
                <a href="{{ route('buyer.listings.index') }}" class="btn btn-outline-secondary">Clear</a>
            @endif
        </div>
    </div>
</form>

@if($listings->isEmpty())
    <div class="card empty-state">
        <i class="bi bi-search"></i>
        <h5 style="color:var(--dark);font-family:'DM Serif Display',serif;">Nothing found</h5>
        <p style="font-size:.875rem;">No food listings match your search right now. Check back soon!</p>
        @if(request()->hasAny(['search','category']))
            <a href="{{ route('buyer.listings.index') }}" class="btn btn-outline-secondary mt-2">Clear filters</a>
        @endif
    </div>
@else
    <div class="row g-4">
        @foreach($listings as $listing)
        <div class="col-md-4 col-sm-6">
            <div class="card food-card h-100">
                {{-- Food image --}}
                @if($listing->image)
                    <img src="{{ asset('storage/' . $listing->image) }}" class="card-img-top"
                         alt="{{ $listing->title }}">
                @else
                    <div style="height:180px;background:var(--cream);display:flex;align-items:center;justify-content:center;border-bottom:1px solid var(--border);">
                        <i class="bi bi-image" style="font-size:2.5rem;color:var(--border);"></i>
                    </div>
                @endif

                <div class="card-body d-flex flex-column p-3">
                    {{-- Category tag --}}
                    @if($listing->category)
                        <div style="margin-bottom:.5rem;">
                            <span style="background:var(--cream);border:1px solid var(--border);border-radius:6px;padding:.18rem .55rem;font-size:.72rem;font-weight:600;color:var(--muted);">
                                {{ $listing->category->name }}
                            </span>
                        </div>
                    @endif

                    <h6 style="font-weight:700;font-size:.95rem;color:var(--dark);margin-bottom:.3rem;line-height:1.3;">
                        {{ $listing->title }}
                    </h6>

                    <div style="font-size:.8rem;color:var(--muted);margin-bottom:.25rem;">
                        <i class="bi bi-person me-1"></i>{{ $listing->vendor->name }}
                    </div>
                    <div style="font-size:.8rem;color:var(--muted);margin-bottom:.6rem;">
                        <i class="bi bi-geo-alt me-1"></i>{{ $listing->pickup_location }}
                    </div>

                    @if($listing->expiry_time)
                        <div style="font-size:.78rem;color:#B45309;background:#FEF3C7;border-radius:6px;padding:.2rem .5rem;display:inline-block;margin-bottom:.6rem;">
                            <i class="bi bi-clock me-1"></i>Expires {{ $listing->expiry_time->format('d M, h:i A') }}
                        </div>
                    @endif

                    <div class="d-flex justify-content-between align-items-center mt-auto pt-2" style="border-top:1px solid var(--border);">
                        <div>
                            @if($listing->price == 0)
                                <span class="price-tag free">Free</span>
                            @else
                                <span class="price-tag">RM {{ number_format($listing->price, 2) }}</span>
                            @endif
                            <div style="font-size:.72rem;color:var(--muted);">Qty: {{ $listing->quantity }}</div>
                        </div>
                        <a href="{{ route('buyer.listings.show', $listing->id) }}" class="btn btn-primary btn-sm">
                            Reserve <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-4">{{ $listings->links() }}</div>
@endif
@endsection

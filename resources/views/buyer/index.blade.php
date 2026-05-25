@extends('layouts.app')

@section('title', 'Browse Food')

@section('content')
<div class="mb-4">
    <h1 class="page-heading">Browse Food</h1>
    <p class="page-subheading">Fresh surplus from local businesses — reserve before it's gone</p>
</div>

{{-- Filter bar --}}
<form method="GET" class="card p-3 mb-5" style="border-radius:14px;">
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

    @php $first = true; @endphp

    {{-- Featured first listing (horizontal, full-width) --}}
    @foreach($listings as $listing)
        @if($first)
            @php $first = false; @endphp
            <div class="card food-card mb-4 p-0" style="overflow:hidden;">
                <div class="row g-0 align-items-stretch">
                    <div class="col-md-5">
                        @if($listing->image)
                            <img src="{{ asset('storage/' . $listing->image) }}" alt="{{ $listing->title }}"
                                 style="width:100%;height:100%;min-height:260px;object-fit:cover;display:block;">
                        @else
                            <div style="min-height:260px;background:var(--cream);display:flex;align-items:center;justify-content:center;height:100%;">
                                <i class="bi bi-image" style="font-size:3rem;color:var(--border);"></i>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-7 d-flex flex-column p-4 p-lg-5">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span style="background:var(--amber);color:var(--dark);font-size:.65rem;font-weight:800;letter-spacing:.1em;text-transform:uppercase;padding:.2rem .65rem;border-radius:4px;">Featured</span>
                            @if($listing->category)
                                <span style="background:var(--cream);border:1px solid var(--border);border-radius:6px;padding:.18rem .55rem;font-size:.72rem;font-weight:600;color:var(--muted);">
                                    {{ $listing->category->name }}
                                </span>
                            @endif
                        </div>

                        <h2 style="font-family:'DM Serif Display',serif;font-size:1.75rem;color:var(--dark);margin-bottom:.5rem;line-height:1.2;">
                            {{ $listing->title }}
                        </h2>

                        @if($listing->description)
                            <p style="color:var(--muted);font-size:.9rem;line-height:1.65;margin-bottom:.75rem;">
                                {{ Str::limit($listing->description, 120) }}
                            </p>
                        @endif

                        <div style="font-size:.85rem;color:var(--muted);margin-bottom:.35rem;">
                            <i class="bi bi-person me-1"></i>{{ $listing->vendor->name }}
                            &nbsp;&middot;&nbsp;<i class="bi bi-geo-alt me-1"></i>{{ $listing->pickup_location }}
                        </div>

                        @if($listing->expiry_time)
                            <div style="font-size:.78rem;color:var(--warning-text);background:var(--warning-bg);border-radius:6px;padding:.25rem .6rem;display:inline-block;margin-bottom:.75rem;width:fit-content;">
                                <i class="bi bi-clock me-1"></i>Expires {{ $listing->expiry_time->format('d M, h:i A') }}
                            </div>
                        @endif

                        <div class="d-flex justify-content-between align-items-center mt-auto pt-3" style="border-top:1px solid var(--border);">
                            <div>
                                @if($listing->price == 0)
                                    <span class="price-tag free" style="font-family:'DM Serif Display',serif;font-size:1.8rem;color:var(--amber);">Free</span>
                                @else
                                    <span class="price-tag" style="font-family:'DM Serif Display',serif;font-size:1.8rem;color:var(--forest);">RM {{ number_format($listing->price, 2) }}</span>
                                @endif
                                <div style="font-size:.75rem;color:var(--muted);">{{ $listing->quantity }} available</div>
                            </div>
                            <a href="{{ route('buyer.listings.show', $listing->id) }}" class="btn btn-primary" style="padding:.65rem 1.75rem;">
                                Reserve <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    {{-- Remaining listings — 2-col grid (not 3-col equal, taste-skill compliant) --}}
    <div class="row g-4">
        @php $isFirst = true; @endphp
        @foreach($listings as $listing)
            @if($isFirst)
                @php $isFirst = false; @endphp
                @continue
            @endif
            <div class="col-sm-6">
                <div class="card food-card h-100">
                    @if($listing->image)
                        <img src="{{ asset('storage/' . $listing->image) }}" class="card-img-top"
                             alt="{{ $listing->title }}" style="height:200px;object-fit:cover;">
                    @else
                        <div style="height:200px;background:var(--cream);display:flex;align-items:center;justify-content:center;border-bottom:1px solid var(--border);">
                            <i class="bi bi-image" style="font-size:2.5rem;color:var(--border);"></i>
                        </div>
                    @endif

                    <div class="card-body d-flex flex-column p-4">
                        @if($listing->category)
                            <div style="margin-bottom:.5rem;">
                                <span style="background:var(--cream);border:1px solid var(--border);border-radius:6px;padding:.18rem .55rem;font-size:.72rem;font-weight:600;color:var(--muted);">
                                    {{ $listing->category->name }}
                                </span>
                            </div>
                        @endif

                        <h6 style="font-weight:700;font-size:1rem;color:var(--dark);margin-bottom:.35rem;line-height:1.3;">
                            {{ $listing->title }}
                        </h6>

                        <div style="font-size:.82rem;color:var(--muted);margin-bottom:.2rem;">
                            <i class="bi bi-person me-1"></i>{{ $listing->vendor->name }}
                        </div>
                        <div style="font-size:.82rem;color:var(--muted);margin-bottom:.6rem;">
                            <i class="bi bi-geo-alt me-1"></i>{{ $listing->pickup_location }}
                        </div>

                        @if($listing->expiry_time)
                            <div style="font-size:.75rem;color:var(--warning-text);background:var(--warning-bg);border-radius:6px;padding:.2rem .5rem;display:inline-block;margin-bottom:.6rem;width:fit-content;">
                                <i class="bi bi-clock me-1"></i>Expires {{ $listing->expiry_time->format('d M, h:i A') }}
                            </div>
                        @endif

                        <div class="d-flex justify-content-between align-items-center mt-auto pt-3" style="border-top:1px solid var(--border);">
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

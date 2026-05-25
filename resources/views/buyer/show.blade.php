@extends('layouts.app')

@section('title', $listing->title)

@section('content')
<a href="{{ route('buyer.listings.index') }}" class="btn btn-outline-secondary btn-sm mb-4">
    <i class="bi bi-arrow-left me-1"></i> Back to Listings
</a>

<div class="row g-4">
    {{-- Image --}}
    <div class="col-md-5">
        @if($listing->image)
            <img src="{{ asset('storage/' . $listing->image) }}" alt="{{ $listing->title }}"
                 class="w-100" style="border-radius:14px;max-height:340px;object-fit:cover;border:1px solid var(--border);">
        @else
            <div style="border-radius:14px;border:1px solid var(--border);background:var(--cream);height:240px;display:flex;align-items:center;justify-content:center;">
                <i class="bi bi-image" style="font-size:3.5rem;color:var(--border);"></i>
            </div>
        @endif
    </div>

    {{-- Detail + Reserve --}}
    <div class="col-md-7">
        <div class="card p-4" style="border-radius:16px;">

            @if($listing->category)
                <div class="mb-2">
                    <span style="background:var(--cream);border:1px solid var(--border);border-radius:6px;padding:.2rem .65rem;font-size:.75rem;font-weight:600;color:var(--muted);">
                        {{ $listing->category->name }}
                    </span>
                </div>
            @endif

            <h1 class="page-heading mb-1" style="font-size:1.75rem;">{{ $listing->title }}</h1>

            @if($listing->description)
                <p style="color:var(--muted);font-size:.875rem;margin-top:.5rem;margin-bottom:1rem;">{{ $listing->description }}</p>
            @endif

            <hr class="amber-divider">

            <dl style="display:grid;grid-template-columns:auto 1fr;gap:.6rem 1.5rem;align-items:baseline;margin:0 0 1.25rem;">
                <dt style="font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:var(--muted);">Price</dt>
                <dd style="margin:0;">
                    @if($listing->price == 0)
                        <span style="font-family:'DM Serif Display',serif;font-size:1.6rem;color:var(--amber);">Free</span>
                    @else
                        <span style="font-family:'DM Serif Display',serif;font-size:1.6rem;color:var(--forest);">RM {{ number_format($listing->price, 2) }}</span>
                    @endif
                </dd>

                <dt style="font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:var(--muted);">Available</dt>
                <dd style="margin:0;font-weight:600;">{{ $listing->quantity }} unit{{ $listing->quantity != 1 ? 's' : '' }}</dd>

                <dt style="font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:var(--muted);">Vendor</dt>
                <dd style="margin:0;">{{ $listing->vendor->name }}</dd>

                <dt style="font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:var(--muted);">Pickup</dt>
                <dd style="margin:0;"><i class="bi bi-geo-alt me-1" style="color:var(--amber);"></i>{{ $listing->pickup_location }}</dd>

                @if($listing->expiry_time)
                <dt style="font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:var(--muted);">Expires</dt>
                <dd style="margin:0;color:var(--warning-text);font-weight:600;">
                    <i class="bi bi-clock me-1"></i>{{ $listing->expiry_time->format('d M Y, h:i A') }}
                </dd>
                @endif
            </dl>

            <form method="POST" action="{{ route('buyer.reserve', $listing->id) }}"
                  onsubmit="return confirm('Reserve {{ addslashes($listing->title) }}?')">
                @csrf
                <button type="submit" class="btn btn-primary w-100" style="padding:.8rem;font-size:1rem;">
                    <i class="bi bi-bookmark-check me-2"></i>Reserve Now
                </button>
            </form>

            <p style="font-size:.75rem;color:var(--muted);text-align:center;margin-top:.75rem;margin-bottom:0;">
                Reservation is free — no payment required upfront.
            </p>
        </div>
    </div>
</div>
@endsection

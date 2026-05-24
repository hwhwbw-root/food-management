@extends('layouts.app')

@section('title', $listing->title)

@section('content')
<a href="{{ route('buyer.listings.index') }}" class="btn btn-outline-secondary btn-sm mb-4">
    <i class="bi bi-arrow-left"></i> Back to Listings
</a>

<div class="row g-4">
    <div class="col-md-5">
        @if($listing->image)
            <img src="{{ asset('storage/' . $listing->image) }}" class="img-fluid rounded shadow-sm w-100"
                 style="max-height:320px; object-fit:cover;" alt="{{ $listing->title }}">
        @else
            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height:220px;">
                <i class="bi bi-image text-muted" style="font-size:3rem;"></i>
            </div>
        @endif
    </div>

    <div class="col-md-7">
        <div class="card p-4">
            <h4 class="fw-bold">{{ $listing->title }}</h4>
            <p class="text-muted">{{ $listing->description }}</p>

            <dl class="row">
                <dt class="col-sm-4">Vendor</dt>
                <dd class="col-sm-8">{{ $listing->vendor->name }}</dd>
                <dt class="col-sm-4">Category</dt>
                <dd class="col-sm-8">{{ $listing->category?->name ?? '—' }}</dd>
                <dt class="col-sm-4">Price</dt>
                <dd class="col-sm-8 fw-bold text-success">{{ $listing->price == 0 ? 'Free' : 'RM ' . number_format($listing->price, 2) }}</dd>
                <dt class="col-sm-4">Quantity</dt>
                <dd class="col-sm-8">{{ $listing->quantity }} available</dd>
                <dt class="col-sm-4">Pickup</dt>
                <dd class="col-sm-8">{{ $listing->pickup_location }}</dd>
                @if($listing->expiry_time)
                <dt class="col-sm-4">Expires</dt>
                <dd class="col-sm-8 text-danger">{{ $listing->expiry_time->format('d M Y, h:i A') }}</dd>
                @endif
            </dl>

            <form method="POST" action="{{ route('buyer.reserve', $listing->id) }}" class="mt-2">
                @csrf
                <button type="submit" class="btn btn-primary btn-lg w-100"
                        onclick="return confirm('Reserve this item?')">
                    <i class="bi bi-bookmark-check"></i> Reserve Now
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

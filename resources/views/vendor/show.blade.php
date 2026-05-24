@extends('layouts.app')

@section('title', $listing->title)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold mb-0">{{ $listing->title }}</h4>
    <div class="d-flex gap-2">
        <a href="{{ route('vendor.listings.edit', $listing) }}" class="btn btn-outline-secondary btn-sm">Edit</a>
        <a href="{{ route('vendor.listings.index') }}" class="btn btn-outline-primary btn-sm">Back</a>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-5">
        @if($listing->image)
            <img src="{{ asset('storage/' . $listing->image) }}" alt="{{ $listing->title }}"
                 class="img-fluid rounded shadow-sm w-100" style="max-height:300px; object-fit:cover;">
        @else
            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height:200px;">
                <i class="bi bi-image text-muted" style="font-size:3rem;"></i>
            </div>
        @endif
    </div>
    <div class="col-md-7">
        <div class="card p-4 h-100">
            <dl class="row mb-0">
                <dt class="col-sm-4">Status</dt>
                <dd class="col-sm-8">
                    <span class="badge bg-{{ $listing->status === 'available' ? 'success' : 'secondary' }}">{{ ucfirst($listing->status) }}</span>
                </dd>
                <dt class="col-sm-4">Category</dt>
                <dd class="col-sm-8">{{ $listing->category?->name ?? '—' }}</dd>
                <dt class="col-sm-4">Quantity</dt>
                <dd class="col-sm-8">{{ $listing->quantity }}</dd>
                <dt class="col-sm-4">Price</dt>
                <dd class="col-sm-8">{{ $listing->price == 0 ? 'Free' : 'RM ' . number_format($listing->price, 2) }}</dd>
                <dt class="col-sm-4">Pickup</dt>
                <dd class="col-sm-8">{{ $listing->pickup_location }}</dd>
                <dt class="col-sm-4">Expires</dt>
                <dd class="col-sm-8">{{ $listing->expiry_time?->format('d M Y, h:i A') ?? '—' }}</dd>
                <dt class="col-sm-4">Description</dt>
                <dd class="col-sm-8">{{ $listing->description ?? '—' }}</dd>
            </dl>
        </div>
    </div>
</div>

<div class="card mt-4 p-4">
    <h5 class="fw-bold mb-3">Reservations ({{ $listing->reservations->count() }})</h5>
    @if($listing->reservations->isEmpty())
        <p class="text-muted">No reservations yet.</p>
    @else
        <table class="table table-sm">
            <thead class="table-light">
                <tr><th>Buyer</th><th>Email</th><th>Status</th><th>Reserved At</th></tr>
            </thead>
            <tbody>
                @foreach($listing->reservations as $r)
                <tr>
                    <td>{{ $r->buyer->name }}</td>
                    <td>{{ $r->buyer->email }}</td>
                    <td><span class="badge bg-info">{{ ucfirst($r->status) }}</span></td>
                    <td>{{ $r->reserved_at->format('d M Y, h:i A') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

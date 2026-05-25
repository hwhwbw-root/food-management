@extends('layouts.app')

@section('title', $listing->title)

@section('content')
<div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-2">
    <div>
        <h1 class="page-heading">{{ $listing->title }}</h1>
        <p class="page-subheading">Listing detail &amp; reservation activity</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('vendor.listings.edit', $listing) }}" class="btn btn-outline-primary btn-sm">
            <i class="bi bi-pencil me-1"></i>Edit
        </a>
        <a href="{{ route('vendor.listings.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Back
        </a>
    </div>
</div>

<div class="row g-4 mb-4">
    {{-- Image --}}
    <div class="col-md-5">
        @if($listing->image)
            <img src="{{ asset('storage/' . $listing->image) }}" alt="{{ $listing->title }}"
                 class="w-100" style="border-radius:14px;max-height:300px;object-fit:cover;border:1px solid var(--border);">
        @else
            <div style="border-radius:14px;border:1px solid var(--border);background:var(--cream);height:220px;display:flex;align-items:center;justify-content:center;">
                <i class="bi bi-image" style="font-size:3rem;color:var(--border);"></i>
            </div>
        @endif
    </div>

    {{-- Details --}}
    <div class="col-md-7">
        <div class="card p-4 h-100">
            <div class="d-flex align-items-center gap-2 mb-3">
                <span class="status-badge badge-{{ $listing->status }}">{{ ucfirst($listing->status) }}</span>
                @if($listing->category)
                    <span style="background:var(--cream);border:1px solid var(--border);border-radius:6px;padding:.2rem .65rem;font-size:.75rem;font-weight:600;color:var(--muted);">
                        {{ $listing->category->name }}
                    </span>
                @endif
            </div>

            <dl style="display:grid;grid-template-columns:auto 1fr;gap:.5rem 1.25rem;align-items:baseline;margin:0;">
                <dt style="font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:var(--muted);">Price</dt>
                <dd style="margin:0;">
                    @if($listing->price == 0)
                        <span style="font-family:'Bricolage Grotesque',sans-serif;font-size:1.3rem;color:var(--amber);">Free</span>
                    @else
                        <span style="font-family:'Bricolage Grotesque',sans-serif;font-size:1.3rem;color:var(--forest);">RM {{ number_format($listing->price, 2) }}</span>
                    @endif
                </dd>

                <dt style="font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:var(--muted);">Quantity</dt>
                <dd style="margin:0;font-weight:600;">{{ $listing->quantity }}</dd>

                <dt style="font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:var(--muted);">Pickup</dt>
                <dd style="margin:0;"><i class="bi bi-geo-alt me-1" style="color:var(--amber);"></i>{{ $listing->pickup_location }}</dd>

                <dt style="font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:var(--muted);">Expires</dt>
                <dd style="margin:0;color:var(--muted);">{{ $listing->expiry_time?->format('d M Y, h:i A') ?? '—' }}</dd>

                @if($listing->description)
                <dt style="font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:var(--muted);">Notes</dt>
                <dd style="margin:0;font-size:.875rem;color:var(--muted);">{{ $listing->description }}</dd>
                @endif
            </dl>
        </div>
    </div>
</div>

{{-- Reservations --}}
<div class="d-flex align-items-center gap-2 mb-3">
    <h2 class="page-heading" style="font-size:1.3rem;">Reservations</h2>
    <span style="background:var(--cream);border:1px solid var(--border);border-radius:999px;padding:.15rem .65rem;font-size:.78rem;font-weight:700;color:var(--muted);">
        {{ $listing->reservations->count() }}
    </span>
</div>

@if($listing->reservations->isEmpty())
    <div class="card empty-state">
        <i class="bi bi-bookmark"></i>
        <h5 style="color:var(--dark);font-family:'Bricolage Grotesque',sans-serif;">No reservations yet</h5>
        <p style="font-size:.875rem;">Buyers will appear here once they reserve this listing.</p>
    </div>
@else
    <div class="fs-table table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>Buyer</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Reserved At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($listing->reservations as $r)
                <tr>
                    <td style="font-weight:600;">{{ $r->buyer->name }}</td>
                    <td style="color:var(--muted);">{{ $r->buyer->email }}</td>
                    <td><span class="status-badge badge-{{ $r->status }}">{{ ucfirst($r->status) }}</span></td>
                    <td style="color:var(--muted);font-size:.8rem;">{{ $r->reserved_at->format('d M Y, h:i A') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection

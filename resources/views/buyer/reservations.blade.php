@extends('layouts.app')

@section('title', 'My Reservations')

@section('content')
<div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-3">
    <div>
        <h1 class="page-heading">My Reservations</h1>
        <p class="page-subheading">Food you've reserved from local vendors</p>
    </div>
    <a href="{{ route('buyer.listings.index') }}" class="btn-amber" style="text-decoration:none;padding:.6rem 1.4rem;border-radius:10px;display:inline-flex;align-items:center;gap:.4rem;font-weight:700;">
        <i class="bi bi-search"></i> Browse More Food
    </a>
</div>

@if($reservations->isEmpty())
    <div class="card empty-state">
        <i class="bi bi-bookmark"></i>
        <h5 style="color:var(--dark);font-family:'Bricolage Grotesque',sans-serif;">No reservations yet</h5>
        <p style="font-size:.875rem;">Browse available food listings and reserve what you need.</p>
        <a href="{{ route('buyer.listings.index') }}" class="btn btn-primary mt-2">Browse Food</a>
    </div>
@else
    <div class="fs-table table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>Food Item</th>
                    <th>Vendor</th>
                    <th>Pickup Location</th>
                    <th>Reserved At</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $r)
                <tr>
                    <td style="font-weight:600;color:var(--dark);">{{ $r->listing->title }}</td>
                    <td style="color:var(--muted);">{{ $r->listing->vendor->name }}</td>
                    <td style="color:var(--muted);">
                        <i class="bi bi-geo-alt me-1" style="color:var(--amber);"></i>{{ $r->listing->pickup_location }}
                    </td>
                    <td style="font-size:.8rem;color:var(--muted);">{{ $r->reserved_at->format('d M Y, h:i A') }}</td>
                    <td>
                        <span class="status-badge badge-{{ $r->status }}">{{ ucfirst($r->status) }}</span>
                    </td>
                    <td>
                        @if(in_array($r->status, ['pending', 'confirmed']))
                            <form method="POST" action="{{ route('buyer.reservations.cancel', $r->id) }}" class="d-inline"
                                  onsubmit="return confirm('Cancel this reservation?')">
                                @csrf @method('PATCH')
                                <button class="btn btn-outline-danger btn-sm" style="font-size:.75rem;">Cancel</button>
                            </form>
                        @else
                            <span style="color:var(--border);font-size:.8rem;">—</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-3">{{ $reservations->links() }}</div>
@endif
@endsection

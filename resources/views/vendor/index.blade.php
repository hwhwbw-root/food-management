@extends('layouts.app')

@section('title', 'My Listings')

@section('content')
<div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-3">
    <div>
        <h1 class="page-heading">My Listings</h1>
        <p class="page-subheading">Manage your food surplus listings</p>
    </div>
    <a href="{{ route('vendor.listings.create') }}" class="btn-amber" style="text-decoration:none;padding:.6rem 1.4rem;border-radius:10px;display:inline-flex;align-items:center;gap:.4rem;font-weight:700;">
        <i class="bi bi-plus-lg"></i> Post New Listing
    </a>
</div>

@if($listings->isEmpty())
    <div class="card empty-state">
        <i class="bi bi-inbox"></i>
        <h5 style="color:var(--dark);font-family:'Bricolage Grotesque',sans-serif;">Nothing posted yet</h5>
        <p style="font-size:.875rem;">Start reducing waste by posting your first food listing.</p>
        <a href="{{ route('vendor.listings.create') }}" class="btn btn-primary mt-2" style="display:inline-block;">Post your first listing</a>
    </div>
@else
    <div class="fs-table table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>Food Item</th>
                    <th>Category</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Expires</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($listings as $listing)
                <tr>
                    <td>
                        <div style="font-weight:600;color:var(--dark);">{{ $listing->title }}</div>
                        @if($listing->description)
                            <div style="font-size:.78rem;color:var(--muted);margin-top:.15rem;">{{ Str::limit($listing->description, 50) }}</div>
                        @endif
                    </td>
                    <td>
                        @if($listing->category)
                            <span style="background:var(--cream);border:1px solid var(--border);border-radius:6px;padding:.25rem .6rem;font-size:.75rem;font-weight:600;color:var(--muted);">
                                {{ $listing->category->name }}
                            </span>
                        @else
                            <span style="color:var(--border);">—</span>
                        @endif
                    </td>
                    <td style="font-weight:600;">{{ $listing->quantity }}</td>
                    <td>
                        @if($listing->price == 0)
                            <span style="color:var(--amber);font-weight:800;font-family:'Bricolage Grotesque',sans-serif;font-size:1rem;">Free</span>
                        @else
                            <span style="font-weight:700;color:var(--forest);">RM {{ number_format($listing->price, 2) }}</span>
                        @endif
                    </td>
                    <td>
                        <span class="status-badge badge-{{ $listing->status }}">{{ ucfirst($listing->status) }}</span>
                    </td>
                    <td style="font-size:.8rem;color:var(--muted);">
                        {{ $listing->expiry_time?->format('d M, h:i A') ?? '—' }}
                    </td>
                    <td>
                        <div class="d-flex gap-1 flex-wrap">
                            <a href="{{ route('vendor.listings.show', $listing) }}" class="btn btn-outline-secondary btn-sm" style="font-size:.75rem;">View</a>
                            <a href="{{ route('vendor.listings.edit', $listing) }}" class="btn btn-outline-primary btn-sm" style="font-size:.75rem;">Edit</a>
                            <form method="POST" action="{{ route('vendor.listings.destroy', $listing) }}" class="d-inline"
                                  onsubmit="return confirm('Delete this listing?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm" style="font-size:.75rem;">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-3">{{ $listings->links() }}</div>
@endif
@endsection

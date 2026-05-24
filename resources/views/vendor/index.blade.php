@extends('layouts.app')

@section('title', 'My Listings')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">My Food Listings</h4>
    <a href="{{ route('vendor.listings.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Post New Listing
    </a>
</div>

@if($listings->isEmpty())
    <div class="card p-5 text-center text-muted">
        <i class="bi bi-inbox fs-1 mb-3"></i>
        <p>You haven't posted any listings yet.</p>
        <a href="{{ route('vendor.listings.create') }}" class="btn btn-primary">Post your first listing</a>
    </div>
@else
    <div class="table-responsive">
        <table class="table table-hover bg-white rounded shadow-sm">
            <thead class="table-light">
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Qty</th>
                    <th>Price (RM)</th>
                    <th>Status</th>
                    <th>Expires</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($listings as $listing)
                <tr>
                    <td>{{ $listing->title }}</td>
                    <td>{{ $listing->category?->name ?? '—' }}</td>
                    <td>{{ $listing->quantity }}</td>
                    <td>{{ $listing->price == 0 ? 'Free' : number_format($listing->price, 2) }}</td>
                    <td>
                        <span class="badge bg-{{ $listing->status === 'available' ? 'success' : ($listing->status === 'reserved' ? 'warning' : 'secondary') }}">
                            {{ ucfirst($listing->status) }}
                        </span>
                    </td>
                    <td>{{ $listing->expiry_time?->format('d M Y, h:i A') ?? '—' }}</td>
                    <td>
                        <a href="{{ route('vendor.listings.show', $listing) }}" class="btn btn-sm btn-outline-info">View</a>
                        <a href="{{ route('vendor.listings.edit', $listing) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                        <form method="POST" action="{{ route('vendor.listings.destroy', $listing) }}" class="d-inline"
                              onsubmit="return confirm('Delete this listing?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $listings->links() }}
@endif
@endsection

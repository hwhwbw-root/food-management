@extends('layouts.app')

@section('title', 'Manage Listings')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Manage Food Listings</h4>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm">Back</a>
</div>

<div class="table-responsive">
    <table class="table table-hover bg-white rounded shadow-sm">
        <thead class="table-light">
            <tr><th>#</th><th>Title</th><th>Vendor</th><th>Category</th><th>Status</th><th>Posted</th><th>Action</th></tr>
        </thead>
        <tbody>
            @foreach($listings as $listing)
            <tr>
                <td>{{ $listing->id }}</td>
                <td>{{ $listing->title }}</td>
                <td>{{ $listing->vendor->name }}</td>
                <td>{{ $listing->category?->name ?? '—' }}</td>
                <td><span class="badge bg-{{ $listing->status === 'available' ? 'success' : 'secondary' }}">{{ ucfirst($listing->status) }}</span></td>
                <td>{{ $listing->created_at->format('d M Y') }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.listings.destroy', $listing->id) }}" class="d-inline"
                          onsubmit="return confirm('Remove this listing?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">Remove</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $listings->links() }}
@endsection

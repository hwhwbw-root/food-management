@extends('layouts.app')

@section('title', 'Manage Listings')

@section('content')
<div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-2">
    <div>
        <h1 class="page-heading">Manage Listings</h1>
        <p class="page-subheading">All food listings posted on the platform</p>
    </div>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm align-self-start">
        <i class="bi bi-arrow-left me-1"></i> Dashboard
    </a>
</div>

<div class="fs-table table-responsive">
    <table class="table mb-0">
        <thead>
            <tr>
                <th>#</th>
                <th>Food Item</th>
                <th>Vendor</th>
                <th>Category</th>
                <th>Price</th>
                <th>Status</th>
                <th>Posted</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($listings as $listing)
            <tr>
                <td style="color:var(--border);font-size:.8rem;">{{ $listing->id }}</td>
                <td style="font-weight:600;color:var(--dark);">{{ $listing->title }}</td>
                <td style="color:var(--muted);">{{ $listing->vendor->name }}</td>
                <td>
                    @if($listing->category)
                        <span style="background:var(--cream);border:1px solid var(--border);border-radius:6px;padding:.2rem .55rem;font-size:.72rem;font-weight:600;color:var(--muted);">
                            {{ $listing->category->name }}
                        </span>
                    @else
                        <span style="color:var(--border);">—</span>
                    @endif
                </td>
                <td>
                    @if($listing->price == 0)
                        <span style="color:var(--amber);font-weight:800;font-family:'Bricolage Grotesque',sans-serif;">Free</span>
                    @else
                        <span style="font-weight:700;color:var(--forest);">RM {{ number_format($listing->price, 2) }}</span>
                    @endif
                </td>
                <td>
                    <span class="status-badge badge-{{ $listing->status }}">{{ ucfirst($listing->status) }}</span>
                </td>
                <td style="font-size:.8rem;color:var(--muted);">{{ $listing->created_at->format('d M Y') }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.listings.destroy', $listing->id) }}" class="d-inline"
                          onsubmit="return confirm('Permanently remove this listing?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-outline-danger btn-sm" style="font-size:.75rem;">Remove</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-3">{{ $listings->links() }}</div>
@endsection

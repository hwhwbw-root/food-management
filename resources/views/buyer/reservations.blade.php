@extends('layouts.app')

@section('title', 'My Reservations')

@section('content')
<h4 class="fw-bold mb-4">My Reservations</h4>

@if($reservations->isEmpty())
    <div class="card p-5 text-center text-muted">
        <i class="bi bi-bookmark fs-1 mb-3"></i>
        <p>You haven't reserved anything yet.</p>
        <a href="{{ route('buyer.listings.index') }}" class="btn btn-primary">Browse Food</a>
    </div>
@else
    <div class="table-responsive">
        <table class="table table-hover bg-white rounded shadow-sm">
            <thead class="table-light">
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
                    <td>{{ $r->listing->title }}</td>
                    <td>{{ $r->listing->vendor->name }}</td>
                    <td>{{ $r->listing->pickup_location }}</td>
                    <td>{{ $r->reserved_at->format('d M Y, h:i A') }}</td>
                    <td>
                        <span class="badge bg-{{ $r->status === 'pending' ? 'warning' : ($r->status === 'confirmed' ? 'success' : 'secondary') }}">
                            {{ ucfirst($r->status) }}
                        </span>
                    </td>
                    <td>
                        @if(in_array($r->status, ['pending', 'confirmed']))
                            <form method="POST" action="{{ route('buyer.reservations.cancel', $r->id) }}" class="d-inline"
                                  onsubmit="return confirm('Cancel this reservation?')">
                                @csrf @method('PATCH')
                                <button class="btn btn-sm btn-outline-danger">Cancel</button>
                            </form>
                        @else
                            <span class="text-muted small">—</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $reservations->links() }}
@endif
@endsection

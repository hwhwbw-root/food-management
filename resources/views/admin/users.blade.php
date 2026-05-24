@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Manage Users</h4>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm">Back</a>
</div>

<div class="table-responsive">
    <table class="table table-hover bg-white rounded shadow-sm">
        <thead class="table-light">
            <tr><th>#</th><th>Name</th><th>Email</th><th>Role</th><th>Phone</th><th>Joined</th><th>Action</th></tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td><span class="badge bg-{{ $user->role === 'admin' ? 'danger' : ($user->role === 'vendor' ? 'success' : 'info') }}">{{ ucfirst($user->role) }}</span></td>
                <td>{{ $user->phone ?? '—' }}</td>
                <td>{{ $user->created_at->format('d M Y') }}</td>
                <td>
                    @if($user->role !== 'admin')
                        <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" class="d-inline"
                              onsubmit="return confirm('Remove this user and all their data?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Remove</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $users->links() }}
@endsection

@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
<div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-2">
    <div>
        <h1 class="page-heading">Manage Users</h1>
        <p class="page-subheading">All registered accounts on the platform</p>
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
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Phone</th>
                <th>Joined</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td style="color:var(--border);font-size:.8rem;">{{ $user->id }}</td>
                <td style="font-weight:600;color:var(--dark);">
                    <span style="width:28px;height:28px;border-radius:50%;background:var(--cream);border:1px solid var(--border);display:inline-flex;align-items:center;justify-content:center;font-size:.7rem;font-weight:700;margin-right:.5rem;color:var(--forest);">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </span>
                    {{ $user->name }}
                </td>
                <td style="color:var(--muted);">{{ $user->email }}</td>
                <td>
                    <span class="status-badge badge-{{ $user->role }}">{{ ucfirst($user->role) }}</span>
                </td>
                <td style="color:var(--muted);">{{ $user->phone ?? '—' }}</td>
                <td style="font-size:.8rem;color:var(--muted);">{{ $user->created_at->format('d M Y') }}</td>
                <td>
                    @if($user->role !== 'admin')
                        <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" class="d-inline"
                              onsubmit="return confirm('Remove {{ addslashes($user->name) }} and all their data?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm" style="font-size:.75rem;">Remove</button>
                        </form>
                    @else
                        <span style="color:var(--border);font-size:.8rem;">Protected</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-3">{{ $users->links() }}</div>
@endsection

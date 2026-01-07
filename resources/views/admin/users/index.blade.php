@extends('layouts.admin')

@section('title', 'Users List')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4>Users</h4>
    <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-primary">Create New User</a>
</div>

<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <form method="GET" action="{{ route('admin.users.index') }}" class="d-flex" role="search">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm me-2" placeholder="Search users...">
            <button type="submit" class="btn btn-sm btn-primary">Search</button>
        </form>
    </div>
    <div class="card-body p-0">
        @if($users->count())
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $index => $user)
                        <tr>
                            <td>{{ $users->firstItem() + $index }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td><span class="badge bg-primary">{{ $user->getRoleNames()->first() ?? 'N/A' }}</span></td>
                            <td>{{ $user->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-secondary">Edit</a>

                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirmDelete(this);">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="p-3">
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
        @else
            <div class="p-3 text-center text-muted">
                No users found.
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
function confirmDelete(form) {
    return confirm('Are you sure you want to delete this user? This action cannot be undone.');
}
</script>
@endpush

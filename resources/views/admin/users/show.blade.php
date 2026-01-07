@extends('layouts.admin')

@section('title', 'User Details')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-secondary">
        ← Back to Users
    </a>
</div>

<div class="row">
    {{-- User Info --}}
    <div class="col-md-4">
        <div class="card shadow-sm mb-4">
            <div class="card-header">
                <strong>User Information</strong>
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p>
                    <strong>Role:</strong>
                    <span class="badge bg-primary">
                        {{ $user->getRoleNames()->first() ?? 'N/A' }}
                    </span>
                </p>
                <p><strong>Joined:</strong> {{ $user->created_at->format('d M Y') }}</p>
            </div>
        </div>
    </div>

    {{-- User Activity --}}
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header">
                <strong>User Activity Log</strong>
            </div>

            <div class="card-body p-0">
                @if($activities->count())
                    <div class="table-responsive">
                        <table class="table table-sm table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Action</th>
                                    <th>URL</th>
                                    <th>Method</th>
                                    <th>IP</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($activities as $index => $activity)
                                    <tr>
                                        <td>{{ $activities->firstItem() + $index }}</td>
                                        <td>{{ $activity->action }}</td>
                                        <td class="text-truncate" style="max-width: 200px;">
                                            {{ $activity->url }}
                                        </td>
                                        <td>
                                            <span class="badge bg-info">
                                                {{ $activity->method }}
                                            </span>
                                        </td>
                                        <td>{{ $activity->ip }}</td>
                                        <td>{{ $activity->created_at->format('d M Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="p-3">
                        {{ $activities->links('pagination::bootstrap-5') }}
                    </div>
                @else
                    <div class="p-3 text-center text-muted">
                        No activity found for this user.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

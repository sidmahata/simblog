@extends('layouts.admin')

@section('title', 'Posts List')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4>Posts</h4>
    <a href="{{ route('admin.posts.create') }}" class="btn btn-sm btn-primary">Create New Post</a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        @if($posts->count())
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $index => $post)
                        <tr>
                            <td>{{ $posts->firstItem() + $index }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->author->name }}</td>
                            <td>{{ $post->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('admin.posts.show', $post) }}" class="btn btn-sm btn-outline-info">View</a>
                                <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-outline-secondary">Edit</a>

                                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="d-inline" onsubmit="return confirmDelete(this);">
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
                {{ $posts->links('pagination::bootstrap-5') }}
            </div>
        @else
            <div class="p-3 text-center text-muted">
                No posts found.
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
function confirmDelete(form) {
    return confirm('Are you sure you want to delete this post?');
}
</script>
@endpush

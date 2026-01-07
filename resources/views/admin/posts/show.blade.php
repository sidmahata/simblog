@extends('layouts.admin')

@section('title', 'Post Details')

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Post Details</h5>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-sm btn-secondary">Back to Posts</a>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <strong>Title:</strong>
            <p>{{ $post->title }}</p>
        </div>

        <div class="mb-3">
            <strong>Content:</strong>
            <p>{!! nl2br(e($post->content)) !!}</p>
        </div>

        <div class="mb-3">
            <strong>Author:</strong>
            <p>{{ $post->author->name }} ({{ $post->author->email }})</p>
        </div>

        <div class="mb-3">
            <strong>Created At:</strong>
            <p>{{ $post->created_at->format('d M Y H:i') }}</p>
        </div>

        <div class="mb-3">
            <strong>Updated At:</strong>
            <p>{{ $post->updated_at->format('d M Y H:i') }}</p>
        </div>

        @if($post->deleted_at)
        <div class="mb-3 text-danger">
            <strong>Deleted At:</strong>
            <p>{{ $post->deleted_at->format('d M Y H:i') }}</p>
        </div>
        @endif

        <div class="mt-3">
            <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-primary">Edit Post</a>
            <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="d-inline" onsubmit="return confirmDelete(this);">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-danger">Delete Post</button>
            </form>
        </div>
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

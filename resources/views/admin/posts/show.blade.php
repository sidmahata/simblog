@extends('layouts.admin')

@section('title', 'Post Details')

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Post Details</h5>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-sm btn-secondary">Back to Posts</a>
    </div>
    <div class="card-body">
        {{-- Post Details --}}
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

        {{-- Post Actions --}}
        <div class="mb-3 mt-3">
            <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-primary">Edit Post</a>
            <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="d-inline" onsubmit="return confirmDelete(this);">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-danger">Delete Post</button>
            </form>
        </div>

        <hr>

        {{-- Comments Section --}}
        <hr>
        <h5>Comments ({{ $post->comments->count() }})</h5>

        <div class="list-group">
        @foreach($post->comments as $comment)
            <div class="list-group-item">

                <div class="d-flex justify-content-between">
                    <div>
                        <strong>{{ $comment->author->name }}</strong>
                        <small class="text-muted">
                            • {{ $comment->created_at->format('d M Y H:i') }}
                        </small>
                    </div>

                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-outline-secondary"
                                data-bs-toggle="modal"
                                data-bs-target="#editCommentModal{{ $comment->id }}">
                            Edit
                        </button>

                        <form action="{{ route('admin.comments.destroy', $comment) }}"
                            method="POST"
                            onsubmit="return confirm('Delete this comment?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger">Delete</button>
                        </form>
                    </div>
                </div>

                <p class="mt-2 mb-0">
                    {!! nl2br(e($comment->content)) !!}
                </p>
            </div>

            {{-- 🔸 Edit Comment Modal --}}
            <div class="modal fade" id="editCommentModal{{ $comment->id }}" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <form method="POST" action="{{ route('admin.comments.update', $comment) }}">
                        @csrf
                        @method('PUT')

                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Comment</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Author</label>
                                    <select name="user_id" class="form-select">
                                        @foreach(\App\Models\User::all() as $user)
                                            <option value="{{ $user->id }}"
                                                @selected($comment->user_id === $user->id)>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Comment</label>
                                    <textarea name="content" class="form-control" rows="4" required>{{ $comment->content }}</textarea>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary">Update Comment</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
        </div>


        {{-- Optional: Add new comment form --}}
        <hr>
        <h5>Add Comment</h5>

        <form action="{{ route('admin.posts.comments.store', $post) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Author</label>
                <select name="user_id" class="form-select" required>
                    @foreach(\App\Models\User::all() as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Comment</label>
                <textarea name="content" class="form-control" rows="3" required></textarea>
            </div>

            <button class="btn btn-primary">Add Comment</button>
        </form>


    </div>
</div>
@endsection

@push('scripts')
<script>
function confirmDelete(form){
    return confirm('Are you sure you want to delete this item?');
}
</script>
@endpush

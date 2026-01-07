@extends('layouts.frontend')

@section('title', $post->title)

@section('content')
<article>
    <h2>{{ $post->title }}</h2>

    <p class="text-muted">
        By {{ $post->author->name }}
        • {{ $post->created_at->format('d M Y') }}
    </p>

    <hr>

    <div class="mb-5">
        {!! $post->content !!}
    </div>

    {{-- Edit/Delete Buttons --}}
    <div class="mb-4">
        @can('update', $post)
            <!-- Edit Button triggers modal -->
            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editPostModal">
                Edit
            </button>
        @endcan

        @can('delete', $post)
            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this post?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-outline-danger" type="submit">
                    Delete
                </button>
            </form>
        @endcan
    </div>
</article>

{{-- Edit Modal --}}
@can('update', $post)
<div class="modal fade" id="editPostModal" tabindex="-1" aria-labelledby="editPostModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('posts.update', $post) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editPostModalLabel">Edit Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="content" name="content" rows="10" required>{{ $post->content }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Post</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endcan

<hr>

<h4>Comments ({{ $post->comments->count() }})</h4>

<hr>

<h4>Comments</h4>

@auth
<form method="POST" action="{{ route('posts.comments.store', $post) }}">
    @csrf
    <div class="mb-3">
        <textarea name="content" class="form-control" rows="3"
                  placeholder="Write a comment..." required></textarea>
    </div>
    <button class="btn btn-sm btn-primary">Submit Comment</button>
</form>
@else
<p class="text-muted">
    <a href="{{ route('login') }}">Login</a> to post a comment.
</p>
@endauth


@forelse($post->comments as $comment)
    <div class="mb-3">
        <strong>{{ $comment->author->name }}</strong>
        <small class="text-muted">
            • {{ $comment->created_at->diffForHumans() }}
        </small>
        @can('update', $comment)
            <button class="btn btn-sm btn-link"
                    data-bs-toggle="modal"
                    data-bs-target="#editCommentModal{{ $comment->id }}">
                Edit
            </button>
        @endcan
        @can('delete', $comment)
            <form method="POST"
                  action="{{ route('comments.destroy', $comment) }}"
                  class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-link text-danger"
                        onclick="return confirm('Are you sure you want to delete this comment?')">
                    Delete
                </button>
            </form>
        @endcan
        <p class="mb-0">{{ $comment->content }}</p>
        {{-- Edit Comment Modal --}}
        @can('update', $comment)
        <div class="modal fade" id="editCommentModal{{ $comment->id }}" tabindex="-1">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('comments.update', $comment) }}">
                    @csrf
                    @method('PUT')

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Comment</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <textarea name="content"
                                        class="form-control"
                                        rows="4"
                                        required>{{ $comment->content }}</textarea>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button class="btn btn-primary">
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endcan
    </div>
@empty
    <p class="text-muted">No comments yet.</p>
@endforelse



@endsection

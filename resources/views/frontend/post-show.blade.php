@extends('layouts.frontend')

@section('title', $post->title)

@section('content')
<article>
    <h1>{{ $post->title }}</h1>

    <p class="text-muted">
        By {{ $post->author->name }}
        • {{ $post->created_at->format('d M Y') }}
    </p>

    <hr>

    <div class="mb-5">
        {!! $post->content !!}
    </div>
</article>

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
        <p class="mb-0">{{ $comment->content }}</p>
    </div>
@empty
    <p class="text-muted">No comments yet.</p>
@endforelse
@endsection

@extends('layouts.frontend')

@section('title', 'Home')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Latest Posts</h2>
    <a href="{{ route('posts.create') }}" class="btn btn-primary">
        Add New Post
    </a>
</div>

@foreach($posts as $post)
    <div class="mb-4 pb-4 border-bottom">
        <h4>
            <a href="{{ route('posts.show', $post) }}" class="text-decoration-none">
                {{ $post->title }}
            </a>
        </h4>

        <p class="text-muted mb-2">
            By {{ $post->author->name }}
            • {{ $post->created_at->format('d M Y') }}
        </p>

        <p>
            {{ Str::limit(strip_tags($post->content), 200) }}
        </p>

        <a href="{{ route('posts.show', $post) }}" class="btn btn-sm btn-outline-primary">
            Read more →
        </a>
    </div>
@endforeach

{{ $posts->links('pagination::bootstrap-5') }}
@endsection

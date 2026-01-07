@extends('layouts.frontend')

@section('title', 'Create Post')

@section('content')
<h3>Create New Post</h3>

<form method="POST" action="{{ route('posts.store') }}">
    @csrf

    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Content</label>
        <textarea name="content" class="form-control" rows="6" required></textarea>
    </div>

    <button class="btn btn-primary">Publish</button>
</form>
@endsection

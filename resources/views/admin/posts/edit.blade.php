@extends('layouts.admin')

@section('title', 'Edit Post')

@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <h5>Edit Post: {{ $post->title }}</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.posts.update', $post) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea name="content" class="form-control" rows="6" required>{{ old('content', $post->content) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Author</label>
                <select name="user_id" class="form-select" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $post->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Post</button>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection

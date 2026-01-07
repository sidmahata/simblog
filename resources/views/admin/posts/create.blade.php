@extends('layouts.admin')

@section('title', 'Create Post')

@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <h5>Create New Post</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.posts.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea name="content" class="form-control" rows="6" required>{{ old('content') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Author</label>
                <select name="user_id" class="form-select" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create Post</button>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection

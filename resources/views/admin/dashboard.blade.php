@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="row g-4">

    {{-- Users --}}
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h1 class="display-6">{{ $usersCount }}</h1>
                <p class="text-muted mb-0">Total Users</p>
            </div>
        </div>
    </div>

    {{-- Posts --}}
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h1 class="display-6">{{ $postsCount }}</h1>
                <p class="text-muted mb-0">Total Posts</p>
            </div>
        </div>
    </div>

    {{-- Comments --}}
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h1 class="display-6">{{ $commentsCount }}</h1>
                <p class="text-muted mb-0">Total Comments</p>
            </div>
        </div>
    </div>

</div>
@endsection

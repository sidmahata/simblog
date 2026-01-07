@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">

        <div class="card shadow-sm">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="mb-0">
                        Welcome, {{ auth()->user()->name }} 👋
                    </h3>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            Logout
                        </button>
                    </form>
                </div>

                <p class="text-muted">
                    You are logged in successfully.
                </p>

                <hr>

                <p>
                    <strong>Email:</strong> {{ auth()->user()->email }}
                </p>

                <p>
                    <strong>Role:</strong>
                    <span class="badge bg-primary">
                        {{ auth()->user()->getRoleNames()->first() ?? 'N/A' }}
                    </span>
                </p>

            </div>
        </div>

    </div>
</div>
@endsection

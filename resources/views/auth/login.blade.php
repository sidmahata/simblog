@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">

                <h4 class="text-center mb-4">Login</h4>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            placeholder="Enter email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="Password"
                            required
                        >
                    </div>

                    <div class="mb-3 form-check">
                        <input
                            type="checkbox"
                            name="remember"
                            class="form-check-input"
                            id="remember"
                        >
                        <label class="form-check-label" for="remember">
                            Remember me
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Login
                    </button>
                </form>

                <hr>

                <div class="d-grid gap-2">
                    <a href="{{ url('/auth/google') }}" class="btn btn-outline-danger">
                        Continue with Google
                    </a>

                    <a href="{{ url('/auth/facebook') }}" class="btn btn-outline-primary">
                        Continue with Facebook
                    </a>
                </div>


                <div class="mt-3 text-center">
                    <a href="{{ route('password.request') }}">
                        Forgot your password?
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection

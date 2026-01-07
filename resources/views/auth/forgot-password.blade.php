@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">

                <h4 class="text-center mb-3">Forgot your password?</h4>

                <p class="text-muted text-center mb-4">
                    Enter your email address and we’ll send you a password reset link.
                </p>

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            placeholder="Enter your email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                        >
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Send Password Reset Link
                    </button>
                </form>

                <div class="mt-3 text-center">
                    <a href="{{ route('login') }}">Back to login</a>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection

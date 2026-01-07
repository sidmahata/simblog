@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">

                <h4 class="text-center mb-3">Reset your password</h4>

                <p class="text-muted text-center mb-4">
                    Enter your new password below.
                </p>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <!-- Include the reset token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            placeholder="Enter your email"
                            value="{{ old('email', $request->email) }}"
                            required
                            autofocus
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="Enter new password"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input
                            type="password"
                            name="password_confirmation"
                            class="form-control"
                            placeholder="Confirm new password"
                            required
                        >
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Reset Password
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

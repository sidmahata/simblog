<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', config('app.name'))</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-light bg-white border-bottom mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            {{ config('app.name') }}
        </a>

        <div class="d-flex align-items-center ms-auto gap-2">

        @if (Auth::check())
            <span class="navbar-text me-2">
                Hello, {{ Auth::user()->name }}!
            </span>

            <form method="POST" action="{{ route('logout') }}" class="mb-0">
                @csrf
                <button class="btn btn-outline-danger btn-sm" type="submit">
                    Logout
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">
                Login
            </a>

            <a href="{{ route('admin.login') }}" class="btn btn-outline-secondary btn-sm">
                Admin Login
            </a>
        @endif

    </div>

        
    </div>
</nav>

<main class="container">
    @yield('content')
</main>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>

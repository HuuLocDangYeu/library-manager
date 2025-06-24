<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body { background: #f8fafc; }
        .navbar-brand i { color: #0d6efd; margin-right: 6px; }
        .navbar-nav .nav-link.active, .navbar-nav .nav-link:hover { color: #0d6efd !important; }
        .card { box-shadow: 0 2px 12px rgba(0,0,0,0.05); }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('home') }}">
                <i class="bi bi-journal-bookmark-fill"></i> Thư viện
            </a>
            <div class="navbar-nav ms-auto">
                @auth
                    <span class="nav-link text-white">
                        <i class="bi bi-person-circle"></i>
                        {{ auth()->user()->name }} ({{ auth()->user()->role }})
                    </span>
                    <a class="nav-link text-white" href="{{ route('books.index') }}">
                        <i class="bi bi-book"></i> Danh sách sách
                    </a>
                    @if (auth()->user()->isAdmin())
                        <a class="nav-link text-white" href="{{ route('books.create') }}">
                            <i class="bi bi-plus-circle"></i> Thêm sách
                        </a>
                        <a class="nav-link text-white" href="{{ route('borrow-logs.index') }}">
                            <i class="bi bi-clock-history"></i> Quản lý mượn/trả
                        </a>
                    @else
                        <a class="nav-link text-white" href="{{ route('borrow-logs.create') }}">
                            <i class="bi bi-journal-arrow-up"></i> Mượn sách
                        </a>
                    @endif
                    <a class="nav-link text-white" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right"></i> Đăng xuất
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a class="nav-link text-white" href="{{ route('login') }}">
                        <i class="bi bi-box-arrow-in-right"></i> Đăng nhập
                    </a>
                    <a class="nav-link text-white" href="{{ route('register') }}">
                        <i class="bi bi-person-plus"></i> Đăng ký
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
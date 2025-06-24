<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(120deg, #fafdff 0%, #e3f0ff 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
        }
        .navbar {
            background: #2563eb !important;
            box-shadow: 0 2px 12px rgba(37,99,235,0.07);
        }
        .navbar-brand i {
            color: #ffe066;
            margin-right: 8px;
        }
        .navbar-brand, .navbar-nav .nav-link {
            color: #fff !important;
            font-weight: 700;
            letter-spacing: 0.5px;
            font-size: 1.1rem;
            transition: color 0.2s;
        }
        .navbar-nav .nav-link.active, .navbar-nav .nav-link:hover {
            color: #ffe066 !important;
            background: rgba(255,255,255,0.10);
            border-radius: 8px;
        }
        .card {
            box-shadow: 0 4px 24px rgba(37,99,235,0.10);
            border-radius: 18px;
            border: 1.5px solid #e3f0ff;
            background: #fff;
            transition: box-shadow 0.2s, transform 0.2s;
        }
        .card:hover {
            box-shadow: 0 8px 32px rgba(37,99,235,0.18);
            transform: translateY(-2px) scale(1.01);
        }
        .table thead {
            background: #e3f0ff;
        }
        .table-striped > tbody > tr:nth-of-type(odd) {
            background: #fafdff;
        }
        .btn-primary, .btn-outline-primary:hover {
            background: #2563eb !important;
            border-color: #2563eb !important;
            box-shadow: 0 2px 8px rgba(37,99,235,0.10);
        }
        .btn-outline-primary {
            color: #2563eb !important;
            border-color: #2563eb !important;
            background: #fff !important;
        }
        .btn-warning {
            background: #ffe066 !important;
            border-color: #ffe066 !important;
            color: #333 !important;
        }
        .badge.bg-success {
            background: #51cf66 !important;
            color: #fff;
        }
        .badge.bg-info, .badge.bg-info.text-dark {
            background: #e3f0ff !important;
            color: #2563eb !important;
        }
        .alert-success {
            background: #e3fbe3;
            color: #218838;
            border-left: 5px solid #51cf66;
        }
        .alert-danger {
            background: #fffbe6;
            color: #d9480f;
            border-left: 5px solid #ffe066;
        }
        /* Scrollbar đẹp */
        ::-webkit-scrollbar {
            width: 8px;
            background: #e3f0ff;
        }
        ::-webkit-scrollbar-thumb {
            background: #b6d4fe;
            border-radius: 8px;
        }
        /* Hiệu ứng cho link */
        a {
            transition: color 0.2s, text-decoration 0.2s;
        }
        a:hover {
            color: #2563eb;
            text-decoration: underline;
        }
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
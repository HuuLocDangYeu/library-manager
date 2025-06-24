<!DOCTYPE html>
  <html>
  <head>
      <title>@yield('title')</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  </head>
  <body>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container">
              <a class="navbar-brand" href="{{ url('/') }}">Thư viện</a>
              <div class="navbar-nav">
                  @auth
                      <span class="nav-link">Chào {{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
                      <a class="nav-link" href="{{ route('books.index') }}">Danh sách sách</a>
                      @if (auth()->user()->isAdmin())
                          <a class="nav-link" href="{{ route('books.create') }}">Thêm sách</a>
                          <a class="nav-link" href="{{ route('borrow-logs.index') }}">Quản lý mượn/trả</a>
                      @else
                          <a class="nav-link" href="{{ route('borrow-logs.create') }}">Mượn sách</a>
                      @endif
                      <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất</a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                  @else
                      <a class="nav-link" href="{{ route('login') }}">Đăng nhập</a>
                      <a class="nav-link" href="{{ route('register') }}">Đăng ký</a>
                  @endauth
              </div>
          </div>
      </nav>

      <div class="container mt-4">
          @if (session('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{ session('success') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          @endif
          @if (session('error'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  {{ session('error') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          @endif
          @yield('content')
      </div>
  </body>
  </html>
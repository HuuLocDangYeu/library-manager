<!DOCTYPE html>
  <html>
  <head>
      <title>@yield('title')</title>
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

      <div class="container">
          @if (session('success'))
              <div class="alert alert-success">{{ session('success') }}</div>
          @endif
          @if (session('error'))
              <div class="alert alert-danger">{{ session('error') }}</div>
          @endif
          @yield('content')
      </div>
  </body>
  </html>
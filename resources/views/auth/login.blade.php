<!DOCTYPE html>
  <html>
  <head>
      <title>Đăng nhập</title>
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  </head>
  <body>
      <div class="container">
          <h2>Đăng nhập</h2>
          @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
          <form method="POST" action="{{ route('login') }}">
              @csrf
              <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" id="email" class="form-control" required>
              </div>
              <div class="form-group">
                  <label for="password">Mật khẩu</label>
                  <input type="password" name="password" id="password" class="form-control" required>
              </div>
              <button type="submit" class="btn btn-primary">Đăng nhập</button>
              <a href="{{ route('register') }}" class="btn btn-link">Đăng ký</a>
          </form>
      </div>
  </body>
  </html>
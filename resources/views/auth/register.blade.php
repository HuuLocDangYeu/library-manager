<!DOCTYPE html>
<html>
<head>
    <title>Đăng ký</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Đăng ký</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label for="name">Tên</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password-confirm">Xác nhận mật khẩu</label>
                <input type="password" name="password_confirmation" id="password-confirm" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Đăng ký</button>
            <a href="{{ route('login') }}" class="btn btn-link">Đăng nhập</a>
        </form>
    </div>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Đăng ký</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    @extends('layouts.app')
    @section('title', 'Đăng ký')
    @section('content')
    <div class="container mt-4" style="max-width: 500px;">
        <div class="card shadow">
            <div class="card-body">
                <h2 class="mb-4 text-primary"><i class="bi bi-person-plus"></i> Đăng ký</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password-confirm" class="form-label">Xác nhận mật khẩu</label>
                        <input type="password" name="password_confirmation" id="password-confirm" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-person-plus"></i> Đăng ký
                    </button>
                    <a href="{{ route('login') }}" class="btn btn-link">Đăng nhập</a>
                </form>
            </div>
        </div>
    </div>
    @endsection
</body>
</html>
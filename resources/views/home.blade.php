<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

</html>
{{-- filepath: resources/views/home.blade.php --}}
@extends('layouts.app')
@section('title', 'Trang chủ')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-primary">
            <div class="card-body text-center">
                <h2 class="card-title mb-4 text-primary">
                    <i class="bi bi-journal-bookmark-fill"></i> Chào mừng đến với hệ thống quản lý thư viện!
                </h2>
                @auth
                    <p class="mb-3">
                        <span class="badge bg-info text-dark">
                            <i class="bi bi-person-circle"></i> {{ auth()->user()->name }} ({{ auth()->user()->role }})
                        </span>
                    </p>
                    <div class="mb-2">
                        <a href="{{ route('books.index') }}" class="btn btn-primary me-2">
                            <i class="bi bi-book"></i> Danh sách sách
                        </a>
                        @if (auth()->user()->isAdmin())
                            <a href="{{ route('books.create') }}" class="btn btn-success me-2">
                                <i class="bi bi-plus-circle"></i> Thêm sách
                            </a>
                            <a href="{{ route('borrow-logs.index') }}" class="btn btn-warning me-2">
                                <i class="bi bi-clock-history"></i> Quản lý mượn/trả
                            </a>
                        @else
                            <a href="{{ route('borrow-logs.create') }}" class="btn btn-info me-2">
                                <i class="bi bi-journal-arrow-up"></i> Mượn sách
                            </a>
                        @endif
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary me-2">
                        <i class="bi bi-box-arrow-in-right"></i> Đăng nhập
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-person-plus"></i> Đăng ký
                    </a>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection
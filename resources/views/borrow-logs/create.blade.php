<!DOCTYPE html>
<html>
<head>
    <title>Mượn sách</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@extends('layouts.app')
@section('title', 'Mượn sách')
@section('content')
<div class="container mt-4" style="max-width: 600px;">
    <h1 class="mb-4">Mượn sách</h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('borrow-logs.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Người mượn:</label>
            <select name="user_id" class="form-select" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Sách:</label>
            <select name="book_id" class="form-select" required>
                @foreach ($books as $book)
                    <option value="{{ $book->id }}">{{ $book->title }} (Còn: {{ $book->available }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Ngày mượn:</label>
            <input type="date" name="borrow_date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Mượn</button>
        <a href="{{ route('borrow-logs.create') }}" class="btn btn-secondary">Làm mới</a>
    </form>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
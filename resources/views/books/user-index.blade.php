@extends('layouts.app')
@section('title', 'Danh sách sách - User')
@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Danh sách sách</h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <ul class="list-group mb-3">
        @foreach ($books as $book)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>
                    <strong>{{ $book->title }}</strong> - Tác giả: {{ $book->author }}
                </span>
                <span class="badge bg-primary rounded-pill">Còn: {{ $book->available }}</span>
            </li>
        @endforeach
    </ul>
    <a href="{{ route('borrow-logs.create') }}" class="btn btn-success">Mượn sách</a>
</div>
@endsection
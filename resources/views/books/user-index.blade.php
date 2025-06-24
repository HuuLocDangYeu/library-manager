@extends('layouts.app')
@section('title', 'Danh sách sách - User')
@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-primary"><i class="bi bi-book"></i> Danh sách sách</h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <ul class="list-group mb-3 shadow">
        @foreach ($books as $book)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>
                    <i class="bi bi-book text-primary"></i>
                    <strong class="text-dark">{{ $book->title }}</strong>
                    <span class="text-muted">- Tác giả: {{ $book->author }}</span>
                </span>
                <span class="badge bg-success rounded-pill">
                    <i class="bi bi-collection"></i> {{ $book->available }}
                </span>
            </li>
        @endforeach
    </ul>
    <a href="{{ route('borrow-logs.create') }}" class="btn btn-success">
        <i class="bi bi-journal-arrow-up"></i> Mượn sách
    </a>
</div>
@endsection
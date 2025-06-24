@extends('layouts.app')
    @section('title', 'Danh sách sách - User')
    @section('content')
        <h1>Danh sách sách</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <ul>
            @foreach ($books as $book)
                <li>{{ $book->title }} - Tác giả: {{ $book->author }} (Còn: {{ $book->available }})</li>
            @endforeach
        </ul>
        <a href="{{ route('borrow-logs.create') }}">Mượn sách</a>
    @endsection
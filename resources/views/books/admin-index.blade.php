@extends('layouts.app')
    @section('title', 'Danh sách sách - Admin')
    @section('content')
        <h1>Danh sách sách (Admin)</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <ul>
            @foreach ($books as $book)
                <li>{{ $book->title }} - Tác giả: {{ $book->author }} (Số lượng: {{ $book->quantity }}, Còn: {{ $book->available }})
                    <a href="{{ route('books.edit', $book->id) }}">Sửa</a>
                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Bạn có chắc?')">Xóa</button>
                    </form>
                </li>
            @endforeach
        </ul>
        <a href="{{ route('books.create') }}">Thêm sách mới</a>
    @endsection
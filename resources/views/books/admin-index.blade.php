@extends('layouts.app')
@section('title', 'Danh sách sách - Admin')
@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-primary"><i class="bi bi-book"></i> Danh sách sách (Admin)</h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-striped table-hover shadow">
        <thead class="table-primary">
            <tr>
                <th><i class="bi bi-book"></i> Tên sách</th>
                <th><i class="bi bi-person"></i> Tác giả</th>
                <th><i class="bi bi-collection"></i> Số lượng</th>
                <th><i class="bi bi-check2-circle"></i> Còn lại</th>
                <th><i class="bi bi-gear"></i> Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                    <td>
                        <i class="bi bi-book text-primary"></i>
                        {{ $book->title }}
                    </td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->quantity }}</td>
                    <td>
                        <span class="badge bg-success">{{ $book->available }}</span>
                    </td>
                    <td>
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i> Sửa
                        </a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc?')">
                                <i class="bi bi-trash"></i> Xóa
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('books.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Thêm sách mới
    </a>
</div>
@endsection
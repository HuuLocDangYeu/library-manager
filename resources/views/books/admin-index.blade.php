@extends('layouts.app')
@section('title', 'Danh sách sách - Admin')
@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-primary"><i class="bi bi-book"></i> Danh sách sách (Admin)</h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Thanh tìm kiếm -->
    <form action="{{ route('books.index') }}" method="GET" class="mb-3">
        <div class="input-group" style="max-width: 400px;">
            <input type="text" name="search" class="form-control" placeholder="Tìm kiếm tên, tác giả, ISBN..." value="{{ request('search') }}">
            <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i> Tìm</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle shadow">
            <thead class="table-primary">
                <tr>
                    <th>Ảnh bìa</th>
                    <th><i class="bi bi-book"></i> Tên sách</th>
                    <th><i class="bi bi-person"></i> Tác giả</th>
                    <th><i class="bi bi-building"></i> NXB</th>
                    <th><i class="bi bi-calendar"></i> Năm</th>
                    <th><i class="bi bi-tags"></i> Thể loại</th>
                    <th><i class="bi bi-upc-scan"></i> ISBN</th>
                    <th><i class="bi bi-geo-alt"></i> Vị trí</th>
                    <th><i class="bi bi-collection"></i> Số lượng</th>
                    <th><i class="bi bi-check2-circle"></i> Còn lại</th>
                    <th><i class="bi bi-gear"></i> Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr>
                        <td>
                            @if($book->cover_image)
                                <img src="{{ asset('storage/'.$book->cover_image) }}" alt="Ảnh bìa" width="60" class="rounded shadow-sm">
                            @else
                                <span class="text-muted">Không có</span>
                            @endif
                        </td>
                        <td>
                            <i class="bi bi-book text-primary"></i>
                            <a href="{{ route('books.show', $book->id) }}" class="fw-bold text-decoration-none text-dark">
                                {{ $book->title }}
                            </a>
                        </td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->publisher }}</td>
                        <td>{{ $book->published_year }}</td>
                        <td>{{ $book->category }}</td>
                        <td>{{ $book->isbn }}</td>
                        <td>{{ $book->location }}</td>
                        <td>{{ $book->quantity }}</td>
                        <td>
                            <span class="badge bg-success">{{ $book->available }}</span>
                        </td>
                        <td>
                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm mb-1">
                                <i class="bi bi-pencil-square"></i> Sửa
                            </a>
                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Bạn có chắc?')">
                                    <i class="bi bi-trash"></i> Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <a href="{{ route('books.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Thêm sách mới
    </a>
</div>
@endsection
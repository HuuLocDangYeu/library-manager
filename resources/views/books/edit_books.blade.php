@extends('layouts.app')
@section('title', 'Sửa sách')
@section('content')
<div class="container mt-4" style="max-width: 600px;">
    <div class="card shadow">
        <div class="card-body">
            <h1 class="mb-4 text-warning"><i class="bi bi-pencil-square"></i> Sửa sách</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Tên sách:</label>
                    <input type="text" name="title" class="form-control" value="{{ $book->title }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tác giả:</label>
                    <input type="text" name="author" class="form-control" value="{{ $book->author }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nhà xuất bản:</label>
                    <input type="text" name="publisher" class="form-control" value="{{ $book->publisher }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Năm xuất bản:</label>
                    <input type="number" name="published_year" class="form-control" value="{{ $book->published_year }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Thể loại:</label>
                    <input type="text" name="category" class="form-control" value="{{ $book->category }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Mô tả ngắn:</label>
                    <textarea name="description" class="form-control" rows="3">{{ $book->description }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mã sách/ISBN:</label>
                    <input type="text" name="isbn" class="form-control" value="{{ $book->isbn }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Số lượng:</label>
                    <input type="number" name="quantity" class="form-control" value="{{ $book->quantity }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Còn lại:</label>
                    <input type="number" name="available" class="form-control" value="{{ $book->available }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Ảnh bìa:</label>
                    @if($book->cover_image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/'.$book->cover_image) }}" alt="Ảnh bìa" width="80">
                        </div>
                    @endif
                    <input type="file" name="cover_image" class="form-control" accept="image/*">
                </div>
                <button type="submit" class="btn btn-warning">
                    <i class="bi bi-save"></i> Cập nhật
                </button>
                <a href="{{ route('books.index') }}" class="btn btn-secondary">Quay lại</a>
            </form>
        </div>
    </div>
</div>
@endsection
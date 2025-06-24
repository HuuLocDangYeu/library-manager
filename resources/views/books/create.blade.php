<!DOCTYPE html>
<html>
<head>
    <title>Thêm sách mới</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    @extends('layouts.app')
    @section('title', 'Thêm sách mới')
    @section('content')
    <div class="container mt-4" style="max-width: 600px;">
        <div class="card shadow">
            <div class="card-body">
                <h1 class="mb-4 text-success"><i class="bi bi-plus-circle"></i> Thêm sách mới</h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Tên sách:</label>
                        <input type="text" name="title" class="form-control" required autofocus placeholder="Nhập tên sách">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tác giả:</label>
                        <input type="text" name="author" class="form-control" required placeholder="Nhập tên tác giả">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nhà xuất bản:</label>
                        <input type="text" name="publisher" class="form-control" placeholder="Nhập nhà xuất bản">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Năm xuất bản:</label>
                        <input type="number" name="published_year" class="form-control" min="1900" max="{{ date('Y') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Thể loại:</label>
                        <input type="text" name="category" class="form-control" placeholder="Nhập thể loại">
                    </div>
                    <div class="mb-3">
    <label class="form-label">Mô tả ngắn:</label>
    <textarea name="description" class="form-control" rows="3" placeholder="Nhập mô tả về sách"></textarea>
</div>
                    <div class="mb-3">
                        <label class="form-label">Mã sách/ISBN:</label>
                        <input type="text" name="isbn" class="form-control" placeholder="Nhập mã sách hoặc ISBN">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Số lượng:</label>
                        <input type="number" name="quantity" class="form-control" required min="0">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Còn lại:</label>
                        <input type="number" name="available" class="form-control" required min="0">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ảnh bìa:</label>
                        <input type="file" name="cover_image" class="form-control" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Lưu
                    </button>
                    <a href="{{ route('books.index') }}" class="btn btn-secondary">Quay lại</a>
                </form>
            </div>
        </div>
    </div>
    @endsection

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
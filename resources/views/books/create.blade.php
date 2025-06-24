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
                <form action="{{ route('books.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Tên sách:</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tác giả:</label>
                        <input type="text" name="author" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Số lượng:</label>
                        <input type="number" name="quantity" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Còn lại:</label>
                        <input type="number" name="available" class="form-control" required>
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
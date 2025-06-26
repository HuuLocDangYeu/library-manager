@extends('layouts.app')
@section('title', 'Mượn sách')
@section('content')
<div class="container mt-4" style="max-width: 600px;">
    <h1 class="mb-4 text-primary"><i class="bi bi-journal-arrow-up"></i> Mượn sách</h1>
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
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        <div class="mb-3">
            <label class="form-label">Sách:</label>
            <select name="book_id" class="form-select" required>
                @foreach ($books as $book)
                    <option value="{{ $book->id }}"
                        @if(isset($selectedBookId) && $selectedBookId == $book->id) selected @endif>
                        {{ $book->title }} (Còn: {{ $book->available }})
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Số lượng mượn:</label>
            <input type="number" name="quantity" class="form-control" min="1" value="1" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Ngày mượn:</label>
            <input type="date" name="borrow_date" class="form-control" required value="{{ date('Y-m-d') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Ngày dự kiến trả:</label>
            <input type="date" name="expected_return_date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Ghi chú:</label>
            <input type="text" name="note" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Mượn</button>
        <a href="{{ route('books.user_show', $selectedBookId ?? '') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
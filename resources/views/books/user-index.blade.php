@extends('layouts.app')
@section('title', 'Danh sách sách - User')
@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-primary"><i class="bi bi-book"></i> Danh sách sách</h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="row g-3">
        @foreach ($books as $book)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    @if($book->cover_image)
                        <div class="d-flex justify-content-center align-items-center" style="height:200px;">
                            <img src="{{ asset('storage/'.$book->cover_image) }}"
                                 class="card-img-top"
                                 alt="Ảnh bìa"
                                 style="max-height:220px; max-width:180px; object-fit:contain; border-radius:12px; box-shadow:0 2px 12px #e3f0ff;">
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('books.user_show', $book->id) }}" class="text-decoration-none text-primary fw-bold">
                                {{ $book->title }}
                            </a>
                        </h5>
                        <p class="card-text mb-1"><i class="bi bi-person"></i> {{ $book->author }}</p>
                        <span class="badge bg-success mb-2"><i class="bi bi-collection"></i> Còn lại: {{ $book->available }}</span>
                        <a href="{{ route('books.user_show', $book->id) }}" class="btn btn-outline-primary btn-sm w-100 mt-2">
                            <i class="bi bi-eye"></i> Xem chi tiết
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-4">
        <a href="{{ route('borrow-logs.create') }}" class="btn btn-success px-4">
            <i class="bi bi-journal-arrow-up"></i> Mượn sách
        </a>
    </div>
</div>
@endsection
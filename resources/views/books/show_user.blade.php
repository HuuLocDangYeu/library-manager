@extends('layouts.app')
@section('title', 'Chi tiết sách')
@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-md-8">
        <div class="card border-0 shadow-lg" style="border-radius: 22px; background: #fafdff;">
            <div class="card-body">
                <div class="d-flex align-items-center mb-4">
                    @if($book->cover_image)
                        <img src="{{ asset('storage/'.$book->cover_image) }}"
                             alt="Ảnh bìa"
                             width="120"
                             class="rounded shadow-sm me-4"
                             style="object-fit:cover; height:160px; border: 3px solid #2563eb; background: #fff; border-radius: 16px;">
                    @endif
                    <div>
                        <h2 class="mb-1" style="color: #174ea6; font-weight: 800; font-size: 2.1rem; letter-spacing: 1px;">
                            <i class="bi bi-book"></i> {{ $book->title }}
                        </h2>
                        <span class="badge border border-primary text-primary bg-white fs-6 px-3 py-2" style="font-size:1rem; font-weight:500;">
                            <i class="bi bi-person"></i> {{ $book->author }}
                        </span>
                        <div class="mt-2">
                            <span class="badge bg-success"><i class="bi bi-collection"></i> Còn lại: {{ $book->available }}</span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="mb-2 p-2 rounded" style="background: #e3f0ff;">
                            <i class="bi bi-building text-primary"></i> <strong>Nhà xuất bản:</strong> {{ $book->publisher }}
                        </div>
                        <div class="mb-2 p-2 rounded" style="background: #e3f0ff;">
                            <i class="bi bi-calendar text-primary"></i> <strong>Năm xuất bản:</strong> {{ $book->published_year }}
                        </div>
                        <div class="mb-2 p-2 rounded" style="background: #e3f0ff;">
                            <i class="bi bi-tags text-primary"></i> <strong>Thể loại:</strong> {{ $book->category }}
                        </div>
                        <div class="mb-2 p-2 rounded" style="background: #e3f0ff;">
                            <i class="bi bi-upc-scan text-primary"></i> <strong>ISBN:</strong> {{ $book->isbn }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2 p-2 rounded" style="background: #e3f0ff;">
                            <i class="bi bi-geo-alt text-primary"></i> <strong>Vị trí:</strong> {{ $book->location }}
                        </div>
                        <div class="mb-2 p-2 rounded" style="background: #e3f0ff;">
                            <i class="bi bi-collection text-primary"></i> <strong>Số lượng:</strong> {{ $book->quantity }}
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <strong style="color: #2563eb;"><i class="bi bi-info-circle"></i> Mô tả:</strong>
                    <div class="border rounded p-3 bg-white mt-1" style="min-height:60px; color: #333;">
                        {{ $book->description ?? 'Không có mô tả.' }}
                    </div>
                </div>
                @if($book->available > 0)
                    <a href="{{ route('borrow-logs.create', ['book_id' => $book->id]) }}" class="btn btn-success px-4">
                        <i class="bi bi-journal-arrow-up"></i> Mượn sách
                    </a>
                @else
                    <button class="btn btn-secondary px-4" disabled>Hết sách</button>
                @endif
                <a href="{{ route('books.index') }}" class="btn btn-outline-primary mt-2 ms-2">
                    <i class="bi bi-arrow-left"></i> Quay lại
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
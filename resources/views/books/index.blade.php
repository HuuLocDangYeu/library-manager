<!DOCTYPE html>
<html>
<head>
    <title>Danh sách sách</title>
    @extends('layouts.app')
    @section('title', 'Lịch sử mượn/trả - Admin')
    @section('content')
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4 text-warning"><i class="bi bi-clock-history"></i> Lịch sử mượn/trả</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered table-hover shadow">
            <thead class="table-warning">
                <tr>
                    <th><i class="bi bi-person"></i> Người mượn</th>
                    <th><i class="bi bi-book"></i> Sách</th>
                    <th><i class="bi bi-calendar"></i> Ngày mượn</th>
                    <th><i class="bi bi-calendar-check"></i> Ngày trả</th>
                    <th><i class="bi bi-info-circle"></i> Trạng thái</th>
                    <th><i class="bi bi-gear"></i> Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($borrowLogs as $log)
                    <tr>
                        <td>{{ $log->user->name }}</td>
                        <td>{{ $log->book->title }}</td>
                        <td>{{ $log->borrow_date }}</td>
                        <td>{{ $log->return_date ?? 'Chưa trả' }}</td>
                        <td>
                            @if($log->status === 'borrowed')
                                <span class="badge bg-info text-dark">Đang mượn</span>
                            @else
                                <span class="badge bg-success">Đã trả</span>
                            @endif
                        </td>
                        <td>
                            @if (!$log->return_date)
                                <form action="{{ route('borrow-logs.update', $log->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="date" name="return_date" required class="form-control d-inline-block" style="width: 140px;">
                                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Xác nhận trả sách?')">
                                        <i class="bi bi-arrow-return-left"></i> Trả sách
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('borrow-logs.create') }}" class="btn btn-primary">
            <i class="bi bi-arrow-left"></i> Quay lại
        </a>
    </div>
    @endsection
</body>
</html>
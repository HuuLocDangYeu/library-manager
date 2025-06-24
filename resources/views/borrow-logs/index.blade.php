@extends('layouts.app')
  @section('title', 'Lịch sử mượn/trả - Admin')
  @section('content')
      <h1>Lịch sử mượn/trả</h1>
      @if (session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      <table class="table">
          <thead>
              <tr>
                  <th>Người mượn</th>
                  <th>Sách</th>
                  <th>Ngày mượn</th>
                  <th>Ngày trả</th>
                  <th>Trạng thái</th>
                  <th>Hành động</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($borrowLogs as $log)
                  <tr>
                      <td>{{ $log->user->name }}</td>
                      <td>{{ $log->book->title }}</td>
                      <td>{{ $log->borrow_date }}</td>
                      <td>{{ $log->return_date ?? 'Chưa trả' }}</td>
                      <td>{{ $log->status }}</td>
                      <td>
                          @if (!$log->return_date)
                              <form action="{{ route('borrow-logs.update', $log->id) }}" method="POST" style="display:inline;">
                                  @csrf
                                  @method('PUT')
                                  <input type="date" name="return_date" required>
                                  <button type="submit" class="btn btn-success" onclick="return confirm('Xác nhận trả sách?')">Trả sách</button>
                              </form>
                          @endif
                      </td>
                  </tr>
              @endforeach
          </tbody>
      </table>
      <a href="{{ route('borrow-logs.create') }}" class="btn btn-primary">Quay lại</a>
  @endsection
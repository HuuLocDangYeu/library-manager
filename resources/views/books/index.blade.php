<!DOCTYPE html>
  <html>
  <head>
      <title>Danh sách sách</title>
  </head>
  <body>
      <h1>Danh sách sách</h1>
      @if (session('success'))
          <div>{{ session('success') }}</div>
      @endif
      <ul>
          @foreach ($books as $book)
              <li>{{ $book->title }} - Tác giả: {{ $book->author }} (Số lượng: {{ $book->quantity }}, Còn: {{ $book->available }})</li>
          @endforeach
      </ul>
      <a href="{{ route('books.create') }}">Thêm sách mới</a>
  </body>
  </html>
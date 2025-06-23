<!DOCTYPE html>
  <html>
  <head>
      <title>Mượn sách</title>
  </head>
  <body>
      <h1>Mượn sách</h1>
      @if (session('success'))
          <div>{{ session('success') }}</div>
      @endif
      @if (session('error'))
          <div>{{ session('error') }}</div>
      @endif
      @if ($errors->any())
          <div>
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
      <form action="{{ route('borrow-logs.store') }}" method="POST">
          @csrf
          <div>
              <label>Người mượn:</label>
              <select name="user_id" required>
                  @foreach ($users as $user)
                      <option value="{{ $user->id }}">{{ $user->name }}</option>
                  @endforeach
              </select>
          </div>
          <div>
              <label>Sách:</label>
              <select name="book_id" required>
                  @foreach ($books as $book)
                      <option value="{{ $book->id }}">{{ $book->title }} (Còn: {{ $book->available }})</option>
                  @endforeach
              </select>
          </div>
          <div>
              <label>Ngày mượn:</label>
              <input type="date" name="borrow_date" required>
          </div>
          <button type="submit">Mượn</button>
      </form>
      <a href="{{ route('borrow-logs.create') }}">Làm mới</a>
  </body>
  </html>
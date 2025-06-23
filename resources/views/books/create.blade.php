<!DOCTYPE html>
  <html>
  <head>
      <title>Thêm sách mới</title>
  </head>
  <body>
      <h1>Thêm sách mới</h1>
      @if ($errors->any())
          <div>
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
      <form action="{{ route('books.store') }}" method="POST">
          @csrf
          <div>
              <label>Tên sách:</label>
              <input type="text" name="title" required>
          </div>
          <div>
              <label>Tác giả:</label>
              <input type="text" name="author" required>
          </div>
          <div>
              <label>Số lượng:</label>
              <input type="number" name="quantity" required>
          </div>
          <div>
              <label>Còn lại:</label>
              <input type="number" name="available" required>
          </div>
          <button type="submit">Lưu</button>
      </form>
      <a href="{{ route('books.index') }}">Quay lại</a>
  </body>
  </html>
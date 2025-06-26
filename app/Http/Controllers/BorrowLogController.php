<?php

  namespace App\Http\Controllers;

  use App\Models\BorrowLog;
  use App\Models\Book;
  use App\Models\User;
  use Illuminate\Http\Request;
  use Illuminate\Support\Facades\Auth;

  class BorrowLogController extends Controller
  {
      public function create(Request $request)
      {
          $books = Book::where('available', '>', 0)->get();
          $users = User::all();
          $selectedBookId = $request->book_id; // lấy book_id từ query string

          if (Auth::check() && Auth::user()->role === 'admin') {
              return view('borrow-logs.admin-create', compact('books', 'users', 'selectedBookId'));
          }
          return view('borrow-logs.user-create', compact('books', 'users', 'selectedBookId'));
      }

      public function store(Request $request)
      {
          $request->validate([
              'user_id' => 'required|exists:users,id',
              'book_id' => 'required|exists:books,id',
              'borrow_date' => 'required|date',
              'quantity' => 'required|integer|min:1',
              'expected_return_date' => 'required|date|after_or_equal:borrow_date',
          ]);

          $book = Book::find($request->book_id);

          // Kiểm tra còn đủ sách không
          if ($book->available >= $request->quantity) {
              BorrowLog::create([
                  'user_id' => $request->user_id,
                  'book_id' => $request->book_id,
                  'borrow_date' => $request->borrow_date,
                  'expected_return_date' => $request->expected_return_date,
                  'quantity' => $request->quantity,
                  'status' => 'pending',
                  'note' => $request->note,
              ]);
              $book->available -= $request->quantity;
              $book->save();
              return redirect()->route('books.user_show', $book->id)->with('success', 'Đã mượn sách thành công!');
          }
          return redirect()->back()->with('error', 'Không đủ sách để mượn!');
      }

      public function index()
      {
          $borrowLogs = BorrowLog::with(['user', 'book'])->get();
          return view('borrow-logs.index', compact('borrowLogs'));
      }

      public function update(Request $request, $id)
      {
          $log = BorrowLog::findOrFail($id);
          $request->validate(['return_date' => 'required|date']);
          $log->update([
              'return_date' => $request->return_date,
              'status' => 'returned',
          ]);
          $book = $log->book;
          // Cộng lại đúng số lượng đã mượn
          $book->available += $log->quantity;
          $book->save();
          return redirect()->route('borrow-logs.index')->with('success', 'Sách đã được trả thành công!');
      }

      public function confirm($id)
      {
          $log = \App\Models\BorrowLog::findOrFail($id);
          $book = $log->book;

          if ($log->status === 'pending') {
              if ($book->available >= $log->quantity) {
                  $log->status = 'borrowed';
                  $log->save();

                  $book->available -= $log->quantity;
                  $book->save();

                  return redirect()->back()->with('success', 'Đã xác nhận mượn sách!');
              } else {
                  return redirect()->back()->with('error', 'Không đủ sách để xác nhận!');
              }
          }
          return redirect()->back();
      }

      public function __construct()
      {
          $this->middleware('auth');
      }
  }
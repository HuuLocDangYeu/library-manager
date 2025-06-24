<?php

  namespace App\Http\Controllers;

  use App\Models\BorrowLog;
  use App\Models\Book;
  use App\Models\User;
  use Illuminate\Http\Request;
  use Illuminate\Support\Facades\Auth;

  class BorrowLogController extends Controller
  {
      public function create()
      {
          $books = Book::where('available', '>', 0)->get();
            if (Auth::check() && Auth::user()->role === 'admin') {
              return view('borrow-logs.admin-create', compact('books', 'users'));
          }
          return view('borrow-logs.user-create', compact('books', 'users'));
          return view('borrow-logs.user-create', compact('books', 'users'));
      }

      public function store(Request $request)
      {
          $request->validate([
              'user_id' => 'required|exists:users,id',
              'book_id' => 'required|exists:books,id',
              'borrow_date' => 'required|date',
          ]);

          $book = Book::find($request->book_id);
          if ($book->available > 0) {
              BorrowLog::create([
                  'user_id' => $request->user_id,
                  'book_id' => $request->book_id,
                  'borrow_date' => $request->borrow_date,
                  'status' => 'borrowed',
              ]);
              $book->available -= 1;
              $book->save();
              return redirect()->route('borrow-logs.create')->with('success', 'Đã mượn sách thành công!');
          }
          return redirect()->back()->with('error', 'Sách đã hết!');
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
          $book->available += 1;
          $book->save();
          return redirect()->route('borrow-logs.index')->with('success', 'Sách đã được trả thành công!');
      }

      public function __construct()
      {
          $this->middleware('auth');
      }
  }
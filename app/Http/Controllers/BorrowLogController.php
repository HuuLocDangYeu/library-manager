<?php

     namespace App\Http\Controllers;

     use App\Models\BorrowLog;
     use App\Models\Book;
     use App\Models\User;
     use Illuminate\Http\Request;

     class BorrowLogController extends Controller
     {
         /**
          * Hiển thị form mượn sách.
          */
         public function create()
         {
             $books = Book::where('available', '>', 0)->get();
             $users = User::all();
             return view('borrow-logs.create', compact('books', 'users'));
         }

         /**
          * Lưu thông tin mượn sách.
          */
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
                 ]);
                 $book->available -= 1;
                 $book->save();
                 return redirect()->route('borrow-logs.create')->with('success', 'Đã mượn sách thành công!');
             }

             return redirect()->back()->with('error', 'Sách đã hết!');
         }
     }
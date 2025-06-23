<?php

     namespace App\Http\Controllers;

     use App\Models\Book;
     use Illuminate\Http\Request;

     class BookController extends Controller
     {
         /**
          * Hiển thị danh sách tất cả sách.
          */
         public function index()
         {
             $books = Book::all();
             return view('books.index', compact('books'));
         }

         /**
          * Hiển thị form thêm sách mới.
          */
         public function create()
         {
             return view('books.create');
         }

         /**
          * Lưu sách mới vào database.
          */
         public function store(Request $request)
         {
             $request->validate([
                 'title' => 'required|string|max:255',
                 'author' => 'required|string|max:255',
                 'quantity' => 'required|integer|min:0',
                 'available' => 'required|integer|min:0',
             ]);

             Book::create($request->all());

             return redirect()->route('books.index')->with('success', 'Sách đã được thêm thành công!');
         }

         public function __construct()
{
    $this->middleware('auth');
    $this->middleware('role:admin')->except('index');
}
     }
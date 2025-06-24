<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        $view = 'books.user-index';
        if (Auth::check() && Auth::user()->role === 'admin') {
            $view = 'books.admin-index';
        }
        return view($view, compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'available' => 'required|integer|min:0',
        ]);

        try {
            Book::create($request->all());
            return redirect()->route('books.index')->with('success', 'Sách đã được thêm thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi khi thêm sách: ' . $e->getMessage());
        }
    }

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin')->except('index');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                  ->orWhere('author', 'like', "%$search%")
                  ->orWhere('isbn', 'like', "%$search%");
            });
        }

        $books = $query->orderBy('created_at', 'desc')->get();
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
            'publisher' => 'nullable|string|max:255',
            'published_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'category' => 'nullable|string|max:255',
            'isbn' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'quantity' => 'required|integer|min:0',
            'available' => 'required|integer|min:0',
        ]);

        $data = $request->except('cover_image');

        // Xử lý upload ảnh bìa nếu có
        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $path = $file->store('covers', 'public');
            $data['cover_image'] = $path;
        }

        try {
            Book::create($data);
            return redirect()->route('books.index')->with('success', 'Sách đã được thêm thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi khi thêm sách: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        // Xóa file ảnh bìa nếu có
        if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
            Storage::disk('public')->delete($book->cover_image);
        }

        $book->delete();
        return redirect()->route('books.index')->with('success', 'Đã xóa sách thành công!');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit_books', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'published_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'category' => 'nullable|string|max:255',
            'isbn' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except('cover_image');

        // Nếu có upload ảnh mới thì xóa ảnh cũ và lưu ảnh mới
        if ($request->hasFile('cover_image')) {
            if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $book->update($data);

        return redirect()->route('books.index')->with('success', 'Cập nhật sách thành công!');
    }
    
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('books.show', compact('book'));
    }
    
    public function userShow($id)
    {
        $book = Book::findOrFail($id);
        return view('books.show_user', compact('book'));
    }

    public function __construct()
    {
        $this->middleware('auth');
        // Chỉ bắt buộc admin với các hàm quản trị, KHÔNG áp dụng cho userShow
        $this->middleware('role:admin')->only([
            'create', 'store', 'edit', 'update', 'destroy', 'show'
        ]);
    }
}
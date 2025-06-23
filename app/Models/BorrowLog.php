<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowLog extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'book_id', 'borrow_date', 'return_date', 'status'];

    protected $casts = [
        'return_date' => 'date',
        'status' => 'string', // Đảm bảo enum được cast đúng
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'publisher',
        'published_year',
        'category',
        'isbn',
        'location',
        'cover_image',
        'quantity',
        'available',
        'description',
    ];

    public function borrowLogs()
    {
        return $this->hasMany(BorrowLog::class, 'book_id');
    }
}
<?php

  namespace App\Models;

  use Illuminate\Database\Eloquent\Model;

  class BorrowLog extends Model
  {
      protected $fillable = [
          'user_id',
          'book_id',
          'borrow_date',
          'expected_return_date',
          'return_date',
          'quantity',
          'status',
          'note',
      ];

      protected $casts = [
          'borrow_date' => 'datetime',
          'expected_return_date' => 'datetime',
          'return_date' => 'datetime',
          'status' => 'string',
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
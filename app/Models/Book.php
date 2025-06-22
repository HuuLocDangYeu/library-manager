<?php

     namespace App\Models;

     use Illuminate\Database\Eloquent\Model;

     class Book extends Model
     {
         protected $fillable = ['title', 'author', 'quantity', 'available'];

         public function borrowLogs()
         {
             return $this->hasMany(BorrowLog::class, 'book_id');
         }
     }
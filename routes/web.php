<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowLogController;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('books', BookController::class);
Route::resource('borrow-logs', BorrowLogController::class);


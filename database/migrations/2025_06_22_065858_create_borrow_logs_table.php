<?php

     use Illuminate\Database\Migrations\Migration;
     use Illuminate\Database\Schema\Blueprint;
     use Illuminate\Support\Facades\Schema;

     class CreateBorrowLogsTable extends Migration
     {
         public function up()
         {
             Schema::create('borrow_logs', function (Blueprint $table) {
                 $table->id();
                 $table->unsignedBigInteger('user_id');
                 $table->unsignedBigInteger('book_id');
                 $table->date('borrow_date');
                 $table->date('return_date')->nullable();
                 $table->enum('status', ['borrowed', 'returned'])->default('borrowed');
                 $table->timestamps();

                 $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                 $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
             });
         }

         public function down()
         {
             Schema::dropIfExists('borrow_logs');
         }
     }
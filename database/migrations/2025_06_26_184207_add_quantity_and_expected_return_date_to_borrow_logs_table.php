<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuantityAndExpectedReturnDateToBorrowLogsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('borrow_logs', function (Blueprint $table) {
            $table->integer('quantity')->default(1);
            $table->date('expected_return_date')->nullable();
            $table->string('note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('borrow_logs', function (Blueprint $table) {
            $table->dropColumn(['quantity', 'expected_return_date', 'note']);
        });
    }
};

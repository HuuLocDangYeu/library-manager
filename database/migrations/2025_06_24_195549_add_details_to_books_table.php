<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('publisher')->nullable()->after('author');
            $table->integer('published_year')->nullable()->after('publisher');
            $table->string('category')->nullable()->after('published_year');
            $table->string('isbn')->nullable()->after('category');
            $table->string('location')->nullable()->after('isbn');
            $table->string('cover_image')->nullable()->after('location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn(['publisher', 'published_year', 'category', 'isbn', 'location', 'cover_image']);
        });
    }
};

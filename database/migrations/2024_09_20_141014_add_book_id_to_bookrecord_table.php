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
        Schema::table('bookrecord', function (Blueprint $table) {
            $table->unsignedBigInteger('book_id')->nullable()->after('id'); // Adding book_id column after id
            
            // Optionally, if this references another table:
            // $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookrecord', function (Blueprint $table) {
            $table->dropColumn('book_id'); // Dropping the book_id column
        });
    }
};
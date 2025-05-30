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
        Schema::table('bookfolder', function (Blueprint $table) {
            $table->boolean('archive')->default(0); // 0 = not archived, 1 = archived
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookfolder', function (Blueprint $table) {
            $table->dropColumn('archive');
        });
    }
};

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
        Schema::table('baptismfolder', function (Blueprint $table) {
            $table->boolean('archived')->default(false); // Adds archived column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('baptismfolder', function (Blueprint $table) {
            $table->dropColumn('archived');
        });
    }
};

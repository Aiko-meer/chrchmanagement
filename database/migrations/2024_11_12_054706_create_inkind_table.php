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
        Schema::create('inkind', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('collection_id');
            $table->text('inkind_details')->nullable();
            $table->text('inkind_pieces')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inkind');
    }
};

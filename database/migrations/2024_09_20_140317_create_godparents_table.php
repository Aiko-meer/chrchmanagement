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
        Schema::create('godparents', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->unsignedBigInteger('baptism_id'); // Foreign key to link with baptism record
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('purok_no')->nullable();
            $table->string('street_address')->nullable();
            $table->string('barangay')->nullable();
            $table->string('municipality_city');
            $table->string('province');
            $table->timestamps();

            $table->foreign('baptism_id')->references('id')->on('baptismrecord')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('godparents');
    }
};

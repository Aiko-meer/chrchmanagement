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
        Schema::create('funeralrecord', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('funeral_id');
            $table->string('record_code'); 
            $table->date('funeral_date');
            $table->string('first_name'); 
            $table->string('middle_name'); 
            $table->string('last_name');
            $table->date('dob');
            $table->date('dod');  //date of death
            $table->string('contact');
            $table->timestamps();
            $table->tinyInteger('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funeralrecord');
    }
};

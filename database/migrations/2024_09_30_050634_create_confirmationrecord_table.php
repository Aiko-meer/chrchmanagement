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
        Schema::create('confirmationrecord', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('confirmation_id');
            $table->string('book_name');
            $table->string('page_no');
            $table->string('record_code');
            $table->date('confirmation_date');
            $table->string('child_first_name');
            $table->string('child_middle_name')->nullable();
            $table->string('child_last_name');
            $table->date('child_dob');          
            $table->string('child_province');   
            $table->string('child_city');   
            $table->string('father_first_name');
            $table->string('father_middle_name')->nullable();
            $table->string('father_last_name');
            $table->string('mother_first_name');
            $table->string('mother_middle_name')->nullable();
            $table->string('mother_last_name');
            $table->string('purok_no');         
            $table->string('street_address');    
            $table->string('barangay');         
            $table->string('residence_province'); 
            $table->string('residence_city');
            $table->string('godparent_first_name');
            $table->string('godparent_middle_name')->nullable();
            $table->string('godparent_last_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('confirmationrecord');
    }
};

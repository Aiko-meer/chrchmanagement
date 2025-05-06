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
        Schema::create('bookrecord', function (Blueprint $table) {
            $table->id();
           
            $table->string('series_year_no');   // Series/Year No.
            $table->string('book_no');          // Book No.
            $table->string('page_no');          // Page No.
            $table->string('record_code');      // Record Code
            $table->date('baptism_date');       // Date of Baptism
            $table->string('child_first_name'); // Child's First Name
            $table->string('child_middle_name'); // Child's Middle Name
            $table->string('child_last_name');  // Child's Last Name
            $table->date('child_dob');          // Child's Date of Birth
            $table->string('child_province');   // Child's Province
            $table->string('child_city');       // Child's City/Municipality
            $table->string('father_first_name'); // Father's First Name
            $table->string('father_middle_name'); // Father's Middle Name
            $table->string('father_last_name');  // Father's Last Name
            $table->string('father_province');   // Father's Province
            $table->string('father_city');       // Father's City/Municipality
            $table->string('mother_first_name'); // Mother's First Name
            $table->string('mother_middle_name'); // Mother's Middle Name
            $table->string('mother_last_name');  // Mother's Last Name
            $table->string('mother_province');   // Mother's Province
            $table->string('mother_city');       // Mother's City/Municipality
            $table->string('purok_no');          // Purok No.
            $table->string('street_address');    // Street Address
            $table->string('barangay');          // Barangay
            $table->string('residence_province'); // Residence Province
            $table->string('residence_city');    // Residence Municipality/City
            $table->timestamps();
            $table->tinyInteger('status')->nullable();
            $table->string('category');
            $table->string('price');
            $table->tinyInteger('payment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookrecord');
    }
};

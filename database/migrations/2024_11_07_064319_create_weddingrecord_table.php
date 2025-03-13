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
        Schema::create('weddingrecord', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wedding_id');
            $table->string('record_code');
            $table->date('wedding_date');
            $table->string('groom_first_name');
            $table->string('groom_middle_name')->nullable();
            $table->string('groom_last_name');
            $table->date('groom_dob');
            $table->string('groom_purok_no');         
            $table->string('groom_street_address');    
            $table->string('groom_barangay');         
            $table->string('groom_residence_province'); 
            $table->string('groom_residence_city');
            $table->string('groom_contact');
            $table->string('bride_first_name');
            $table->string('bride_middle_name')->nullable();
            $table->string('bride_last_name');
            $table->date('bride_dob');
            $table->string('bride_purok_no');         
            $table->string('bride_street_address');    
            $table->string('bride_barangay');         
            $table->string('bride_residence_province'); 
            $table->string('bride_residence_city');
            $table->string('bride_contact');
            $table->string('document')->nullable();
            $table->timestamps();
            $table->tinyInteger('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weddingrecord');
    }
};

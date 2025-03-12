<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfirmationRecord extends Model
{
    use HasFactory;

    protected $table = 'confirmationrecord'; 

    // Allow mass assignment for these fields
    protected $fillable = [
        'confirmation_id',
        'series_year_no',
        'page_no',
        'record_code',
        'confirmation_date',
        'child_first_name',
        'child_middle_name',
        'child_last_name',
        'child_dob',
        'child_province',
        'child_city',
        
        'father_first_name',
        'father_middle_name',
        'father_last_name',
        'mother_first_name',
        'mother_middle_name',
        'mother_last_name',
        'purok_no',
        'street_address',
        'barangay',
        'residence_province',
        'residence_city',
        'godparent_first_name',
        'godparent_middle_name',
        'godparent_last_name',
        'archive',
        'status',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
         'status','first_name', 'middle_name', 'last_name', 'dob', 'civil_status',
        'age', 'gender', 'position', 'email', 'contact_number', 'purok_no',
        'street_address', 'barangay', 'municipality', 'province', 'picture','archive'
    ];
}
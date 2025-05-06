<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeddingRecord extends Model
{
    protected $table = 'weddingrecord';

    // Define which attributes can be mass-assigned
    protected $fillable = [
        'wedding_id', 
        'record_code',
        'wedding_date',
        'archive',
        'status',
        'groom_first_name',
        'groom_middle_name',
        'groom_last_name',
        'groom_dob',
        'groom_purok_no'    ,    
        'groom_street_address',
        'groom_barangay', 
        'groom_residence_province',
        'groom_residence_city',
        'groom_contact',
        'bride_first_name',
        'bride_middle_name',
        'bride_last_name',
        'bride_dob',
        'bride_purok_no'  ,   
        'bride_street_address'  ,
        'bride_barangay'        ,
        'bride_residence_province',
        'bride_residence_city',
        'bride_contact',
        'groom_baptism_cert' ,
        'groom_confirmation_cert' ,
        'groom_cenomar' ,
        'brides_baptism_cert' ,
        'brides_confirmation_cert' ,
        'brides_cenomar' ,
        'category',
        'price',
        'payment',
        'sundayone',
        'sundaytwo',
        'sundaythree',
       
        
    ];
}

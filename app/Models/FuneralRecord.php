<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuneralRecord extends Model
{
    use HasFactory;
    protected $table = 'funeralrecord';


    protected $fillable = [
        'funeral_id',
        'record_code',
        'funeral_date',
        'first_name',
        'middle_name',
        'last_name',
        'dob',
        'dod',
        'contact',
        'archive',
        'status',
        'payment',
        'groombapcer' ,
        'groomconfir' ,
        'groomcenomar' ,
        'document' ,
        'bridesbapcer' ,
        'bridesconfir' ,
        'bridescenomar' ,
        'category',
        'price',
        
    ];
}

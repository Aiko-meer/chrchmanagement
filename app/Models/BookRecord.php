<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookRecord extends Model
{
    use HasFactory;

    // Define the table associated with this model
    protected $table = 'bookrecord';

    // Define which attributes can be mass-assigned
    protected $fillable = [
        'archive',
        'status',
        'series_year_no',
        'book_no',
        'page_no',
        'record_code',
        'baptism_date',
        'child_first_name',
        'child_middle_name',
        'child_last_name',
        'child_dob',
        'child_province',
        'child_city',
        'father_first_name',
        'father_middle_name',
        'father_last_name',
        'father_province',
        'father_city',
        'mother_first_name',
        'mother_middle_name',
        'mother_last_name',
        'mother_province',
        'mother_city',
        'purok_no',
        'street_address',
        'barangay',
        'residence_province',
        'residence_city',
        'book_id', // Added new field 'book_id'
        'status',
    ];

    // Optionally, define relationships
    // If the `book_id` references another table like `Book`, you can define a relationship:
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
    public function godparents()
    {
        return $this->hasMany(Godparent::class);
    }

    
}
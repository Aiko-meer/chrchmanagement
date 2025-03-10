<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Godparent extends Model
{
    use HasFactory;

    protected $fillable = [
        'baptism_id',
        'first_name', 
        'middle_name', 
        'last_name',
        'purok_no',
        'street_address',
        'barangay',
        'municipality_city',
        'province'
    ];

    // Define relationship with the Baptism model
    public function baptism()
    {
        return $this->belongsTo(Baptism::class);
    }
}
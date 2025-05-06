<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baptismprice extends Model
{
    use HasFactory;

    protected $table = 'baptismprice'; // Ensure this matches the actual table name
    protected $fillable = ['name', 'price'];
}

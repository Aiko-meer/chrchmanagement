<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weddingprice extends Model
{
    use HasFactory;

    protected $table = 'weddingpricec'; // Ensure this matches the actual table name
    protected $fillable = ['name', 'price'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funeralprice extends Model
{
    use HasFactory;

    protected $table = 'funeralprice'; // Ensure this matches the actual table name
    protected $fillable = ['name', 'price'];
}

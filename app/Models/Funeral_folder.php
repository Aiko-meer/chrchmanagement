<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funeral_folder extends Model
{
    use HasFactory;
    protected $table = 'funeralfolder';
    protected $fillable = ['year', 'month','archive'];

}

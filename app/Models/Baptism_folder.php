<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baptism_folder extends Model
{
    use HasFactory;

    protected $table = 'baptismfolder'; // Ensure this matches the actual table name
    protected $fillable = ['year', 'month', 'archived'];

    // ✅ Move the function INSIDE the class
    public function bookFolders()
    {
        return $this->hasMany(BookFolder::class, 'baptism_id');
    }
}

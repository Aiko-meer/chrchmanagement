<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookFolder extends Model
{
    use HasFactory;

    protected $table = 'bookfolder'; // The table name
    protected $fillable = ['book_number', 'baptism_id', 'archive']; // Specify which columns are fillable

    public function bookRecords()
{
    return $this->hasMany(BookRecord::class, 'book_id');
}
}
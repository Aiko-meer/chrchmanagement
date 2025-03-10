<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acolyte extends Model
{
    use HasFactory;

    protected $table = 'acolytes';  // Ensure the table name matches your DB
    protected $fillable = ['first_name', 'middle_name', 'last_name', 'collection_record_id'];
    public function collectionRecord()
    {
        return $this->belongsTo(CollectionRecord::class);
    }
}

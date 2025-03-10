<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InKindCollection extends Model
{
    use HasFactory;

    protected $table = 'in_kind_collections';  
    protected $fillable = ['item_name', 'pieces', 'collection_record_id'];

    public function collectionRecord()
    {
        return $this->belongsTo(CollectionRecord::class);
    }
}
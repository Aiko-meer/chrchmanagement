<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectionRecord extends Model
{
    use HasFactory;

    protected $table = 'collection_records';  
    protected $fillable = ['collection_date', 'start_time', 'end_time', 'money_amount','archive' ];

    public function acolytes()
    {
        return $this->hasMany(Acolyte::class);
    }

    public function in_kind_collections()
    {
        return $this->hasMany(InKindCollection::class);
    }
}
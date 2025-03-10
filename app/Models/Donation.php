<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'cash_amount',
        'inkind_details',
        'archive'
    ];

    public function donors()
    {
        return $this->hasMany(Donor::class);
    }
}

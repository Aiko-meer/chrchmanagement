<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'donation_id',
        'first_name',
        'middle_name',
        'last_name',
        'contact_no',
    ];

    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }
}

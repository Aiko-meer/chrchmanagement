<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payment';
    protected $fillable = [
        'first_name', 'middle_name', 'last_name',   'reason','amount','payment_date', 'payment_time','archive'
   ];
}

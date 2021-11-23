<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turn extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'family',
        'specialty',
        'date',
        'time',
        'phone',
        'address',
        'total_payment',
        'advance_payment',
        'balance_payment',
    ];
    use HasFactory;
}

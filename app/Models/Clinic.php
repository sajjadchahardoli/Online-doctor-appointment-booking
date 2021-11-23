<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    protected $fillable = [
        'id',
        'name',
        'code',
        'type',
        'phone',
        'address',
        'doctor_id'
    ];
    use HasFactory;

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }

}

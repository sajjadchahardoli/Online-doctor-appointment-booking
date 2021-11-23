<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;

  protected $fillable = [
      'date',
      'time',
      'status',
      'doctor_id', //نمی دونم که باید در این جا وارد کنم یا نه
      'user_id',
      'clinic_id',
  ];

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    protected $fillable = [
        'id',
        'type',
        'user_id'
        ];
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

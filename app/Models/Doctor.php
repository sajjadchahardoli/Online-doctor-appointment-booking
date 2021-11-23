<?php

namespace App\Models;

use App\Notifications\SecretaryResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Doctor extends Authenticatable
{
    use Notifiable;


    protected $fillable = [
        'id',
        'name',
        'family',
        'gender',
        'specialty',
        'medical_system_number',
        'phone',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $guard = 'doctor';


    public function sendPasswordResetNotification($token)
    {
        $this->notify(new SecretaryResetPasswordNotification($token));
    }

    public function times()
    {
        return $this->hasMany(Time::class);
    }

    public function clinics()
    {
        return $this->hasMany(Clinic::class);
    }



}

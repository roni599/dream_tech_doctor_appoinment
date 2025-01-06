<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PHPUnit\Event\Telemetry\System;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'hospital_name',
        'reg_number',
        'establish',
        'country',
        'division',
        'district',
        'sub_district',
        'location_details',
        'mobile_number_1',
        'mobile_number_2',
        'email',
        'admin_name',
        'admin_mobile',
        'admin_email',
        'password',
        'logo',
        'front_picture',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'user_doctor')->withTimestamps();
    }
    public function symtoms()
    {
        return $this->hasMany(Symptom::class);
    }
    public function specialist()
    {
        return $this->hasMany(Specialist::class);
    }
    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }
}

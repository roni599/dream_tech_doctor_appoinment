<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Doctor extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'doctors';

    protected $fillable = [
        'deparment_category',
        'regnum',
        'doctorName',
        'email',
        'age',
        'gender',
        'details',
        'experience',
        'Specialist',
        'Shedule',
        'symptom',
        'mobile',
        'mobile_optional',
        'visitfee',
        'second_day',
        'second_dayFee',
        'thired_day',
        'thired_dayFee',
        'payment_type',
        'room_number',
        'appoinment_mobile',
        'appoinment_mobileOptional',
        'doctor_image',
        'signature_image',
        'prescription_signature_style',
        'user_id',
        'password', // Make sure password is fillable too
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($doctor) {
            if (!$doctor->doctor_id) {
                $doctor->update([
                    'doctor_id' => 'DOC-' . str_pad($doctor->id, 4, '0', STR_PAD_LEFT),
                ]);
            }
        });
    }

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'Specialist' => 'array',
        'Schedule' => 'array',
        'symptom' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    // JWT Implementation
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}

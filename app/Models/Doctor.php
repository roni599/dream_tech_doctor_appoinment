<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $table = 'doctors';

    protected $fillable = [
        'department_category',
        'registration_number',
        'doctor_name',
        'email',
        'age',
        'gender',
        'details',
        'experience',
        'specialist',
        'schedule',
        'symptoms',
        'mobile',
        'mobile_optional',
        'visit_fee',
        'second_day',
        'second_day_fee',
        'third_day',
        'third_day_fee',
        'payment_type',
        'room_number',
        'appointment_mobile',
        'appointment_mobile_optional',
        'doctor_image',
        'signature_image',
        'prescription_signature_style',
    ];

    protected $casts = [
        'specialist' => 'array',
        'schedule' => 'array',
    ];
}

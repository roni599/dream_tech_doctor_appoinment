<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
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
        'user_id'
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
}

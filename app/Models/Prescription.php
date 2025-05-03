<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
    protected $fillable = [
        'doctor_id',
        'appointment_id',
        'blood_pressure_up',
        'blood_pressure_down',
        'pathologies',
        'medicine',
        'visit_date',
        'status'
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    protected $casts = [
        'pathologies' => 'array',
        'medicine' => 'array',
    ];
}

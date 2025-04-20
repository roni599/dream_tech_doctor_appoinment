<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $guarded = [];
    // protected $fillable = [
    //     'Sl_no',
    //     'visit_date',
    //     'patient_mobile',
    //     'patient_name',
    //     'patient_address',
    //     'gender',
    //     'age',
    //     'visit_time',
    //     'payment_status',
    //     'description',
    //     'fee',
    //     'amount',
    //     'taka',
    //     'discount_narration',
    //     'free_narration',
    //     'user_id',
    //     'doctor_id',
    //     'reference_id',
    //     'discount_free_reference_id',
    //     'department_id',
    //     'appointby',
    //     'status'
    // ];
    protected static function booted()
    {
        static::creating(function ($appointment) {
            if ($appointment->visit_date) {
                $maxSlNo = self::where('visit_date', $appointment->visit_date)->max('Sl_no');
                $appointment->Sl_no = $maxSlNo ? $maxSlNo + 1 : 1;
            } else {
                $appointment->Sl_no = 1;
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function reference()
    {
        return $this->belongsTo(Reference::class);
    }
    public function discountFreeReference()
    {
        return $this->belongsTo(Reference::class, 'discount_free_reference_id');
    }
    public function departmentCategory()
    {
        return $this->belongsTo(Department::class,'department_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $guarded = [];

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

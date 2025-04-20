<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'phone', 'address', 'status', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    public function discountFreeAppointments()
    {
        return $this->hasMany(Appointment::class, 'discount_free_reference_id');
    }
}

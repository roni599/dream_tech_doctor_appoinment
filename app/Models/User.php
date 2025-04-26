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
    public function doctor()
    {
        return $this->hasMany(Doctor::class);
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

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function department()
    {
        return $this->hasMany(Department::class);
    }
    public function references()
    {
        return $this->hasMany(Reference::class);
    }
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    public function medicineGroups()
    {
        return $this->hasMany(MedicineGroup::class);
    }
    public function medicines()
    {
        return $this->hasMany(Medicine::class);
    }
    public function pathologies()
    {
        return $this->hasMany(Pathology::class);
    }
    public function pathologyCategories()
    {
        return $this->hasMany(PathologyCategory::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineGroup extends Model
{
    use HasFactory;
    protected $fillable = ['group_name','status','user_id'];
}

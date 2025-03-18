<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;
    protected $fillable=['medicine_name','strength','dosages_description','use_for','status','user_id','medicine_group_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function medicineGroup()
    {
        return $this->belongsTo(MedicineGroup::class);
    }
}

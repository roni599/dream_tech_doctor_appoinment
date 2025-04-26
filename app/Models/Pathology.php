<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pathology extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'status',
        'user_id',
        'pathology_category_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(PathologyCategory::class,'pathology_category_id');
    }
    
}

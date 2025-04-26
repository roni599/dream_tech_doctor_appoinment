<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PathologyCategory extends Model
{
    use HasFactory;
    protected $table = 'pathology_categories';

    protected $fillable = ['name', 'status', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function pathologies()
    {
        return $this->hasMany(Pathology::class,'pathology_category_id');
    }
}

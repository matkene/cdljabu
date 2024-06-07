<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    use HasFactory;
    protected $fillable = [
        'progdesc', 'department', 'school_id',
    ];

    public function admission()
    {
        return $this->hasMany(Admission::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function award()
    {
        return $this->hasMany(Award::class);
    }

    public function fee()
    {
        return $this->hasMany(Fee::class);
    }
}

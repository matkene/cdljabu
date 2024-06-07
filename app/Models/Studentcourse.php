<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studentcourse extends Model
{
    use HasFactory;
    protected $fillable = [
        'programme_id', 'matric', 'course_id','level' , 
        'term', 'semester','crsid', 'status'
    ];

    public function programme()
    {
        return $this->belongsTo(Programme::class);
    }

    public function courses()
    {
        return $this->belongsTo(Course::class);
    }
}

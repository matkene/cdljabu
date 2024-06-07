<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'programme_id', 'crsid', 'term_id','crsdesc',  'unit', 'level','remark',
         'semester','status','user_id'
    ];
    public function programme(){
        return $this->belongsTo(Programme::class);
    }
    public function studentcourse(){
        return $this->hasMany(Studentcourse::class,'course_id');
    }
    public function result(){
        return $this->hasMany(Result::class,'course_id');
    }

    public function term()
    {
        return $this->belongsTo(Term::class);
    }


}

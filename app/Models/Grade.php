<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','school_id', 'programme_id','score', 'weighed_point', 
        'letter_grade', 'remark' , 'term_id'
    ];

    public function school(){
        return $this->belongsTo(School::class);
    }

    public function programme(){
        return $this->belongsTo(Programme::class);
    }

    public function result(){
        return $this->belongsTo(Result::class);
     }

     public function  term()
     {
        return $this->belongsTo(Term::class);
     }

}

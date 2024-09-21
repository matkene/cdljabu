<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    protected $fillable = [
        'matric', 'programme_id', 'course_id',  'level', 'semester', 'others', 
        'term_id', 'grade_ids', 'mark_total', 'mark_score','status', 'crsid','ca_score'
    ];

    public function programme()
    {
        return $this->belongsTo(Programme::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function term()
    {
        return $this->belongsTo(Term::class);
    }
}

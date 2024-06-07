<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examresult extends Model
{
    use HasFactory;
    protected $fillable = [
        'formno','subject_id','status','exam_id','grader_id','examno','no_ofsitting'
    ];
   
    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function grader()
    {
        return $this->belongsTo(Grader::class);
    }
}

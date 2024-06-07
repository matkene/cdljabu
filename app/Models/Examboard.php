<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examboard extends Model
{
    use HasFactory;
    protected $fillable = [
        'formno','year','examno','center','certificate','exam_id',
        'term_id','status','no_ofsitting', 'certificate_id'
    ];
   
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function term()
    {
        return $this->belongsTo(Term::class);
    }

    public function certificate()
    {
        return $this->belongsTo(Certificate::class);

    }


}

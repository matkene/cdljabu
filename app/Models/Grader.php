<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grader extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','point'
    ];

    public function examresult(){
        return $this->hasMany(Examresult::class,'grader_id');
    }
}

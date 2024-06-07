<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mode extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];

    public function student(){
        return $this->hasMany('App\Student','mode_id');
    }
    public function application(){
        return $this->hasMany('App\Application','mode_id');
    }
}

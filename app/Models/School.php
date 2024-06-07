<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;
    protected $fillable = [
        "name","code"
    ];
    public function student(){
        return $this->hasMany(Student::class);
    }

    public function application()
    {
        return $this->hasMany(Application::class);
    }

    public function programme()
    {
        return $this->hasMany(Programme::class);
    }

    public function award()
    {
        return $this->hasMany(Award::class);
    }

    public function grade()
    {
        return $this->hasMany(Grade::class);
    }
}

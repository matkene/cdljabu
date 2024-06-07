<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    protected $fillable = [
        "name"
    ];

    public function student(){
        return $this->hasMany(Student::class);
    }

    public function application()
    {
        return $this->hasMany(Application::class);
    }

    public function admission()
    {
        return $this->hasMany(Admission::class);
    }
    public function lga()
    {
        return $this->hasMany(Lga::class);
    }
}

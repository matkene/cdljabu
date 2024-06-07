<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lga extends Model
{
    use HasFactory;
    protected $fillable = [
       'name', 'state_id'
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

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}

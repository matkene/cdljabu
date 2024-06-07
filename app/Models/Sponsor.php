<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;
    protected $fillable = [
        'formno','name','relationship_id','address','email','mphone'
    ];

    public function student(){
        return $this->hasMany(Student::class);
    }

    public function application()
    {
        return $this->hasMany(Application::class);
    }
}

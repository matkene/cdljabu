<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function award(){
        return $this->hasMany(Award::class);
    }

    public function user(){
        return $this->hasMany(User::class);
    }

    public function application()
    {
        return $this->hasMany(Application::class);
    }

    public function student()
    {
        return $this->hasMany(Student::class);
    }
}

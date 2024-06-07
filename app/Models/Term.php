<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",'status'
    ];

    public function student()
    {
        return $this->hasMany(Student::class);
    }

    public function applpayment()
    {
        return $this->hasMany(ApplPayment::class);
    }

    public function course()
    {
        return $this->hasMany(Course::class);
    }

    public function examboard()
    {
        return $this->hasMany(Examboard::class);

    }

    public function fee()
    {
        return $this->hasMany(Fee::class);
    }

    public function grade()
    {
        return $this->hasMany(Grade::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employment extends Model
{
    use HasFactory;
    protected $fillable = [
        'formno','name','position','datefrom','dateto'
    ];

    public function job()
    {
        return $this->hasMany(Job::class);
    }
}

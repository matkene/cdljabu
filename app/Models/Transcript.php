<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transcript extends Model
{
    use HasFactory;
    protected $fillable = [
        'matric','name', 'programme_id', 'term_id','transcript_school','transcript_address'
    ];
}

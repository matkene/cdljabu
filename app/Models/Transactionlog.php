<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactionlog extends Model
{
    use HasFactory;
    protected $fillable = [
        'matric','name','transactionid','remita_reference','transac_response',
        'response_description','transac_date'
    ];

    
}

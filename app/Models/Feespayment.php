<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feespayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'pin','term_id','programme_id','level','semester','amount','applno',
        'matric','type','amtpaid', 'amtdue','relvant'
    ];

    public function term()
    {
        return $this->belongsTo(Term::class);
    }

    public function programme()
    {
        return $this->belongsTo(Programme::class);
    }
}

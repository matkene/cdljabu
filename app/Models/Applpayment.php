<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applpayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'formno','sname','fname','oname','mphone','email','term_id',
        'paymentcode','rrr', 'status','amount'
    ];

    public function term()
    {
        return $this->belongsTo(Term::class);
    }
}

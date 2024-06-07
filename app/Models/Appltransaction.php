<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appltransaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'formno','sname','fname','oname','paymentcode','transac_response',
        'transac_date','rrr', 'transac_info','amount'
    ];
}

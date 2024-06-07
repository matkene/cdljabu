<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactcode extends Model
{
    use HasFactory;
    protected $fillable = [
        'pin','term_id','programme_id','level','semester','amount',
        'tistatus','matric','type','rrr'
    ];

    public function programme()
    {
     return $this->belongsTo(Programme::class);
    }
}

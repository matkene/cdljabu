<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    use HasFactory;
    protected $fillable = [
        'formno','name','mphone','state','lga','refno','programme',
        'programme_id','level','year'
    ];

    public function programme()
    {
        return $this->belongsTo(Programme::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);

    }
    public function lga()
    {
        return $this->belongsTo(Lga::class);

    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;
    protected $fillable = [
        'programme_id', 'term_id', 'level', 'type', 'item', 'amount',
    ];

    public function programme()
    {
        return $this->belongsTo(Programme::class);
    }

    public function term()
    {
        return $this->belongsTo(Term::class);
    }
}

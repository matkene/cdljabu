<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'school', 'school_id','programme','programme_id',
        'category_id', 'category','other','year','level','format'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function programme()
    {
        return $this->belongsTo(Programme::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'term_id','matric','mphone', 'applno','fname','sname','oname','dob','level','programme_id', 
        'gender_id','mode_id', 'title_id', 'religion_id', 'state_id', 'lga_id','bloodgroup_id',
        'marital_id','spname', 'dateofmarriage','address', 'email',  'rel_nok','name_nok',
        'relationship_id', 'year_ofentry', 'course_duration','address_nok','mphone_nok',
        'email_nok','passport','country_id','religion','term_id','mstatus','term'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function programme()
    {
        return $this->belongsTo(Programme::class);
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function mode()
    {
        return $this->belongsTo(Mode::class);
    }

    public function title()
    {
        return $this->belongsTo(Title::class);
    }


    public function religions()
    {
        return $this->belongsTo(Religion::class,'religion_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function lga()
    {
        return $this->belongsTo(Lga::class);
    }

    public function bloodgroup()
    {
        return $this->belongsTo(Bloodgroup::class);
    }

    public function marital()
    {
        return $this->belongsTo(Marital::class);
    }

    public function relationship()
    {
        return $this->belongsTo(Relationship::class,'rel_nok');
    }

    public function term()
    {
        return $this->belongsTo(Term::class);
    }


}

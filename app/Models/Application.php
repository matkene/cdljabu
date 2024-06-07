<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mode;

class Application extends Model
{
    use HasFactory;
    protected $fillable = [
        'formno','title_id','gender_id', 'sname', 'fname', 'oname','marital_id', 
        'dob' ,'maiden', 'state_id', 'lga_id', 'country_id','address' , 'accepted', 
        'submitted','city','states','mphone','email','programme_id', 'mode_id', 'religion_id',
        'bloodgroup_id','category_id','admletter','printslip','year_ofentry', 'sname_nok', 'passport',
        'fname_nok','oname_nok','rel_nok','address_nok','mphone_nok','email_nok','place_ofbirth'
    ];

    
    public function gender(){
        return $this->belongsTo(Gender::class);
    }

    public function bloodgroup(){
        return $this->belongsTo(Bloodgroup::class);
    }

    public function marital(){
        return $this->belongsTo(Marital::class);
    }
    public function lga(){
        return $this->belongsTo(Lga::class);
    }

    public function state(){
        return $this->belongsTo(State::class);
    }
    public function relationship(){
        return $this->belongsTo(Relationship::class);
    }
    public function religion(){
        return $this->belongsTo(Religion::class);
    }
    public function school(){
        return $this->belongsTo(School::class);
    }
    public function programme(){
        return $this->belongsTo(Programme::class);
    }
    public function title(){
        return $this->belongsTo(Title::class);
    }
    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function mode()
    {
        return $this->belongsTo(Mode::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

}

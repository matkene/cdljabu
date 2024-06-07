<?php   

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Employer;
use App\Models\Tag;

use Illuminate\Support\Arr;

class Job extends Model {
    use HasFactory;
    protected $table = 'job_listings';

    //protected $fillable = ['title', 'salary','employer_id'];
    protected $guarded = [];  // Helps to prevent the mass assignment security

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }
    
    public function tags()
    {
        return $this->belongsToMany(Tag::class, foreignPivotKey:"job_listings_id") ;
    }
       
}




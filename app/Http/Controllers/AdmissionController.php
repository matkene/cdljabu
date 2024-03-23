<?php

namespace App\Http\Controllers;
use App\Models\Admission;



use Illuminate\Http\Request;




class AdmissionController extends Controller
{
    //
    public function index(){
        $admission = Admission::all();
        return view("");
    }
}

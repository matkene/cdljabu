<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    //
    public function create()
    {
        
        //return view('login'); For the Laravel example
        return view('authorize.login');
    }

    public function store(Request $request)
    {
       //dd($request);
        //validate   $attributes=  request()->validate([
            $attribute = request()->validate([
                'username' => ['required'],
                'password' => ['required']  
           ]);
           //attempt to login
       // if(User::where([['username','=',$request->username],['active','=',1]])->first()){
         if( ! Auth::attempt($attribute)){  //set second paramter to false to remember user
               throw ValidationException::withMessages([
                'username'=> 'Sorry the credentials do not match'
               ]); 
            }   //regenerate session token
               
            request()->session()->regenerate();
        if(Auth::user()->role_id == 7){  
              
        return redirect('/applicant/index')->with('message', 'You are logged in as Applicant');;
         }elseif(Auth::user()->role_id == 1){
        
        return redirect('/admin/dashboard')->with('message', 'You are logged in as Administrator');
         }elseif(Auth::user()->role_id == 2){
         
        return redirect('/student')->with('message', 'You are logged in as Student');
         }elseif(Auth::user()->role_id == 3){
         
        return redirect('/finance/dashboard')->with('message', 'You are logged in as Finance Officer');
        }elseif(Auth::user()->role_id == 4){
         
        return redirect('/exams/dashboard')->with('message', 'You are logged in as Exam Officer');
         }elseif(Auth::user()->role_id == 5){
          
        return redirect('/admission/dashboard')->with('message', 'You are logged in as Admission officer');
         }elseif(Auth::user()->role_id == 6){
          
        return redirect('/helpdesk/dashboard')->with('message', 'You are logged in as Help Desk Officer');
         }elseif(Auth::user()->role_id == 8){
          
        return redirect('/cadviser/dashboard')->with('message', 'You are logged in as Course Adviser');
         }elseif(Auth::user()->role_id == 9){
          
        return redirect('/lsupport/dashboard')->with('message', 'You are logged in as Learner Support');
           }else{
        //return redirect('authorize/login')->with('message', 'Please speak with Admin on your authorization');
        return back()->withErrors(['username'=>'Invalid Credentails'])->withInput(['username']);
         }
         
     //}
     //return redirect('authorize/login')->with('message', 'Please speak with Admin on your authorization');
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->regenerateToken();
        $request->session()->invalidate();
        
        
       // return view('/third'); for laravel
        return redirect('/authorize/login')->with('message', 'Logged out. Hope to see you next time');
    }

    

    


}

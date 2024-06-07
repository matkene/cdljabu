<?php

namespace App\Http\Controllers;

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
                'email' => ['required','email'],
                'password' => ['required']  
           ]);
           //attempt to login

         if( ! Auth::attempt($attribute)){  //set second paramter to false to remember user
               throw ValidationException::withMessages([
                'email'=> 'Sorry the credentials do not match'
               ]); 
            }   //regenerate session token
         request()->session()->regenerate();
         // redirect
        //return redirect('/first'); for laravel examples
        return redirect('/applicant/index');
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->regenerateToken();
        $request->session()->invalidate();
        
       // return view('/third'); for laravel
        return redirect('/authorize/login');
    }
}

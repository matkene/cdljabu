<?php

namespace App\Http\Controllers;
use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\Mail\JobPosted;


use Illuminate\Http\Request;

class JobController extends Controller
{
    //
    public function index()
    {
        //$jobs =Job::with('employer')->get();  //relationship implemented called eager loading minimise no of sql queries

    //$jobs =Job::all();  //lazy loading  will trigger error

        $jobs =Job::with('employer')->latest()->paginate(4);  //relationship implemented called eager loading minimise no of sql queries
        return view('first', [
            'jobs' => $jobs
            ]);
    }

    public function show(Job $job)
    {
        //For Route Model Binding
           
    //\Illuminate\Support\Arr::first($jobs, function ($job) use ($id){ return $job['id'] == $id;
      //$job =  \Illuminate\Support\Arr::first($jobs, fn($job) => $job['id']==$id);
      //$job =  Arr::first(Job::all(), fn($job) => $job['id']==$id);
     // $job =  Job::find($id);
        return view('second', ['job'=> $job]);   
    }

    public function edit(Job $job)
    {
       

        
       // Gate::authorize('edit-job', $job);
        /* 
        if(Auth::guest()){
            return redirect('/login');
        } */

        //return if($job->employer->user->isNot(Auth::user()){abort(403)};
         
        

        return view('fourth', ['job'=> $job]);
    }

    public function update(Job $job)
    {
        request()->validate(
            [
                'title' => ['required','min:3'],
                'salary'=>  ['required'],
        
            ]
            );
           //authorize
           //update the item
           //$job =  Job::findOrFail($id); // In case there is no id to throw Null
            
           //and persist
           $job ->update([
            'title'=> request('title'),
            'salary'=> request('salary'),
           ]);
           // redirect
           return redirect('/first/'.$job->id)->with('status','Updated Successfully');

           

    }

    public function destroy(Job $job)
    {
        //authorize
    // delete the request
   // $job =  Job::findOrFail($id); 
    $job ->delete();
    // Job::findorFail($id)->delete();
    //redirect   

   return redirect('/first')->with('status','Deleted Successfully');     

    }

    public function create()
    {
        return view('third');
    }

    public function store(Job $job)
    {
        //Helpers
     request()->validate(
        [
            'title' => ['required','min:3'],
            'salary'=>  ['required'],

        ]);

     $job= Job::create(
        [
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1
        ]);

        // Laravel will pick the email from user 
        //Due to delay in time to deliver the email, we use queue
        //Mail::to($job->employer->user)  ->send(new JobPosted($job));
    Mail::to($job->employer->user)
    ->queue(new JobPosted($job));
    
        return redirect('/first')->with('status','Job Created Successfully');
    }
}

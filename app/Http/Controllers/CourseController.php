<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Programme;
use App\Models\Term;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $courses = Course::with('programme')->with('term')->paginate(10);

        $programmes = Programme::all();
        $terms = Term::all();
        return view('admin.course.index', ['courses'=> $courses,'programmes' => $programmes, 'terms'=>$terms]);


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Course $course, Programme $programme)
    {
        //
         //
         $programmes = Programme::all();
         $terms = Term::all();
         return view('admin.course.create', ['course'=> $course,'programmes' => $programmes, 'terms'=>$terms]);
        }

    /**
     * Store a newly created resource in storage.
     */
    // To create a single course
    public function store(Request $request, Course $course)
    {
        //
        //dd($request);
        $request->validate(
            [            
            'programme_id'=>['required'],
            'crsid'=>['required'] ,
            'crsdesc'=>['required'] ,
            'unit'=> ['required'] ,
            'level'=> ['required'] ,
            'remark'=> ['required'] ,
            'term_id'=> ['required'] ,
            'semester'=> ['required'],            
              ]);
        $status =1;
        
        Course::create(
            [
            'programme_id'=>$request->input('programme_id'),
            'crsid'=>$request->input('crsid'),
            'crsdesc'=>$request->input('crsdesc'),
            'unit'=>$request->input('unit'),
            'level'=>$request->input('level'),
            'remark'=>$request->input('remark'),
            'term_id'=>$request->input('term_id'),
            'status'=>$status,
            'user_id'=>$status,
            'semester'=>$request->input('semester'),
           ]);

         return redirect('admin/course')->with('message','Course created Successfully');  
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
        $programmes = Programme::all();
        $terms = Term::all();
        return view('admin/course/show', ['course'=> $course, 'programmes' => $programmes, 'terms'=>$terms]); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {

        //
        $programmes = Programme::all();
        $terms = Term::all();
        return view('admin/course/edit', ['course'=> $course, 'programmes' => $programmes, 'terms'=>$terms]);  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //dd($request);
        
        request()->validate(
            [
                'programme_id'=>['required'],
                'crsid'=>['required'] ,
                'crsdesc'=>['required'] ,
                'unit'=> ['required'] ,
                'level'=> ['required'] ,
                'remark'=> ['required'] ,
                'term_id'=> ['required'] ,
                'semester'=> ['required'],         
        
            ] );  
                                
          
           $status =1;
           $course->update(
            [
            'programme_id'=>$request->input('programme_id'),
            'crsid'=>$request->input('crsid'),
            'crsdesc'=>$request->input('crsdesc'),
            'unit'=>$request->input('unit'),
            'level'=>$request->input('level'),
            'remark'=>$request->input('remark'),
            'term_id'=>$request->input('term_id'),
            'status'=>$status,
            'user_id'=>1,
            'semester'=>$request->input('semester'),
           ]);

           //dd($course);
           // redirect
           return redirect('/admin/course')->with('message','Course Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
}

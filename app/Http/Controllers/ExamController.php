<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //$exams = Exam::orderBy('created_at','desc')->latest()->paginate(10);
        $exams = Exam::all();

        return view('admin.exam.index',['exams' => $exams]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.exam.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Exam $exam)
    {
        //
        $request->validate([
            'name' => 'required|unique:exams|min:3',
        ]);

        Exam::create(
            [
                'name'=> $request->name
            ]);

        return redirect('/admin/exam')->with('message','Exam created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        //
        
        return view('admin/exam/show',['exam'=>$exam]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        //
        
        return view('admin/exam/edit', ['exam'=>$exam]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exam $exam)
    {
        //
        $request->validate(
            [
               'name' => 'required|unique:exams|min:3',
            ]);

        $exam->update(
           [
                'name'=> $request->name
           ]);

        return redirect('admin/exam')->with('message','Exam updated succesfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        //
        $exam->delete();

        return redirect('/admin/exam')->with('mesaage','Exam deleted succesfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $subjects = Subject::all();
        return view('admin.subject.index', ['subjects'=>$subjects]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.subject.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Subject $subject)
    {
        //
        $request->validate([
            
             'name' => 'required|unique:subjects|min:3',
        ]);

        Subject::create([
         'name'=> $request->name,
        ]);

        return redirect('admin/subject')->with('message','Subject created Successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        //
        //$subject->update($request->all());
        return view('admin.subject.show', ['subject' => $subject]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        //
        return view('admin.subject.edit', ['subject'=>$subject]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        //
        $request->validate(
            [
                'name' => 'required|unique:subjects|min:3',
            ]);

        $subject->update(
            [
             "name"=> $request->name,
            ]);

        return redirect('admin/subject')->with('message','Subject updated Successfully');

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        //
        $subject->delete();
        return redirect('admin/subject')->with('message','Subject deleted Successfully');
        
    }
}

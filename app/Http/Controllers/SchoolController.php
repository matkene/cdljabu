<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;

class SchoolController extends Controller
{
    //
    public function index()
    {
        //
        $schools = School::all();
        return view('admin.school.index',  ['schools' => $schools]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.school.create');
    }

    public function store(Request $request, School $school)
    {
        //
        $request->validate(
            [
                'name' => 'required|unique:schools|min:3', 
                'code' => 'required|unique:schools|min:3', 
            ]);

            School::create(
            [
                'name'=> $request->name,
                'code'=> $request->code,
            ]);

        return redirect('/admin/school')->with('message','School created Successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(School $school)
    {
        //
        return view('admin.school.show', ['school' => $school]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(School $school)
    {
        //
        return view('admin/school/edit', ['school' => $school]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, School $school)
    {
        $request->validate(
            [
                'name' => 'required|min:3', 
                'code' => 'required|min:3', 
            ]);

         $school->update(
             [ 
                'name'=> $request->name,
                'code'=> $request->code
             ]);
        return redirect('/admin/school')->with('message','School updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(School $school)
    {
        //
        $school->delete();
        return redirect('/admin/school')->with('message','School deleted Successfully');
    }

}

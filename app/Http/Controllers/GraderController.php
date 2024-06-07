<?php

namespace App\Http\Controllers;

use App\Models\Grader;
use Illuminate\Http\Request;

class GraderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $graders = Grader::all();

        return view('admin.grader.index', ['graders' => $graders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Grader $grader)
    {
        //
        return view('admin.grader.create',['grader' => $grader]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Grader $grader)
    {
        //
        $request->validate(
            [
               'name' => ['required','string','min:2'],
               'point' => ['required'],
            ]);

        Grader::create(
            [
              'name'=> $request->name,
              'point' => $request->point
            ]);

            return redirect('admin/grader')->with('message','Grader created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Grader $grader)
    {
        //
        return view('admin/grader/show', ['grader'=> $grader]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grader $grader)
    {
        //
        return view('admin/grader/edit', ['grader'=> $grader]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grader $grader)
    {
        //
        $request->validate(
            [
               'name' => ['required','string','min:2'],
               'point' => ['required'],
            ]);

        $grader->update(
            [
             'name' => $request->name,
             'point' => $request->point
            ]);

          
            return redirect('admin/grader')->with('message','Grader updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grader $grader)
    {
        //
        $grader->delete();

        return redirect('admin/grader')->with('message','Grader deleted Succesfully');
    }
}

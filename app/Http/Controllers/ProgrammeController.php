<?php

namespace App\Http\Controllers;

use App\Models\Programme;
use App\Models\School;

use Illuminate\Http\Request;

class ProgrammeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    //
    $programmes = Programme::with('school')->latest()->paginate(10);
    //$jobs =Job::with('employer')->latest()->paginate(4); 
     
    //$lgas = Lga::all();

   // dd($lgas);
    $schools = School::all();
    return view('admin.programme.index', ['programmes'=> $programmes,'schools' => $schools]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Programme $programme, School $school)
    {
        //
        $schools = School::all();
        return view('admin.programme.create', ['programme'=> $programme, 'schools' => $schools]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Programme $programme)
    {
        //
        $request ->validate(
            [
               'progdesc' => 'required|unique:programmes|min:3',
               'department' => 'required|unique:programmes|min:3',
               'school_id' => ['required'],
            ]);

         Programme::create(
            [
                'school_id'=> $request->school_id,
                'progdesc'=> $request->progdesc,
                'department'=> $request->department,
            ]);
            

          return redirect('/admin/programme')->with('message', 'Programme created Successfully');  
    }

    /**
     * Display the specified resource.
     */
    public function show(Programme $programme)
    {
        //
        return view('admin.programme.show', ['programme' => $programme]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Programme $programme)
    {
        //
        $schools = School::all();
        return view('admin/programme/edit', ['programme' => $programme, 'schools' => $schools]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Programme $programme)
    {
        //
        //
        $request->validate(
            [
                'progdesc'=> ['required','string','min:3'],
                'department'=> ['required','string','min:3'],
                'school_id' => ['required'],
            ]);

        $programme->update(
            [
              'progdesc' => $request->progdesc,
              'department' => $request->department,
              'school_id'=> $request->school_id
            ]);
        return redirect('admin/programme')->with('message','Programme updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Programme $programme)
    {
        //
        $programme->delete();
        return redirect('admin/programme')->with('message','Programme deleted Successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Marital;
use Illuminate\Http\Request;

class MaritalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $maritals = Marital::all();
        return view('admin.marital.index',  ['maritals' => $maritals]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.marital.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Marital $marital)
    {
        //
        $request->validate(
            [
               'name' => ['required','string','min:3'],
            ]);

        Marital::create(
            [
                'name'=> $request->name,
            ]);

        return redirect('/admin/marital')->with('message','Marital created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Marital $marital)
    {
        //
        return view('admin.marital.show', ['marital' => $marital]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Marital $marital)
    {
        //
        return view('admin/marital/edit', ['marital' => $marital]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Marital $marital)
    {
        //
        $request->validate(
            [
               'name' => ['required','string','min:3'],
            ]);

         $marital->update(
             [ 
                'name'=> $request->name
             ]);
        return redirect('/admin/marital')->with('messsage','Marital updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marital $marital)
    {
        //
        $marital->delete();
        return redirect('/admin/marital')->with('message','Marital deleted Successfully');
    }
}

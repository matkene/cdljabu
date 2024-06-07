<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use Illuminate\Http\Request;

class GenderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $genders = Gender::all();
        return view('admin.gender.index', ['genders'=> $genders]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.gender.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Gender $gender)
    {
        //
        $request->validate(
            [
                'name' => 'required|unique:genders|min:2',
            ]);

        Gender::create(
            [
                'name'=> $request->name,
            ]);

            return redirect('admin/gender')->with('message','Gender created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Gender $gender)
    {
        //
        return view('admin.gender.show', ['gender' => $gender]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gender $gender)
    {
        //
        
        return view('admin/gender/edit', ['gender'=> $gender]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gender $gender)
    {
        //
        $request->validate(
            [
                'name' => 'required|min:2',
            ]);
        
        $gender->update(
           [
                'name' => $request->name,
           ]);
        return redirect('admin/gender')->with('message', 'Gender updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gender $gender)
    {
        //
        $gender->delete();
        return redirect('admin/gender')->with('message','Gender deleted succesfully');
        
    }
}

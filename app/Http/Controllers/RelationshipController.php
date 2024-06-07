<?php

namespace App\Http\Controllers;

use App\Models\Relationship;
use Illuminate\Http\Request;

class RelationshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $relationships = Relationship::all();
        return view('admin.relationship.index',  ['relationships' => $relationships]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.relationship.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Relationship $relationship)
    {
        //
        $request->validate(
            [
               'name' => ['required','string','min:3'],
            ]);

            Relationship::create(
            [
                'name'=> $request->name,
            ]);
        
         return redirect('/admin/relationship')->with('message','Relationship created Successfully');


    }

    /**
     * Display the specified resource.
     */
    public function show(Relationship $relationship)
    {
        //
        return view('admin.relationship.show', ['relationship' => $relationship]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Relationship $relationship)
    {
        //
        return view('admin.relationship.edit', ['relationship' => $relationship]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Relationship $relationship)
    {
    
       //
       $request->validate(
        [
           'name' => ['required','string','min:3'],
        ]);

     $relationship->update(
         [ 
            'name'=> $request->name
         ]);

        return redirect('/admin/relationship')->with("message","Relationship updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Relationship $relationship)
    {
        //
        $relationship->delete();
        return redirect('/admin/relationship')->with("message","Relationship deleted Successfully");
    }
}

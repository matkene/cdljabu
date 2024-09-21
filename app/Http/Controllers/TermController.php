<?php

namespace App\Http\Controllers;

use App\Models\Term;
use Illuminate\Http\Request;

class TermController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $terms = Term::all();
        return view('admin.term.index', ['terms'=> $terms]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Term $term)
    {
        //
        return view('admin.term.create',['term'=>$term]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Term $term)
    {
        //
        $request->validate([
          'name'=> 'required|unique:terms|min:3',
          'status'=> 'required|min:3',
        ]);

        Term::create([
         'name'=> $request->name,
         'status'=> $request->status,
        ]);

     
        return redirect('admin/term')->with('message','Term created Successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Term $term)
    {
        //
       // $terms = $term->terms()->create($request->all());
        return view('admin.term.show', ['term' => $term]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Term $term)
    {
        //
        
        return view('admin.term.edit', ['term'=> $term]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Term $term)
    {
        //
        $request->validate([
            'name'=> ['required','string','min:3'],
            'status'=> ['required','string','min:3'],
        ]);

        $term->update(
           [
            'name' => $request->name,
            'status' => $request->status
           
           ]);

        return redirect('admin/term/')->with('message','Term updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Term $term)
    {
        //
        $term->delete();
        return redirect('admin/term')->with('status','Term deleted Successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Title;
use Illuminate\Http\Request;

class TitleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $titles = Title::all();
        return view('admin.title.index', ['titles' => $titles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.title.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Title $title)
    {
        //
        //dd($request);
        $request->validate([
             'name'=> ['required','string','min:2']
        ]);

        Title::create(
        [
           'name'=> $request->name
        ]);

        return redirect('/admin/title')->with('message','Title created Successfully');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Title $title)
    {
        //
        
        return view('admin.title.show', ['title'=> $title]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Title $title)
    {
        //
        return view('admin.title.edit', ['title'=> $title]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Title $title)
    {
        //
        $request->validate([
               'name'=> ['required','string','min:2']
        ]);
        $title->update(
           [ 
            'name' => $request->name
           
           ]);

        return redirect('/admin/title')->with('message','Title updated Succesfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Title $title)
    {
        //
        $title->delete();
        return redirect()->route("")->with("success","");
    }
}

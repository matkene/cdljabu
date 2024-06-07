<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Religion;

class ReligionController extends Controller
{
    //
    public function index()
    {
        //
        $religions = Religion::all();
        return view('admin.religion.index',  ['religions' => $religions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.religion.create');
    }

    public function store(Request $request, Religion $religion)
    {
        //
        $request->validate(
            [
               'name' => ['required','string','min:3'],
            ]);

            Religion::create(
            [
                'name'=> $request->name,
            ]);

        return redirect('/admin/religion')->with('message','Religion created Successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Religion $religion)
    {
        //
        return view('admin.religion.show', ['religion' => $religion]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Religion $religion)
    {
        //
        return view('admin/religion/edit', ['religion' => $religion]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Religion $religion)
    {
        $request->validate(
            [
               'name' => ['required','string','min:3'],
            ]);

         $religion->update(
             [ 
                'name'=> $request->name
             ]);
        return redirect('/admin/religion')->with('message','Religion updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Religion $religion)
    {
        //
        $religion->delete();
        return redirect('/admin/religion')->with('message','Religion deleted Successfully');
    }

}

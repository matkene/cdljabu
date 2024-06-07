<?php

namespace App\Http\Controllers;

use App\Models\Mode;
use Illuminate\Http\Request;

class ModeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $modes = Mode::all();
        return view('admin.mode.index',  ['modes' => $modes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Mode $mode)
    {
        //
        //dd($mode);
        return view('admin.mode.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Mode $mode)
    {
      
       $request->validate(
        [
           'name' => ['required','string','min:3'],
        ]);

    Mode::create(
        [
            'name'=> $request->name,
        ]);


        return redirect('/admin/mode')->with('message','Mode created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mode $mode)
    {
        //
        return view('admin.mode.show', ['mode' => $mode]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mode $mode)
    {
        //
        return view('admin/mode/edit', ['mode' => $mode]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mode $mode)
    {
        //
       //
       $request->validate(
        [
           'name' => ['required','string','min:3'],
        ]);

     $mode->update(
         [ 
            'name'=> $request->name
         ]);
         return redirect('/admin/mode')->with('message','Mode updated Successfully');
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mode $mode)
    {
        //
        $mode->delete();
        return redirect('/admin/mode')->with("message","Mode deleted Successfully");
    }
}

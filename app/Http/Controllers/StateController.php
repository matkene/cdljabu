<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $states = State::all();
        return view('admin.state.index',  ['states' => $states]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(State $state)
    {
        //
        return view('admin.state.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, State $state)
    {
        //
        $request->validate(
            [
               'name' => ['required','string','min:3'],
            ]);

        State::create(
            [
                'name'=> $request->name,
            ]);

        return redirect('/admin/state')->with('message','State created Successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(State $state)
    {
        //
        return view('admin.state.show', ['state' => $state]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(State $state)
    {
        //
        return view('admin/state/edit', ['state' => $state]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, State $state)
    {
        $request->validate(
            [
               'name' => ['required','string','min:3'],
            ]);

         $state->update(
             [ 
                'name'=> $request->name
             ]);
        return redirect('/admin/state')->with('message','State updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(State $state)
    {
        //
        $state->delete();
        return redirect('/admin/state')->with('message','State deleted Successfully');
    }
}

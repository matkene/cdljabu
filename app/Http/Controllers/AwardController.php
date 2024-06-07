<?php

namespace App\Http\Controllers;

use App\Models\Award;
use Illuminate\Http\Request;


class AwardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $awards = Award::all();
        return view("", compact(""));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $award = Award::create($request->all());
        return redirect()->route("")->with("success","");
    }

    /**
     * Display the specified resource.
     */
    public function show(Award $award)
    {
        //
        $awards = Award::where("", $award->id)->get();
        return view("", compact(""));


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Award $award)
    {
        //
        $award = Award::find($award->id);
        return view("", compact(""));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Award $award)
    {
        //
        $award->update($request->all());
        return redirect()->route("")->with("success","");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Award $award)
    {
        //
        $award->delete();
        return redirect()->route("")->with("success","");
        
    }
}

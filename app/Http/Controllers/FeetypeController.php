<?php

namespace App\Http\Controllers;

use App\Models\Feetype;
use Illuminate\Http\Request;

class FeetypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $feetypes = Feetype::all();
        return view("", compact(""));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

    }

    /**
     * Display the specified resource.
     */
    public function show(Feetype $feetype)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feetype $feetype)
    {
        //
        $feetypes = Feetype::all();
        return view("", compact(""));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feetype $feetype)
    {
        //
        $feetype->update($request->all());
        return redirect()->route("")->with("success","");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feetype $feetype)
    {
        //
        $feetype->delete();
        return redirect()->route("")->with("success","");
    }
}

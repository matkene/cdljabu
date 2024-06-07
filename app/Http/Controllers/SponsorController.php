<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\Request;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $sponsors = Sponsor::all();
        return view('admin.sponsor.index',  ['sponsor' => $sponsors]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.sponsor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Sponsor $sponsor)
    {
        //
        $sponsor->validate(
            [
               'name' => ['required','string','min:3'],
            ]);

            Sponsor::create(
            [
                'name'=> $request->name,
            ]);

        return redirect('/admin/sponsor')->route("")->with("status",'Sponsor created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sponsor $sponsor)
    {
        //
        return view('admin.sponsor.show', ['sponsor' => $sponsor]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sponsor $sponsor)
    {
        //
        return view('admin.sponsor.edit', ['sponsor' => $sponsor]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sponsor $sponsor)
    {
      //
      $sponsor->validate(
        [
           'name' => ['required','string','min:3'],
        ]);

     $sponsor->update(
         [ 
            'name'=> $request->name
         ]);

        return redirect('/admin/sponsor')->with("status","Sponsor updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sponsor $sponsor)
    {
        //
        $sponsor->delete();
        return redirect('/admin/sponsor')->with("success","Sponsor deleted Successfully");
    }
}

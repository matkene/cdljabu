<?php

namespace App\Http\Controllers;

use App\Models\Lga;
use App\Models\State;

use Illuminate\Http\Request;

class LgaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $lgas = Lga::with('state')->paginate(10);
        //$jobs =Job::with('employer')->latest()->paginate(4); 
         
        //$lgas = Lga::all();

       // dd($lgas);
        $states = State::all();
        return view('admin.lga.index', ['lgas'=> $lgas,'states' => $states]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Lga $lga, State $state)
    {
        //
        $states = State::all();
        return view('admin.lga.create', ['lga'=> $lga, 'states' => $states]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Lga $lga )
    {
        //
        $request ->validate(
            [
               'name' => ['required','string','min:3'],
               'state_id' => ['required'],
            ]);

         Lga::create(
            [
                'name'=> $request->name,
                'state_id'=> $request->state_id,
            ]);

          return redirect('/admin/lga')->with('message', 'Lga created Successfully');  

    }

    /**
     * Display the specified resource.
     */
    public function show(Lga $lga)
    {
        //
        
        return view('admin.lga.show', ['lga' => $lga]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lga $lga)
    {
        //
        $states = State::all();
        return view('admin/lga/edit', ['lga' => $lga, 'states' => $states]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lga $lga)
    {
        //dd(request());
        $request->validate(
            [
                'name'=> ['required','string','min:3'],
                'state_id' => ['required'],
            ]);

        $lga->update(
            [
              'name' => $request->name,
              'state_id'=> $request->state_id
            ]);
        return redirect('admin/lga')->with('message','Lga updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lga $lga)
    {
        //
        $lga->delete();
        return redirect('admin/lga')->with('message','Lga deleted Successfully');
    }
}

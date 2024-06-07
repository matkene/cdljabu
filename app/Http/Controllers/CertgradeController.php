<?php

namespace App\Http\Controllers;

use App\Models\Certgrade;
use Illuminate\Http\Request;

class CertgradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $certgrades = Certgrade::all();
        return view('admin.certgrade.index',['certgrades' => $certgrades]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.certgrade.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Certgrade $certgrade)
    {
        //
        $request->validate(
            [
                'name' => 'required|unique:certgrades|min:1',
            ]
            );
    
            Certgrade::create(
            [
                'name' => request('name'),
                
            ]); 
            
            
        return redirect('admin/certgrade')->with('message','Certgrade created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Certgrade $certgrade)
    {
        //

        return view('admin/certgrade/show', ['certgrade'=> $certgrade]);  

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Certgrade $certgrade)
    {
        //
        
        return view('admin/certgrade/edit', ['certgrade'=> $certgrade]);  

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Certgrade $certgrade)
    {
        //
        request()->validate(
            [
                'name' => 'required|min:1',             
        
            ]
            );                       
          
           $certgrade ->update([
            'name'=> request('name'),
            
           ]);
           // redirect
           return redirect('/admin/certgrade')->with('meesage','Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Certgrade $certgrade)
    {
        //
        $certgrade->delete();
        return redirect('/admin/certgrade')->with('meesage','Certgrade deleted successfully');
    }
}

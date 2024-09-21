<?php

namespace App\Http\Controllers;

use App\Models\Bloodgroup;
use Illuminate\Http\Request;

class BloodgroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $bloodgroups = Bloodgroup::all();
        return view('admin.bloodgroup.index', ['bloodgroups' => $bloodgroups]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
       
        return view('admin.bloodgroup.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Bloodgroup $bloodgroup)
    {
       // dd($request);
        
     request()->validate(
        [
            'name' => 'required|unique:bloodgroups|min:1',
                    ]
        );

     Bloodgroup::create(
        [
            'name' => request('name'),
            
        ]);  


      // $bloodgroup = Bloodgroup::create($data);

       return redirect('admin/bloodgroup/')->with('message','Bloodgroup created successfully');
      // return redirect()->route('dashboard')->with('success', 'Item successfully created!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Bloodgroup $bloodgroup)
    {
        //dd($request);
        //$bloodgroup = Bloodgroup::create($request->all());
        return view('admin/bloodgroup/show', ['bloodgroup' => $bloodgroup]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bloodgroup $bloodgroup)
    {
        
        //dd($request);
       
        return view('admin/bloodgroup/edit', ['bloodgroup'=> $bloodgroup]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bloodgroup $bloodgroup)
    {
        //dd($request);
        request()->validate(
            [
                'name' => 'required|unique:bloodgroups|min:1',             
        
            ]
            );
           
           $bloodgroup->update([
            'name'=> request('name'),           
           ]);

           return redirect('/admin/bloodgroup')->with('message','Bloodgroup updated Successfully');
           

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,Bloodgroup $bloodgroup)
    {
        //dd($request);
        $bloodgroup->delete();
        return redirect('/admin/bloodgroup')->with('message', 'Bloodgroup deleted Successfully');
    }
}

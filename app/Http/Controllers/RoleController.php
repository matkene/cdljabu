<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $roles = Role::all();
        return view('admin.role.index',  ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Role $role)
    {
        //
        //
        $request->validate(
            [
               'name' => ['required','string','min:3'],
            ]);

            Role::create(
            [
                'name'=> $request->name,
            ]);
        
         return redirect('/admin/role')->with('status','Role created Successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
        return view('admin.role.show', ['role' => $role]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
        return view('admin.role.edit', ['role' => $role]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //
        $request->validate(
        [
           'name' => ['required','string','min:3'],
        ]);

     $role->update(
         [ 
            'name'=> $request->name
         ]);

        return redirect('/admin/role')->with("message","Role updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
        $role->delete();
        return redirect('/admin/role')->with('status','Role deleted Successfully');
    }
}

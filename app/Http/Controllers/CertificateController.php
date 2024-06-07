<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $certificates = Certificate::all();
        return view('admin.certificate.index',['certificates' => $certificates]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.certificate.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Certificate $certificate) 
    {
        //
        $certificate->validate(
        [
            'name' => ['required', 'min:3'],
        ]
        );
        
        Certificate::create(
            [
            'name' => $request->name
            ]
        );

        return redirect('admin/certificate')->with('message', 'Certficate created Successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Certificate $certificate)
    {
        //

        return view('admin/certificate/show', ['certificate'=> $certificate]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Certificate $certificate)
    {
        //
        
        return view('admin.certificate.edit', ['certificate' => $certificate]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Certificate $certificate)
    {
        //
        $request->validate(
            [
                'name'=> ['required','min:3'],
            ]
            );
        $certificate->update(
            [
                 'name' => $request->name
            ]);
        return redirect('/admin/certificate')->with('message','Certificate Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Certificate $certificate)
    {
        //
        $certificate->delete();
        return redirect('/admin/certificate')->with('message','Certificate deleted successfully');
    }
}

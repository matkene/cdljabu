<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $fees = Fee::with('Programme')->latest()->paginate(10);

        return view('admin.fee.index', ['fee' => $fees]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Fee $fee)
    {
        //
        return view('admin.fee.create', ['fee' => $fee]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Fee $fee)
    {
        //
        $fee->validate(
            [
                'programme_id' => ['required'],
                'term_id' => ['required'],
                'level'  => ['required'],
                'type'  => ['required'],
                'item' => ['required', 'min:6'],
                'amount' => ['required','num'],
                
            ]);

            Fee::create(
                [
                  'programme_id' => $request->name,  
                  'term_id' => $request->term_id,
                  'level' => $request->level,
                  'type' => $request->type,
                  'item' => $request->item, 
                  'amount' => $request->amount, 
                ]);

        return redirect('admin/fee')->with('status', 'Fee created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fee $fee)
    {
        //
        return view('admin/fee/show', ['fee'=> $fee]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fee $fee)
    {
        //
        return view('admin/fee/edit', ['fee'=> $fee]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fee $fee)
    {
        //
        $fee->validate(
            [
                'programme_id' => ['required'],
                'term_id' => ['required'],
                'level'  => ['required'],
                'type'  => ['required'],
                'item' => ['required', 'min:6'],
                'amount' => ['required','num'],
            ]);

           $fee->update(
            [
                'programme_id' => $request->name,  
                  'term_id' => $request->term_id,
                  'level' => $request->level,
                  'type' => $request->type,
                  'item' => $request->item, 
                  'amount' => $request->amount, 
            ]);
            
            return redirect('admin/fee')->with('status', 'Fee Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fee $fee)
    {
        //
        $fee->delete();

        return redirect('admin/fee')->with('status','Fee deleted successfully');
    }
}

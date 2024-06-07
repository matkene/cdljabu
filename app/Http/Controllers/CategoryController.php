<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Category::all();
        return view('admin.category.index',['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Category $category)
    {
        //
        $request->validate(
            [
                'name' => 'required|unique:categories|min:1',
            ]
            );
    
            Category::create(
            [
                'name' => request('name'),
                
            ]); 
            
            
        return redirect('admin/category')->with('message','Category created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //

        return view('admin/category/show', ['category'=> $category]);  

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
        
        return view('admin/category/edit', ['category'=> $category]);  

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
        request()->validate(
            [
                'name' => 'required|min:1',             
        
            ]
            );                       
          
           $category ->update([
            'name'=> request('name'),
            
           ]);
           // redirect
           return redirect('/admin/category')->with('meesage','Category updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
        $category->delete();
        return redirect('/admin/category')->with('meesage','Category deleted successfully');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubCategoryRequest;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Subcategory::with('category')->latest()->get();
        return view('admin.subcategories.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.subcategories.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubCategoryRequest $request)
    {
        $request['name']=['en'=>$request->name_en,'ar'=>$request->name_ar,'fr'=>$request->name_fr,'es'=>$request->name_es,'ru'=>$request->name_ru];
        Subcategory::create($request->except([
            'name_en',
            'name_ar',
            'name_fr',
            'name_es',
            'name_ru',
        ]));


        return redirect()->route('admin.subcategories.index')
                        ->with('success','Subcategory has been added successfully');
    }



    public function show(string $id)
    {
        $subcategory = Subcategory::with('category')->findOrFail($id);
        return view('admin.subcategories.show',compact('subcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subcategory = Subcategory::with('category')->findOrFail($id);
        $categories = Category::all();
        return view('admin.subcategories.edit',compact('subcategory','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubCategoryRequest $request, string $id)
    {
        $subcategory = Subcategory::findOrFail($id);

        $request['name']=['en'=>$request->name_en,'ar'=>$request->name_ar,'fr'=>$request->name_fr,'es'=>$request->name_es,'ru'=>$request->name_ru];
        $subcategory->update($request->except([
            'name_en',
            'name_ar',
            'name_fr',
            'name_es',
            'name_ru',
        ]));


        return redirect()->route('admin.subcategories.index')
                        ->with('success','Subcategory has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Subcategory::findOrFail($request->id)->delete();
        return redirect()->route('admin.subcategories.index')->with('success','Subcategory has been removed successfully');
    }
}

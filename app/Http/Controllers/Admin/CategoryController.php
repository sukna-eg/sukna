<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\CategoryRequest;

class CategoryController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::all();
        return view('admin.categories.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $request['name']=['en'=>$request->name_en,'ar'=>$request->name_ar];
        Category::create($request->except([
            'name_en',
            'name_ar',

        ]));


        return redirect()->route('admin.categories.index')
                        ->with('success','Category has been added successfully');
    }



    public function show(string $id)
    {
        $category = Category::with('subcategories')->findOrFail($id);
        return view('admin.categories.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $category = Category::findOrFail($id);
        if ($request->has('image')&&$category->image  && File::exists($category->image)) {
            unlink($category->image);
        }
        $request['name']=['en'=>$request->name_en,'ar'=>$request->name_ar];
        $category->update($request->except([
            'name_en',
            'name_ar',

        ]));


        return redirect()->route('admin.categories.index')
                        ->with('success','Category has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Category::findOrFail($request->id)->delete();
        return redirect()->route('admin.categories.index')->with('success','Category has been removed successfully');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\CityRequest;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Service::latest()->get();
        return view('admin.services.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Category::all();
        return view('admin.services.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request['name']=['en'=>$request->name_en,'ar'=>$request->name_ar];
        $request['description']=['en'=>$request->description_en,'ar'=>$request->description_ar];

        $service = Service::create($request->except([

            'name_en',
            'name_ar',
            'description_en',
            'description_ar'
        ]));



        return redirect()->route('admin.services.index')
                        ->with('success','Service has been added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $service = Service::with('projects')->findOrFail($id);
        return view('admin.services.show',compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::all();
        $service = Service::with('projects')->findOrFail($id);
        return view('admin.services.edit',compact('service','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $service = Service::findOrFail($id);


        $request['name']=['en'=>$request->name_en,'ar'=>$request->name_ar];
        $request['description']=['en'=>$request->description_en,'ar'=>$request->description_ar];

        $service->update($request->except([

            'name_en',
            'name_ar',
            'description_en',
            'description_ar'

        ]));


        return redirect()->route('admin.services.index')
                        ->with('success','Service has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Service::findOrFail($request->id)->delete();
        return redirect()->route('admin.services.index')->with('success','Service has been removed successfully');
    }
}

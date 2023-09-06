<?php

namespace App\Http\Controllers\Admin;

use App\Models\Smart;
use App\Models\Project;
use App\Models\Work;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\CityRequest;

class SmartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Smart::latest()->get();
        return view('admin.smarts.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        return view('admin.smarts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request['name']=['en'=>$request->name_en,'ar'=>$request->name_ar];
        $request['description']=['en'=>$request->description_en,'ar'=>$request->description_ar];

        $smart = Smart::create($request->except([

            'name_en',
            'name_ar',
            'description_en',
            'description_ar'
        ]));



        return redirect()->route('admin.smarts.index')
                        ->with('success','Smart has been added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $smart = Smart::with('works')->findOrFail($id);
        return view('admin.smarts.show',compact('smart'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $smart = Smart::with('works')->findOrFail($id);
        return view('admin.smarts.edit',compact('smart'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $smart = Smart::findOrFail($id);


        $request['name']=['en'=>$request->name_en,'ar'=>$request->name_ar];
        $request['description']=['en'=>$request->description_en,'ar'=>$request->description_ar];

        $service->update($request->except([

            'name_en',
            'name_ar',
            'description_en',
            'description_ar'

        ]));


        return redirect()->route('admin.smarts.index')
                        ->with('success','Smart has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Smart::findOrFail($request->id)->delete();
        return redirect()->route('admin.smarts.index')->with('success','Smart has been removed successfully');
    }
}

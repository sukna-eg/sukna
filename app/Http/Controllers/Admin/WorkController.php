<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Models\Project;
use App\Models\Work;
use App\Models\Smart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\CityRequest;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Work::latest()->get();
        return view('admin.works.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $smarts = Smart::all();
        return view('admin.works.create',compact('smarts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request['name']=['en'=>$request->name_en,'ar'=>$request->name_ar];
        $request['description']=['en'=>$request->description_en,'ar'=>$request->description_ar];
        $request['duration']=['en'=>$request->duration_en,'ar'=>$request->duration_ar];

        $work = Work::create($request->except([

            'name_en',
            'name_ar',
            'description_en',
            'description_ar',
            'duration_en',
            'duration_ar'
        ]));



        return redirect()->route('admin.works.index')
                        ->with('success','Work has been added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $work = Work::findOrFail($id);
        return view('admin.works.show',compact('work'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $smarts = Smart::all();
        $work = Work::findOrFail($id);
        return view('admin.works.edit',compact('work','smarts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $work = Work::findOrFail($id);


        $request['name']=['en'=>$request->name_en,'ar'=>$request->name_ar];
        $request['description']=['en'=>$request->description_en,'ar'=>$request->description_ar];
        $request['duration']=['en'=>$request->duration_en,'ar'=>$request->duration_ar];

        $work->update($request->except([

            'name_en',
            'name_ar',
            'description_en',
            'description_ar',
            'duration_en',
            'duration_ar'

        ]));


        return redirect()->route('admin.works.index')
                        ->with('success','Work has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Work::findOrFail($request->id)->delete();
        return redirect()->route('admin.works.index')->with('success','Work has been removed successfully');
    }
}

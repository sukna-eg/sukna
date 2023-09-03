<?php

namespace App\Http\Controllers\Admin;

use App\Models\Help;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\EmergencyRequest;

class EmergencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Help::latest()->get();
        return view('admin.emergencies.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.emergencies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmergencyRequest $request)
    {
        $request['agency']=['en'=>$request->agency_en,'ar'=>$request->agency_ar,'fr'=>$request->agency_fr,'es'=>$request->agency_es,'ru'=>$request->agency_ru];
        Help::create($request->except([
            'agency_en',
            'agency_ar',
            'agency_fr',
            'agency_es',
            'agency_ru',
        ]));


        return redirect()->route('admin.emergencies.index')
                        ->with('success','Emergency has been added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $emergency = Help::findOrFail($id);
        return view('admin.emergencies.show',compact('emergency'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $emergency = Help::findOrFail($id);
        return view('admin.emergencies.edit',compact('emergency'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmergencyRequest $request, string $id)
    {
        $emergency = Help::findOrFail($id);
        if ($request->has('logo')&&$emergency->image  && File::exists($emergency->logo)) {
            unlink($emergency->logo);
        }
        $request['agency']=['en'=>$request->agency_en,'ar'=>$request->agency_ar,'fr'=>$request->agency_fr,'es'=>$request->agency_es,'ru'=>$request->agency_ru];
        $emergency->update($request->except([
            'agency_en',
            'agency_ar',
            'agency_fr',
            'agency_es',
            'agency_ru',
        ]));


        return redirect()->route('admin.emergencies.index')
                        ->with('success','Emergency has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Help::findOrFail($request->id)->delete();
        return redirect()->route('admin.emergencies.index')->with('success','Emergency has been removed successfully');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Area;
use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\CityRequest;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = City::latest()->get();
        return view('admin.cities.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityRequest $request)
    {

        $request['name']=['en'=>$request->name_en,'ar'=>$request->name_ar];

        $city = City::create($request->except([

            'name_en',
            'name_ar'
        ]));



        return redirect()->route('admin.cities.index')
                        ->with('success','City has been added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $city = City::with('areas')->findOrFail($id);
        return view('admin.cities.show',compact('city'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $city = City::with('areas')->findOrFail($id);
        return view('admin.cities.edit',compact('city'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CityRequest $request, string $id)
    {
        $city = City::findOrFail($id);


        $request['name']=['en'=>$request->name_en,'ar'=>$request->name_ar];

        $city->update($request->except([

            'name_en',
            'name_ar',

        ]));


        return redirect()->route('admin.cities.index')
                        ->with('success','City has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        City::findOrFail($request->id)->delete();
        return redirect()->route('admin.cities.index')->with('success','City has been removed successfully');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SectionRequest;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Section::latest()->get();
        return view('admin.sections.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SectionRequest $request)
    {
        $request['name']=['en'=>$request->name_en,'ar'=>$request->name_ar,'fr'=>$request->name_fr,'es'=>$request->name_es,'ru'=>$request->name_ru];
        Section::create($request->except([
            'name_en',
            'name_ar',
            'name_fr',
            'name_es',
            'name_ru',
        ]));

        return redirect()->route('admin.sections.index')
                        ->with('success','Section has been added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $section = Section::with('blogs')->findOrFail($id);
        return view('admin.sections.show',compact('section'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $section = Section::findOrFail($id);
        return view('admin.sections.edit',compact('section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SectionRequest $request, string $id)
    {
        $section = Section::findOrFail($id);

        $request['name']=['en'=>$request->name_en,'ar'=>$request->name_ar,'fr'=>$request->name_fr,'es'=>$request->name_es,'ru'=>$request->name_ru];
        $section->update($request->except([
            'name_en',
            'name_ar',
            'name_fr',
            'name_es',
            'name_ru',
        ]));


        return redirect()->route('admin.sections.index')
                        ->with('success','Section has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Section::findOrFail($request->id)->delete();
        return redirect()->route('admin.sections.index')->with('success','Section has been removed successfully');
    }
}

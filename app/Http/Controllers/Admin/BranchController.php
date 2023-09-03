<?php

namespace App\Http\Controllers\Admin;

use App\Models\Area;
use App\Models\Branch;
use App\Models\Partner;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\BranchRequest;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Branch::with('partner')->latest()->get();
        return view('admin.branches.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $partners = Partner::all();
        $areas = Area::all();
        return view('admin.branches.create',compact('partners','areas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BranchRequest $request)
    {
        $request['name']=['en'=>$request->name_en,'ar'=>$request->name_ar,'fr'=>$request->name_fr,'es'=>$request->name_es,'ru'=>$request->name_ru];
        Branch::create($request->except([
            'name_en',
            'name_ar',
            'name_fr',
            'name_es',
            'name_ru',
        ]));


        return redirect()->route('admin.branches.index')
                        ->with('success','Branch has been added successfully');
    }



    public function show(string $id)
    {
        $branch = Branch::with(['partner','area'])->findOrFail($id);
        return view('admin.branches.show',compact('branch'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $branch = Branch::with(['partner','area'])->findOrFail($id);
        $partners = Partner::all();
        $areas = Area::all();
        return view('admin.branches.edit',compact('branch','partners','areas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BranchRequest $request, string $id)
    {
        $branche = Branch::findOrFail($id);

        $request['name']=['en'=>$request->name_en,'ar'=>$request->name_ar,'fr'=>$request->name_fr,'es'=>$request->name_es,'ru'=>$request->name_ru];
        $branche->update($request->except([
            'name_en',
            'name_ar',
            'name_fr',
            'name_es',
            'name_ru',
        ]));


        return redirect()->route('admin.branches.index')
                        ->with('success','Branch has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Branch::findOrFail($request->id)->delete();
        return redirect()->route('admin.branches.index')->with('success','Branch has been removed successfully');
    }
}

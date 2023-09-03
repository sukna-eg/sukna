<?php

namespace App\Http\Controllers\Admin;

use App\Models\Advice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdviceRequest;

class AdviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Advice::latest()->get();
        return view('admin.advices.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.advices.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdviceRequest $request)
    {
        $request['body']=['en'=>$request->body_en,'ar'=>$request->body_ar,'fr'=>$request->body_fr,'es'=>$request->body_es,'ru'=>$request->body_ru];
        Advice::create($request->except([
            'body_en',
            'body_ar',
            'body_fr',
            'body_es',
            'body_ru',
        ]));


        return redirect()->route('admin.advices.index')
                        ->with('success','Advice has been added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $advice = Advice::findOrFail($id);
        return view('admin.advices.show',compact('advice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $advice = Advice::findOrFail($id);
        return view('admin.advices.edit',compact('advice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdviceRequest $request, string $id)
    {
        $advice = Advice::findOrFail($id);

        $request['body']=['en'=>$request->body_en,'ar'=>$request->body_ar,'fr'=>$request->body_fr,'es'=>$request->body_es,'ru'=>$request->body_ru];
        $advice->update($request->except([
            'body_en',
            'body_ar',
            'body_fr',
            'body_es',
            'body_ru',
        ]));


        return redirect()->route('admin.advices.index')
                        ->with('success','Advice has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Advice::findOrFail($request->id)->delete();
        return redirect()->route('admin.advices.index')->with('success','Advice has been removed successfully');
    }
}

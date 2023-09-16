<?php

namespace App\Http\Controllers\Admin;

use App\Models\Introduction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\IntroductionRequest;

class IntroductionController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Introduction::latest()->get();
        return view('admin.introductions.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.introductions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request['title']=['en'=>$request->title_en,'ar'=>$request->title_ar];

        $request['body']=['en'=>$request->body_en,'ar'=>$request->body_ar];
        Introduction::create($request->except([
            'title_en',
            'title_ar',
            'body_en',
            'body_ar',

        ]));


        return redirect()->route('admin.introductions.index')
                        ->with('success','Introduction has been added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $introduction = Introduction::findOrFail($id);
        return view('admin.introductions.show',compact('introduction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $introduction = Introduction::findOrFail($id);
        return view('admin.introductions.edit',compact('introduction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $introduction = Introduction::findOrFail($id);

        $request['title']=['en'=>$request->title_en,'ar'=>$request->title_ar];

        $request['body']=['en'=>$request->body_en,'ar'=>$request->body_ar];

        $introduction->update($request->except([
            'title_en',
            'title_ar',

            'body_en',
            'body_ar',

        ]));


        return redirect()->route('admin.introductions.index')
                        ->with('success','Introduction has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Introduction::findOrFail($request->id)->delete();
        return redirect()->route('admin.introductions.index')->with('success','Introduction has been removed successfully');
    }

    public function openFile($id)
    {
        $intro = Introduction::findOrFail($id);
        return response()->file($intro->video);
    }
}

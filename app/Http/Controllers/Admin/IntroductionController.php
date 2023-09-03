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
    public function store(IntroductionRequest $request)
    {
        $request['title_one']=['en'=>$request->title_one_en,'ar'=>$request->title_one_ar,'fr'=>$request->title_one_fr,'es'=>$request->title_one_es,'ru'=>$request->title_one_ru];
        $request['title_two']=['en'=>$request->title_two_en,'ar'=>$request->title_two_ar,'fr'=>$request->title_two_fr,'es'=>$request->title_two_es,'ru'=>$request->title_two_ru];
        $request['body']=['en'=>$request->body_en,'ar'=>$request->body_ar,'fr'=>$request->body_fr,'es'=>$request->body_es,'ru'=>$request->body_ru];
        Introduction::create($request->except([
            'title_one_en',
            'title_one_ar',
            'title_one_fr',
            'title_one_es',
            'title_one_ru',
            'title_two_en',
            'title_two_ar',
            'title_two_fr',
            'title_two_es',
            'title_two_ru',
            'body_en',
            'body_ar',
            'body_fr',
            'body_es',
            'body_ru',
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
    public function update(IntroductionRequest $request, string $id)
    {
        $introduction = Introduction::findOrFail($id);

        $request['title_one']=['en'=>$request->title_one_en,'ar'=>$request->title_one_ar,'fr'=>$request->title_one_fr,'es'=>$request->title_one_es,'ru'=>$request->title_one_ru];
        $request['title_two']=['en'=>$request->title_two_en,'ar'=>$request->title_two_ar,'fr'=>$request->title_two_fr,'es'=>$request->title_two_es,'ru'=>$request->title_two_ru];
        $request['body']=['en'=>$request->body_en,'ar'=>$request->body_ar,'fr'=>$request->body_fr,'es'=>$request->body_es,'ru'=>$request->body_ru];
        $introduction->update($request->except([
            'title_one_en',
            'title_one_ar',
            'title_one_fr',
            'title_one_es',
            'title_one_ru',
            'title_two_en',
            'title_two_ar',
            'title_two_fr',
            'title_two_es',
            'title_two_ru',
            'body_en',
            'body_ar',
            'body_fr',
            'body_es',
            'body_ru',
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
}

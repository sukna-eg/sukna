<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\PageRequest;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Page::latest()->get();
        return view('admin.pages.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageRequest $request)
    {
        $request['title']=['en'=>$request->title_en,'ar'=>$request->title_ar,'fr'=>$request->title_fr,'es'=>$request->title_es,'ru'=>$request->title_ru];
        $request['body']=['en'=>$request->body_en,'ar'=>$request->body_ar,'fr'=>$request->body_fr,'es'=>$request->body_es,'ru'=>$request->body_ru];
        Page::create($request->except([
            'title_en',
            'title_ar',
            'title_fr',
            'title_es',
            'title_ru',
            'body_en',
            'body_ar',
            'body_fr',
            'body_es',
            'body_ru',
        ]));


        return redirect()->route('admin.pages.index')
                        ->with('success','Page has been added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $page = Page::findOrFail($id);
        return view('admin.pages.show',compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $page = Page::findOrFail($id);
        return view('admin.pages.edit',compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PageRequest $request, string $id)
    {
        $page = Page::findOrFail($id);
        if ($request->has('image')&&$page->image  && File::exists($page->image)) {
            unlink($page->image);
        }
        $request['title']=['en'=>$request->title_en,'ar'=>$request->title_ar,'fr'=>$request->title_fr,'es'=>$request->title_es,''=>$request->title_ru];
        $request['body']=['en'=>$request->body_en,'ar'=>$request->body_ar,'fr'=>$request->body_fr,'es'=>$request->body_es,''=>$request->body_ru];
        $page->update($request->except([
            'title_en',
            'title_ar',
            'title_fr',
            'title_es',
            'title_ru',
            'body_en',
            'body_ar',
            'body_fr',
            'body_es',
            'body_ru',
        ]));


        return redirect()->route('admin.pages.index')
                        ->with('success','Page has been updated successfully');
    }

        /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Page::findOrFail($request->id)->delete();
        return redirect()->route('admin.pages.index')->with('success','Page has been removed successfully');
    }

}

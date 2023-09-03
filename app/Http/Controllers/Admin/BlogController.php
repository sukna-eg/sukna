<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\BlogRequest;

class BlogController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Blog::latest()->get();
        return view('admin.blogs.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections = Section::all();
        return view('admin.blogs.create',compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {
        $request['title']=['en'=>$request->title_en,'ar'=>$request->title_ar,'fr'=>$request->title_fr,'es'=>$request->title_es,'ru'=>$request->title_ru];
        $request['description']=['en'=>$request->description_en,'ar'=>$request->description_ar,'fr'=>$request->description_fr,'es'=>$request->description_es,'ru'=>$request->description_ru];
        Blog::create($request->except([
            'title_en',
            'title_ar',
            'title_fr',
            'title_es',
            'title_ru',
            'description_en',
            'description_ar',
            'description_fr',
            'description_es',
            'description_ru',
        ]));


        return redirect()->route('admin.blogs.index')
                        ->with('success','Blog has been added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blogs.show',compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blog = Blog::findOrFail($id);
        $sections = Section::all();
        return view('admin.blogs.edit',compact('blog','sections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, string $id)
    {
        $blog = Blog::findOrFail($id);
        if ($request->has('image')&&$blog->image  && File::exists($blog->image)) {
            unlink($blog->image);
        }
        $request['title']=['en'=>$request->title_en,'ar'=>$request->title_ar,'fr'=>$request->title_fr,'es'=>$request->title_es,'ru'=>$request->title_ru];
        $request['description']=['en'=>$request->description_en,'ar'=>$request->description_ar,'fr'=>$request->description_fr,'es'=>$request->description_es,'ru'=>$request->description_ru];
        $blog->update($request->except([
            'title_en',
            'title_ar',
            'title_fr',
            'title_es',
            'title_ru',
            'description_en',
            'description_ar',
            'description_fr',
            'description_es',
            'description_ru',
        ]));


        return redirect()->route('admin.blogs.index')
                        ->with('success','Blog has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Blog::findOrFail($request->id)->delete();
        return redirect()->route('admin.advices.index')->with('success','Blog has been removed successfully');
    }
}

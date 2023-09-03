<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Review;
use App\Models\Partner;
use Illuminate\Http\Request;
use App\Imports\ReviewImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\Admin\ReviewRequest;
use App\Http\Requests\Admin\ImportExcelRequest;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Review::with(['partner','user'])->get();
        return view('admin.reviews.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $partners = Partner::all();
        $users = User::all();
        return view('admin.reviews.create',compact('partners','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReviewRequest $request)
    {
        Review::create($request->all());


        return redirect()->route('admin.reviews.index')
                        ->with('success','Review has been added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function show(string $id)
    {
        $review = Review::with(['partner','user'])->findOrFail($id);
        return view('admin.reviews.show',compact('review'));
    }

    public function edit(string $id)
    {
        $review = Review::findOrFail($id);
        return view('admin.reviews.edit',compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReviewRequest $request, string $id)
    {
        $review = Review::findOrFail($id);
        $review->update($request->all());


        return redirect()->route('admin.reviews.index')
                        ->with('success','Review has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Review::findOrFail($request->id)->delete();
        return redirect()->route('admin.reviews.index')->with('success','Review has been removed successfully');
    }

    public function upload()
    {
        return view('admin.reviews.upload');
    }

    public function import(ImportExcelRequest $request)
    {
        $file = $request->file('file');

        Excel::import(new ReviewImport(), $file);

        return redirect()->route('admin.reviews.index')->with('success','Reviews have been imported successfully');
    }
}

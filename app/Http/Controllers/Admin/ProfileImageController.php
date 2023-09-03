<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProfileImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\ProfileImageRequest;

class ProfileImageController extends Controller
{
         /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ProfileImage::all();
        return view('admin.profile-images.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.profile-images.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProfileImageRequest $request)
    {

        foreach($request->images as $image) {
            ProfileImage::create([
                'image'=>$image,
            ]);
        }
        return redirect()->route('admin.profile-images.index')
                        ->with('success','Profile Images has been added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $image = ProfileImage::findOrFail($id);
        return view('admin.profile-images.edit',compact('image'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileImageRequest $request, string $id)
    {
        $image = ProfileImage::findOrFail($id);

        if ($request->has('image')&&$image->image  && File::exists($image->image)) {
            unlink($image->image);
        }
        $image->update($request->all());
        return redirect()->route('admin.profile-images.index')
                        ->with('success','Profile Image has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        ProfileImage::findOrFail($request->id)->delete();
        return redirect()->route('admin.profile-images.index')->with('success','Profile Image has been removed successfully');
    }
}

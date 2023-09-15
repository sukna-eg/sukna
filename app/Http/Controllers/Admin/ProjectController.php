<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Models\Primage;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\CityRequest;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Project::latest()->get();
        return view('admin.projects.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $services = Service::all();
        return view('admin.projects.create',compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request['name']=['en'=>$request->name_en,'ar'=>$request->name_ar];
        $request['description']=['en'=>$request->description_en,'ar'=>$request->description_ar];
        $request['duration']=['en'=>$request->duration_en,'ar'=>$request->duration_ar];


        $project = Project::create($request->except([

            'name_en',
            'name_ar',
            'description_en',
            'description_ar',
            'duration_en',
            'duration_ar',
            'images'
        ]));

        foreach($request->images as $image) {

            Primage::create([
                'image'=>$image,
                'project_id'=>$project->id,
            ]);
        }


        return redirect()->route('admin.projects.index')
                        ->with('success','Project has been added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::with('images')->findOrFail($id);
        return view('admin.projects.show',compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $services = Service::all();
        $project = Project::with('images')->findOrFail($id);
        return view('admin.projects.edit',compact('project','services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $project = Project::findOrFail($id);


        $request['name']=['en'=>$request->name_en,'ar'=>$request->name_ar];
        $request['description']=['en'=>$request->description_en,'ar'=>$request->description_ar];
        $request['duration']=['en'=>$request->duration_en,'ar'=>$request->duration_ar];

        $project->update($request->except([

            'name_en',
            'name_ar',
            'description_en',
            'description_ar',
            'duration_en',
            'duration_ar'

        ]));


        return redirect()->route('admin.projects.index')
                        ->with('success','Project has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $project=Project::findOrFail($request->id);

        if ($project->images){
            foreach ($project->images as $image) {

                if (File::exists(public_path($image->image))) {
                File::delete(public_path($image->image));
                }

            }


        }


        $project->delete();
        return redirect()->route('admin.projects.index')->with('success','Project has been removed successfully');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Service;
use App\Models\Primage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\PrimageRequest;

class PrimageController extends Controller
{
         /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Primage::latest()->with('project')->orderBy('project_id')->get();
        return view('admin.primages.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::all();
        return view('admin.primages.create',compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PrimageRequest $request)
    {
        foreach($request->images as $image) {

                Primage::create([
                    'image'=>$image,

                    'project_id'=>$request->project_id,
                ]);
        }
        return redirect()->route('admin.primages.index')
                        ->with('success','Images has been added successfully');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $projects = Project::all();
        $image = Primage::with('project')->findOrFail($id);
        return view('admin.primages.edit',compact('image','projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $image = Primage::findOrFail($id);

        if ($request->has('image')&&$image->image  && File::exists($image->image)) {
            unlink($image->image);
        }
        $image->update($request->all());


        return redirect()->route('admin.primages.index')
                        ->with('success','Image has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Primage::findOrFail($request->id)->delete();
        return redirect()->route('admin.primages.index')->with('success','Image has been removed successfully');
    }

    public function sortData($id,$direction = 'up'){
        $model=PortraitImage::findOrFail($id);
        switch ($direction) {
            case 'up':
                $this->sortProcess($model,$direction);
                break;
            case 'down':
                $this->sortProcess($model,$direction);
                break;
            default:
                break;
        }
        return redirect()->route('admin.partners.show',$model->partner->id);
    }

    public function sortProcess($model,$direction)
    {
        $page = $model;
        $id = $model->id;
        $parner = $model->partner->id;
        if ($direction == 'up') {
            $order = $model->when($page->order, function ($query, $pageOrder) {
                return $query->where("order", '<', $pageOrder);
            })->orderBy('order','desc')->wherePartnerId($parner)->firstOrFail();
        } else if ($direction == 'down'){
            $order = $model->when($page->order, function ($query, $pageOrder) {
                return $query->where("order", '>', $pageOrder);
            })->orderBy('order','asc')->wherePartnerId($parner)->firstOrFail();
        }
        if ($order) {
            $page->where('id',$id)->update(['order'=>$order->order]);
            $order->where('id',$order->id)->update(['order'=>$page->order]);
            return TRUE;
        }
    }
}

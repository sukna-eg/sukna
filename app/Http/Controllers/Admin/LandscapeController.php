<?php

namespace App\Http\Controllers\Admin;

use App\Models\Partner;
use Illuminate\Http\Request;
use App\Models\LandscapeImage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\PortraitRequest;

class LandscapeController extends Controller
{
             /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = LandscapeImage::latest()->with('partner')->orderBy('partner_id')->get();
        return view('admin.landscapes.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $partners = Partner::all();
        return view('admin.landscapes.create',compact('partners'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PortraitRequest $request)
    {
        foreach($request->images as $image) {
                if (LandscapeImage::where('partner_id',$request->partner_id)->count()==0) {
                    $order = 1;
                }else{
                    $order = LandscapeImage::where('partner_id',$request->partner_id)->max('order')+1;
                }
                LandscapeImage::create([
                    'image'=>$image,
                    'order'=>$order,
                    'partner_id'=>$request->partner_id,
                ]);
        }
        return redirect()->route('admin.landscapes.index')
                        ->with('success','Landscape Images has been added successfully');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $partners = Partner::all();
        $image = LandscapeImage::with('partner')->findOrFail($id);
        return view('admin.landscapes.edit',compact('image','partners'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PortraitRequest $request, string $id)
    {
        $image = LandscapeImage::findOrFail($id);

        if ($request->has('image')&&$image->image  && File::exists($image->image)) {
            unlink($image->image);
        }
        $image->update($request->all());


        return redirect()->route('admin.landscapes.index')
                        ->with('success','Landscape Image has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        LandscapeImage::findOrFail($request->id)->delete();
        return redirect()->route('admin.landscapes.index')->with('success','Landscape Image has been removed successfully');
    }

    public function sortData($id,$direction = 'up'){
        $model=LandscapeImage::findOrFail($id);
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

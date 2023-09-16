<?php

namespace App\Http\Controllers\Admin;

use App\Models\Area;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AreaRequest;
use App\Models\City;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Area::all();
        return view('admin.areas.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::all();
        return view('admin.areas.create',compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AreaRequest $request)
    {
        // $request['name']=['en'=>$request->name_en,'ar'=>$request->name_ar];

        Area::create($request->except([
            'name_en',
            'name_ar',

        ]));

        return redirect()->route('admin.areas.index')
                        ->with('success','Area has been added successfully');
    }

    public function show(string $id)
    {
        $area = Area::with('city')->findOrFail($id);
        return view('admin.areas.show',compact('area'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $area = Area::findOrFail($id);
        $cities = City::all();
        return view('admin.areas.edit',compact('area','cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AreaRequest $request, string $id)
    {
        $area = Area::findOrFail($id);
        $request['name']=['en'=>$request->name_en,'ar'=>$request->name_ar];
        $area->update($request->except([
            'name_en',
            'name_ar',

        ]));


        return redirect()->route('admin.areas.index')
                        ->with('success','Area has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Area::findOrFail($request->id)->delete();
        return redirect()->route('admin.areas.index')->with('success','Area has been removed successfully');
    }

    public function sortData($id,$direction = 'up'){
        $model=Area::findOrFail($id);
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
        return redirect()->route('admin.areas.index');
    }

    public function sortProcess($model,$direction)
    {
        $page = $model;
        $id = $model->id;
        if ($direction == 'up') {
            $order = $model->when($page->order, function ($query, $pageOrder) {
                return $query->where("order", '<', $pageOrder);
            })->orderBy('order','desc')->firstOrFail();
        } else if ($direction == 'down'){
            $order = $model->when($page->order, function ($query, $pageOrder) {
                return $query->where("order", '>', $pageOrder);
            })->orderBy('order','asc')->firstOrFail();
        }
        if ($order) {
            $page->where('id',$id)->update(['order'=>$order->order]);
            $order->where('id',$order->id)->update(['order'=>$page->order]);
            return TRUE;
        }
    }

}

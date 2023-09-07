<?php

namespace App\Http\Controllers\Admin;


use App\Models\Area;
use App\Models\City;
use App\Models\Branch;
use App\Models\Partner;
use App\Models\User;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Models\PortraitImage;
use App\Models\Pimage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\PartnerRequest;

class PartnerController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Partner::latest()->get();
        return view('admin.partners.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subcategories = Subcategory::all();
        $areas = Area::all();
        $users = User::all();
        $cities = City::all();
        return view('admin.partners.create',compact('subcategories','areas','cities','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request['address']=['en'=>$request->address_en,'ar'=>$request->address_ar];
        $request['description']=['en'=>$request->description_en,'ar'=>$request->description_ar];
        $partner=Partner::create($request->except([
            'address_ar',
            'address_en',
            'description_en',
            'description_ar',
            'images'
            // 'area_id',
            // 'user_id',
            // 'subcategory_id'

        ]));

        foreach($request->images as $image) {

            Pimage::create([
                'image'=>$image,
                'partner_id'=>$partner->id,
            ]);
        }


        return redirect()->route('admin.partners.index')
                        ->with('success','Partner has been added successfully');
    }



    public function show(string $id)
    {
        $partner = Partner::with(['appointments','images'
        ])->findOrFail($id);
        return view('admin.partners.show',compact('partner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $partner = Partner::findOrFail($id);
        $subcategories = Subcategory::all();
        $areas = Area::all();
        $users = User::all();
        return view('admin.partners.edit',compact('partner','subcategories','areas','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $partner = Partner::findOrFail($id);

        $request['address']=['en'=>$request->address_en,'ar'=>$request->address_ar];
        $request['description']=['en'=>$request->description_en,'ar'=>$request->description_ar];
        $partner->update($request->except([
            'address_en',
            'address_ar',

            'description_en',
            'description_ar',

        ]));


        return redirect()->route('admin.partners.index')
                        ->with('success','Partner has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Partner::findOrFail($request->id)->delete();
        return redirect()->route('admin.partners.index')->with('success','Partner has been removed successfully');
    }

    public function openFile($id)
    {
        $partner = Partner::findOrFail($id);
        return response()->file($partner->music);
    }
}

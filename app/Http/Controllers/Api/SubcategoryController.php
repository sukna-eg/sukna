<?php

namespace App\Http\Controllers\Api;

use App\Models\Subcategory;
use App\Models\Partner;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\SubcategoryRequest;
use App\Http\Resources\SubcategoryResource;
use App\Http\Resources\PartnerResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class SubcategoryController extends ApiController
{
    public function __construct()
    {
        $this->resource = SubcategoryResource::class;
        $this->model = app(Subcategory::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( Request $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }

    public function getPartnersBySub($id)
    {
        $sub = Subcategory::find($id);

        $partners = Partner::where('show', 1)->whereHas('subcategory', function ($query) use ($id) {
            $query->where('id', $id);
        })->get();

        return $this->returnData('data', PartnerResource::collection($partners), __('Get successfully'));
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Models\Partner;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Controllers\ApiController;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PartnerResource;

class CategoryController extends ApiController
{
    public function __construct()
    {
        $this->resource = CategoryResource::class;
        $this->model = app(Category::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( Request $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }

    public function getPartnersByCategory($id)
    {

        $category = Category::find($id);

        $partners = array(); // the best way right now for each cuze our time i will do it
        foreach (Partner::all() as $partner) {
            if ( $partner?->subcategory?->category?->id == $id ) {
                // dd($service?->subcategory?->parent?->name);
                array_push($partners, $partner);
            }
        }
        return $this->returnData('data', PartnerResource::collection($partners), __('Get  succesfully'));



    }

}

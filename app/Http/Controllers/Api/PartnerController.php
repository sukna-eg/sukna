<?php

namespace App\Http\Controllers\Api;

use App\Models\Partner;
// use App\Models\City;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\PartnerRequest;
use App\Http\Resources\PartnerResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
// use App\Http\Resources\PriceResource;
use Illuminate\Support\Facades\DB;

class PartnerController extends ApiController
{
    public function __construct()
    {
        $this->resource = PartnerResource::class;
        $this->model = app(Partner::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( Request $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }


    public function view($id)
    {
        $model = $this->repositry->getByID($id);

        $views = (int)$model->views + 1;

        $model->update([
            'views' => $views
        ]);

        if ($model) {
            return $this->returnData('data', new $this->resource($model), __('Get  succesfully'));
        }

        return $this->returnError(__('Sorry! Failed to get !'));
    }


    public function premiumPartners(){


        $data=Partner::where('show',1)->orderBy('order', 'ASC')->get();
        return $this->returnData('data',  PartnerResource::collection( $data ), __('Get  succesfully'));

       }




}

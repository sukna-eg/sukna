<?php

namespace App\Http\Controllers\Api;

use App\Models\Review;
use App\Models\Partner;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\ReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class ReviewController extends ApiController
{
    public function __construct()
    {
        $this->resource = ReviewResource::class;
        $this->model = app(Review::class);
        $this->repositry =  new Repository($this->model);
    }



    public function save( Request $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }



    public function getReviewsByPartner($id){

        $partner = Partner::find( $id );
        if( $partner->reviews() ){

            return $this->returnData('data',  ReviewResource::collection( $partner->reviews ), __('Get  succesfully'));
        }

        return $this->returnError(__('Sorry! Failed to get !'));

    }


}

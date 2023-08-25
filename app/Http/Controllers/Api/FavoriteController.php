<?php

namespace App\Http\Controllers\Api;

use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\FavoriteRequest;
use App\Http\Resources\FavoriteResource;
use App\Http\Resources\PartnerResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Models\Partner;
use Illuminate\Support\Facades\Auth;


class FavoriteController extends ApiController
{
    public function __construct()
    {
        $this->resource = FavoriteResource::class;
        $this->model = app(Favorite::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( Request $request ){

        $model = Favorite::where('partner_id',$request->partner_id)->where('user_id',$request->user_id)->first();

        if($model){
            return $this->returnError(__('Sorry! Partner already exist !'));
        }
        return $this->store( $request->all() );
    }

    public function deletebyID( $partner_id, $user_id ){


        $model = Favorite::where('partner_id',$partner_id)->where('user_id',$user_id)->first();

        if (!$model) {
            return $this->returnError(__('Sorry! Failed to get !'));
        }

        $model->delete();



        return $this->returnSuccessMessage(__('Delete succesfully!'));


    }

    public function isFav(Request $request){


        $favorite = Favorite::where('user_id',$request->user_id)->where('partner_id',$request->partner_id)->first();
            if($favorite){
                return $this->returnSuccessMessage('true');
            }
            return $this->returnError('false');
    }


    public function myFavorites()
    {

        $favorites = Auth::user()->favorites;
        return $this->returnData('data',  PartnerResource::collection( $favorites ), __('Get  succesfully'));

    }


}

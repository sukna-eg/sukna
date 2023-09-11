<?php

namespace App\Http\Controllers\Api;

use App\Models\BlackDay;
use App\Models\User;
use App\Models\Partner;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\AreaRequest;
use App\Http\Resources\BlackDayResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class BlackDayController extends ApiController
{
    public function __construct()
    {
        $this->resource = BlackDayResource::class;
        $this->model = app(BlackDay::class);
        $this->repositry =  new Repository($this->model);
    }



    public function save(Request $request)
    {

        $app=Appointment::find($request->appointment_id);
        $app->status = 1 ;
        $app->save();

        $black=new BlackDay();
        $black->from=$request->from;
        $black->to=$request->to;
        $black->partner_id=$request->partner_id;
        $black->user_id=$request->user_id;
        $black->appointment_id=$request->appointment_id;
        $black->save();




        return $this->returnData('data', new BlackDayResource($black), __('Successfully'));
    }

    public function edit($id,Request $request){


        // return $this->update($id,$request->all());


            $model = $this->repositry->getByID($id);
            if ($model) {
                $model = $this->repositry->edit( $id,$request->all() );

                $app=Appointment::find($model->appointment_id);
                $app->from = $model->from ;
                $app->to = $model->to ;
                $app->save();

                return $this->returnData('data', new $this->resource( $model ), __('Updated succesfully'));
            }

            return $this->returnError(__('Sorry! Failed to get !'));



    }


    public function deleteBlack(Request $request)
    {
        $model = $this->repositry->getByID($request->black_day_id);

        if (!$model) {
            return $this->returnError(__('Sorry! Failed to get !'));
        }
        $app=Appointment::find($model->appointment_id);
        $app->status = 0 ;
        $app->save();

        $this->repositry->deleteByID($request->black_day_id);



        return $this->returnSuccessMessage(__('Delete succesfully!'));
    }


    public function getBlacksByPartner($partner_id){

        $partner = Partner::find( $partner_id );
        if( $partner ){

            return $this->returnData('data',  BlackDayResource::collection( $partner->paginatedblacks() ), __('Get  succesfully'));
        }

        return $this->returnError(__('Sorry! Failed to get !'));

    }
}

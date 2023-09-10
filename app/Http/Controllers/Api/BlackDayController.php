<?php

namespace App\Http\Controllers\Api;

use App\Models\BlackDay;
use App\Models\User;
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
        $black->save();




        return $this->returnData('data', new BlackDayResource($black), __('Successfully'));
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }
}

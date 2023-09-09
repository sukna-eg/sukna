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



    public function save( Request $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }
}

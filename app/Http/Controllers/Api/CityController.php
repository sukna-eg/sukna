<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\CityRequest;
use App\Http\Resources\CityResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class CityController extends ApiController
{
    public function __construct()
    {
        $this->resource = CityResource::class;
        $this->model = app(City::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( Request $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }
}

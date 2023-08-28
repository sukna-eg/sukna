<?php

namespace App\Http\Controllers\Api;

use App\Models\Primage;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\LandscapeImageRequest;
use App\Http\Resources\PrimageResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class PrimageController extends ApiController
{
    public function __construct()
    {
        $this->resource = PrimageResource::class;
        $this->model = app(Primage::class);
        $this->repositry =  new Repository($this->model);
    }




    public function save( Request $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }
}

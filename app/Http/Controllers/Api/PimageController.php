<?php

namespace App\Http\Controllers\Api;

use App\Models\Pimage;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\LandscapeImageRequest;
use App\Http\Resources\PimageResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class PimageController extends ApiController
{
    public function __construct()
    {
        $this->resource = PimageResource::class;
        $this->model = app(Pimage::class);
        $this->repositry =  new Repository($this->model);
    }




    public function save( Request $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }
}

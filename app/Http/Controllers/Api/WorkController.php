<?php

namespace App\Http\Controllers\Api;

use App\Models\Work;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\AreaRequest;
use App\Http\Resources\WorkResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class WorkController extends ApiController
{

    public function __construct()
    {
        $this->resource = WorkResource::class;
        $this->model = app(Work::class);
        $this->repositry =  new Repository($this->model);
    }



    public function save( Request $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }

}

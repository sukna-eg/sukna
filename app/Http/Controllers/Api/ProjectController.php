<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\AreaRequest;
use App\Http\Resources\ProjectResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class ProjectController extends ApiController
{
    public function __construct()
    {
        $this->resource = ProjectResource::class;
        $this->model = app(Project::class);
        $this->repositry =  new Repository($this->model);
    }



    public function save( Request $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }


    public function getProjectsByService($servic_id){

        $service = Service::find( $servic_id );
        if( $service ){

            return $this->returnData('data',  ProjectResource::collection( $service->projects ), __('Get  succesfully'));
        }

        return $this->returnError(__('Sorry! Failed to get !'));

    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\AreaRequest;
use App\Http\Resources\ServiceResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class ServiceController extends ApiController
{
    public function __construct()
    {
        $this->resource = ServiceResource::class;
        $this->model = app(Service::class);
        $this->repositry =  new Repository($this->model);
    }



    public function save( Request $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }


    public function ourPartners()
    {
        $userImages = User::where('type', 1)
            ->inRandomOrder()
            ->limit(20)
            ->pluck('image')
            ->toArray();

        $serviceImages = Service::where('premium', 1)
            ->inRandomOrder()
            ->limit(10)
            ->pluck('image')
            ->toArray();

        $images = array_merge($userImages, $serviceImages);

        return $this->returnSuccessMessage($images);
    }
}

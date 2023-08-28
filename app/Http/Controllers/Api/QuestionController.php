<?php

namespace App\Http\Controllers\Api;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\AreaRequest;
use App\Http\Resources\QuestionResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class QuestionController extends ApiController
{
    public function __construct()
    {
        $this->resource = QuestionResource::class;
        $this->model = app(Question::class);
        $this->repositry =  new Repository($this->model);
    }

    public function questions()
    {

        $data = Question::where('status', 1)->get();

        return $this->returnData('data', $this->resource::collection($data), __('Succesfully'));
    }

    public function save( Request $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }
}

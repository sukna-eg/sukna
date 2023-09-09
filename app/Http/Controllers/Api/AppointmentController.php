<?php

namespace App\Http\Controllers\Api;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\AreaRequest;
use App\Http\Resources\AppointmentResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Auth;


class AppointmentController extends ApiController
{
    public function __construct()
    {
        $this->resource = AppointmentResource::class;
        $this->model = app(Appointment::class);
        $this->repositry =  new Repository($this->model);
    }



    public function save( Request $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }

//     public function myOrders()
//     {

//         $ownerId = auth()->user()->id; // Assuming you're using authentication

//         $owner = User::with(['partners.appointments'])->find($ownerId);
//         $appointments = array();

//         // Now you can access appointments for all partners owned by the owner
//         foreach ($owner->partners as $partner) {
//             foreach ($partner->appointments as $appointment) {

//                 array_push($appointments, $appointment);

//     }
// }

// return $this->returnData('data', AppointmentResource::collection($appointments), __('Get  succesfully'));

//     }

public function myOrders()
{
    $ownerId = auth()->user()->id; // Assuming you're using authentication

    $owner = User::with(['partners.appointments'])->find($ownerId);
    $appointments = collect();

    // Now you can access appointments for all partners owned by the owner
    foreach ($owner->partners as $partner) {
        foreach ($partner->appointments as $appointment) {
            $appointments->push($appointment);
        }
    }

    $page = request()->get('page', 1); // Get the current page from the request, default to 1
    $perPage = 10; // Number of items per page

    $paginatedAppointments = $appointments->slice(($page - 1) * $perPage, $perPage)->values();

    return $this->returnData('data', AppointmentResource::collection($paginatedAppointments), __('Get successfully'));



}

}

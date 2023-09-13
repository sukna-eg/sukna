<?php

namespace App\Http\Controllers\Api;

use App\Models\Appointment;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\AreaRequest;
use App\Http\Resources\AppointmentResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Auth;
use App\Traits\NotificationTrait;


class AppointmentController extends ApiController
{
    use NotificationTrait;

    public function __construct()
    {
        $this->resource = AppointmentResource::class;
        $this->model = app(Appointment::class);
        $this->repositry =  new Repository($this->model);
    }



    public function save(Request $request)
    {
        $from = $request->from;
        $to = $request->to;
        $userId = $request->user_id;
        $partnerId = $request->partner_id;

        // Get the current server date
        $serverDate = date('Y-m-d');

        // Check if an appointment already exists for the same user and partner on the same day as the server date
        $existingAppointment = Appointment::where('user_id', $userId)
            ->where('partner_id', $partnerId)
            ->whereDate('created_at', '=', $serverDate)
            ->first();

        if ($existingAppointment) {
            return $this->returnError('Sorry, you have already submitted a request to reserve this property!');
        }

        $appointment = new Appointment();
        $appointment->from = $from;
        $appointment->to = $to;
        $appointment->user_id = $userId;
        $appointment->partner_id = $partnerId;
        $appointment->save();

       //admin
        $partner=Partner::find($appointment->partner_id);
        $user = $partner->user;

        $token = $user->device_token;

            $this->sendAdminNoti('مرحبا','لديك طلب حجز من اليوزر '.$user->name. 'على العقار'.$appointment->partner_id,"order",$token);

            $note= new Notification();
            $note->content = 'لديك طلب حجز من اليوزر '.$user->name. 'على العقار'.$appointment->partner_id;
            $note->user_id = $appointment->user_id;
            $note->type = 'order';
            $note->route_id = $appointment->id;
            $note->save();

        return $this->returnData('data', new AppointmentResource($appointment), __('Successfully'));
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

      // Sort appointments by ID in descending order
      $sortedAppointments = $appointments->sortByDesc('id');

      $page = request()->get('page', 1); // Get the current page from the request, default to 1
      $perPage = 10; // Number of items per page

      $paginatedAppointments = $sortedAppointments->slice(($page - 1) * $perPage, $perPage)->values();

    return $this->returnData('data', AppointmentResource::collection($paginatedAppointments), __('Get successfully'));



}

}

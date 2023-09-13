<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use App\Models\User;
use App\Repositories\Repository;
use Illuminate\Http\Request;
 use App\Traits\NotificationTrait;
 use Illuminate\Support\Facades\Auth;


class NotificationController extends ApiController
{

    use NotificationTrait;
    public function __construct()
    {
        $this->resource = NotificationResource::class;
        $this->model = app(Notification::class);
        $this->repositry = new Repository($this->model);
    }

    public function save(Request $request)
    {
        return $this->store($request->all());
    }

    public function edit($id, Request $request)
    {

        return $this->update($id, $request->all());

    }


    public function sendNotiToUser(Request $request)
    {
        $user = User::find($request->id);

        $token = $user->device_token;

        $this->send($request->content,$request->title,$token);

        // dd($result);
        return $this->returnSuccessMessage(__('The notification has been sent successfully!'));

    }

    public function sendNotiToAll(Request $request)
    {

        $FcmToken = User::whereNotNull('device_token')->pluck('device_token')->all(); // i like whereNotNull

        $this->send($request->content,$request->title,$FcmToken,true);

        return $this->returnSuccessMessage(__('The notification has been sent successfully!'));

    }

    public function sendPartner(Request $request)
    {

        $FcmToken = User::whereNotNull('device_token')->pluck('device_token')->all();
        $this->sendPartnerNoti('مرحبا','لقد تم إضافة عقار جديد يمكنك رؤيته من هنا','partner',$request->partner_id,$FcmToken);

        $users=User::whereNotNull('device_token')->get();

        foreach($users as $user){


        $note = new Notification();
        // $note->content = 'لقد تم إضافة عقار جديد يمكنك رؤيته من هنا';
        $note->content = 'لقد تم إضافة عقار جديد يمكنك رؤيته من هنا';
        $note->user_id = $user->id;
        $note->type = 'partner';
        $note->route_id = $request->partner_id;
        $note->save();


        }
     return $this->returnSuccessMessage(__('The notification has been sent successfully!'));
    }


     public function myNotifications()
    {

        // $advertisements = Auth::user()->advertisements;
        $notifications = Notification::where('user_id',Auth::user()->id)->paginate(10) ;
        return $this->returnData('data',  NotificationResource::collection( $notifications ), __('Get  succesfully'));

    }
}

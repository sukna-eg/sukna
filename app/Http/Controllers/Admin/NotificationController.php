<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Traits\NotificationTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NotificationRequest;

class NotificationController extends Controller
{
    use NotificationTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Notification::latest()->get();
        return view('admin.notifications.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.notifications.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // if ($request->has('multi_language')) {
        //     $request['title']=['en'=>$request->title_en,'ar'=>$request->title_ar,'fr'=>$request->title_fr,'es'=>$request->title_es,'ru'=>$request->title_ru];
        //     $request['body']=['en'=>$request->body_en,'ar'=>$request->body_ar,'fr'=>$request->body_fr,'es'=>$request->body_es,'ru'=>$request->body_ru];
        //     $notification=Notification::create($request->only('title','body'));
        // }else{

        // }
        $FcmToken = User::whereNotNull('device_token')->pluck('device_token')->toArray();

        $this->send($request->content, $request->title,$FcmToken,true);

        $users=User::whereNotNull('device_token')->get();

        foreach($users as $user){


        $note = new Notification();
        $note->title = $request->title;
        $note->content = $request->content;
        $note->user_id = $user->id;

        $note->save();


        }
        return redirect()->route('admin.notifications.index')
                        ->with('success','Notification has been added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $notification = Notification::findOrFail($id);
        return view('admin.notifications.show',compact('notification'));
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Notification::findOrFail($request->id)->delete();
        return redirect()->route('admin.notifications.index')->with('success','Notification has been removed successfully');
    }
}

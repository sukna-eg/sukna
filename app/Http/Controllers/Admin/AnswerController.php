<?php

namespace App\Http\Controllers\Admin;

use App\Models\Answer;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AreaRequest;
use App\Models\Question;
use App\Models\Notification;
use App\Traits\NotificationTrait;


class AnswerController extends Controller
{
    use NotificationTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Answer::all();
        return view('admin.answers.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $questions = Question::all();
        $users = User::all();
        return view('admin.answers.create',compact('questions','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request['answer']=['en'=>$request->answer_en,'ar'=>$request->answer_ar];

        $answer=Answer::create($request->except([
            'answer_en',
            'answer_ar',

        ]));

        $user = User::find($answer->question->user_id);

        $token = $user->device_token;

            $this->sendReplay('مرحبًا '.$user->name.'👋🏼','تم الرد على استشارتك العقارية من قِبل الخبير العقاري. ',"expert",$token);

            $note= new Notification();
            $note->content ='تم الرد على استشارتك العقارية من قِبل الخبير العقاري. ';
            $note->user_id = $user->id;
            $note->type = 'expert';
            $note->route_id = $answer->question->id;
            $note->save();

        return redirect()->route('admin.answers.index')
                        ->with('success','Answer has been added successfully');
    }

    public function show(string $id)
    {
        $answer = Answer::with('question')->findOrFail($id);
        return view('admin.answers.show',compact('answer'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $answer = Answer::findOrFail($id);
        $qustions = Question::all();
        $users = User::all();
        return view('admin.answers.edit',compact('answer','qustions','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $answer = Answer::findOrFail($id);
        $request['answer']=['en'=>$request->answer_en,'ar'=>$request->answer_ar];
        $answer->update($request->except([
            'answer_en',
            'answer_ar',

        ]));


        return redirect()->route('admin.answers.index')
                        ->with('success','Answer has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Answer::findOrFail($request->id)->delete();
        return redirect()->route('admin.answers.index')->with('success','Answer has been removed successfully');
    }

    public function sortData($id,$direction = 'up'){
        $model=Area::findOrFail($id);
        switch ($direction) {
            case 'up':
                $this->sortProcess($model,$direction);
                break;
            case 'down':
                $this->sortProcess($model,$direction);
                break;
            default:
                break;
        }
        return redirect()->route('admin.areas.index');
    }

    public function sortProcess($model,$direction)
    {
        $page = $model;
        $id = $model->id;
        if ($direction == 'up') {
            $order = $model->when($page->order, function ($query, $pageOrder) {
                return $query->where("order", '<', $pageOrder);
            })->orderBy('order','desc')->firstOrFail();
        } else if ($direction == 'down'){
            $order = $model->when($page->order, function ($query, $pageOrder) {
                return $query->where("order", '>', $pageOrder);
            })->orderBy('order','asc')->firstOrFail();
        }
        if ($order) {
            $page->where('id',$id)->update(['order'=>$order->order]);
            $order->where('id',$order->id)->update(['order'=>$page->order]);
            return TRUE;
        }
    }

}

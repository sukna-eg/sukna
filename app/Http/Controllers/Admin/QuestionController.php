<?php

namespace App\Http\Controllers\Admin;

use App\Models\Question;
use App\Models\Answer;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\CityRequest;
use App\Models\Notification;
use App\Traits\NotificationTrait;

class QuestionController extends Controller
{
    use NotificationTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Question::latest()->get();
        return view('admin.questions.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('admin.questions.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // $request['question']=['en'=>$request->question_en,'ar'=>$request->question_ar];

        $question = Question::create($request->all());



        return redirect()->route('admin.questions.index')
                        ->with('success','Question has been added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $question = Question::with('answers')->findOrFail($id);
        return view('admin.questions.show',compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $users=User::all();
        $question = Question::with('answers')->findOrFail($id);
        return view('admin.questions.edit',compact('question','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {
    //     $question = Question::findOrFail($id);


    //     $request['question']=['en'=>$request->question_en,'ar'=>$request->question_ar];

    //     $question->update($request->except([

    //         'question_en',
    //         'question_ar',

    //     ]));





    //     return redirect()->route('admin.questions.index')
    //                     ->with('success','Question has been updated successfully');
    // }


    public function update(Request $request, string $id)
{
    $question = Question::findOrFail($id);

    // $request['question'] = ['en' => $request->question_en, 'ar' => $request->question_ar];

    // $updateData = $request->except(['question_en', 'question_ar']);
    $updateData = $request->except(['answer']);

    // Check if the 'status' field is updated to 1
    // if ($question->status == 0 && isset($updateData['status']) && $updateData['status'] == 1) {
    //     $user = User::find($question->user_id);
    //     $token = $user->device_token;
    //     $this->confirmQuestion(' مرحبًا '.$user->name.' 👋🏼', 'تم الموافقة على استشارتك العقارية، وسيتم الرد عليها قريبًا.', "expert", $token);

    //     $note = new Notification();
    //     $note->content = 'تم الموافقة على استشارتك العقارية، وسيتم الرد عليها قريبًا';
    //     $note->user_id = $user->id;
    //     $note->type = 'expert';
    //     $note->route_id = $question->id;
    //     $note->save();
    // }

    $aya=User::where('phone','+963937158233')->first();

    if ($request->has('answer')) {
        // Create a new answer
        $answer = new Answer();
        $answer->answer = $request->answer;
        $answer->question_id = $question->id;
        $answer->user_id = $aya->id;
        $answer->save();



        $user = User::find($answer->question->user_id);

        $token = $user->device_token;

            $this->sendReplay(' مرحبًا '.$user->name.' 👋🏼',' تمت الموافقة على استشارتك العقارية وتم الرد عليها من قِبل الخبير العقاري. ',"expert",$token);

            $note= new Notification();
            $note->title=' مرحبًا '.$user->name.' 👋🏼';
            $note->content ='تمت الموافقة على استشارتك العقارية وتم الرد عليها من قِبل الخبير العقاري.';
            $note->user_id = $user->id;
            $note->type = 'expert';
            $note->route_id = $answer->question->id;
            $note->save();
    }

    // Update the question
    $question->update($updateData);



    return redirect()->route('admin.questions.index')
                    ->with('success', 'Question has been updated successfully');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Question::findOrFail($request->id)->delete();
        return redirect()->route('admin.questions.index')->with('success','Question has been removed successfully');
    }
}

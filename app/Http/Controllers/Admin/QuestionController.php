<?php

namespace App\Http\Controllers\Admin;

use App\Models\Question;
use App\Models\Answer;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\CityRequest;

class QuestionController extends Controller
{
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

        $request['question']=['en'=>$request->question_en,'ar'=>$request->question_ar];

        $question = Question::create($request->except([

            'question_en',
            'question_ar'
        ]));



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
    public function update(Request $request, string $id)
    {
        $question = Question::findOrFail($id);


        $request['question']=['en'=>$request->question_en,'ar'=>$request->question_ar];

        $question->update($request->except([

            'question_en',
            'question_ar',

        ]));


        return redirect()->route('admin.questions.index')
                        ->with('success','Question has been updated successfully');
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

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FaqRequest;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Faq::latest()->get();
        return view('admin.faqs.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.faqs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FaqRequest $request)
    {
        $request['question']=['en'=>$request->question_en,'ar'=>$request->question_ar,'fr'=>$request->question_fr,'es'=>$request->question_es,'ru'=>$request->question_ru];
        $request['answer']=['en'=>$request->answer_en,'ar'=>$request->answer_ar,'fr'=>$request->answer_fr,'es'=>$request->answer_es,'ru'=>$request->answer_ru];
        Faq::create($request->except([
            'question_en',
            'question_ar',
            'question_fr',
            'question_es',
            'question_ru',
            'answer_en',
            'answer_ar',
            'answer_fr',
            'answer_es',
            'answer_ru',
        ]));


        return redirect()->route('admin.faqs.index')
                        ->with('success','Faq has been added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $faq = Faq::findOrFail($id);
        return view('admin.faqs.show',compact('faq'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $faq = Faq::findOrFail($id);
        return view('admin.faqs.edit',compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FaqRequest $request, string $id)
    {
        $faq = Faq::findOrFail($id);
        $request['question']=['en'=>$request->question_en,'ar'=>$request->question_ar,'fr'=>$request->question_fr,'es'=>$request->question_es,'ru'=>$request->question_ru];
        $request['answer']=['en'=>$request->answer_en,'ar'=>$request->answer_ar,'fr'=>$request->answer_fr,'es'=>$request->answer_es,'ru'=>$request->answer_ru];
        $faq->update($request->except([
            'question_en',
            'question_ar',
            'question_fr',
            'question_es',
            'question_ru',
            'answer_en',
            'answer_ar',
            'answer_fr',
            'answer_es',
            'answer_ru',
        ]));


        return redirect()->route('admin.faqs.index')
                        ->with('success','Faq has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Faq::findOrFail($request->id)->delete();
        return redirect()->route('admin.faqs.index')->with('success','Faq has been removed successfully');
    }
}

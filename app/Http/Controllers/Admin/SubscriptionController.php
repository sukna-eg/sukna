<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subscription;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubscriptionRequest;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Subscription::with(['user','plan'])->latest()->get();
        return view('admin.subscriptions.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $plans = Plan::all();

        return view('admin.subscriptions.create',compact('users','plans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $sub=Subscription::create($request->all());

        $plan=Plan::find($sub->plan_id);
         $user=User::find($sub->user_id);
         $user->start_date=$sub->start_date;
         $user->properties_count=$plan->counts;
         $user->save();


        return redirect()->route('admin.subscriptions.index')
                        ->with('success','subscription has been added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subscription = Subscription::with(['user','plan'])->findOrFail($id);
        return view('admin.subscriptions.show',compact('subscription'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subscription = Subscription::findOrFail($id);
        $users = User::all();
        $plans = Plan::all();
        return view('admin.subscriptions.edit',compact('subscription','users','plans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subscription = Subscription::findOrFail($id);
        $subscription->update($request->all());


        return redirect()->route('admin.subscriptions.index')
                        ->with('success','subscription has been updated successfully');
    }


    public function destroy(Request $request)
    {
        Subscription::findOrFail($request->id)->delete();
        return redirect()->route('admin.subscriptions.index')->with('success','subscription has been removed successfully');
    }

}

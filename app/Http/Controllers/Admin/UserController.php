<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\Partner;
use App\Models\Subscription;
use App\Models\User;
use File;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::get();
        return view('admin.users.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $request['password'] = bcrypt($request->password);
        User::create($request->all());

        return redirect()->route('admin.users.index')
            ->with('success', 'User has been added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with(['partners', 'reviews'])->findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        if ($request->password != null) {
            $request['password'] = bcrypt($request->password);
        } elseif ($request->password == null) {
            unset($request['password']);
        }

        if ($request->has('image') && $user->image && File::exists($user->image)) {
            unlink($user->image);
        }
        $user->update($request->all());

        return redirect()->route('admin.users.index')
            ->with('success', 'User has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        User::findOrFail($request->id)->delete();
        return redirect()->route('admin.users.index')->with('success', 'User has been removed successfully');
    }

    public function report()
    {

        $users = User::where('type', 1)->get();
        foreach ($users as $user) {

            $first = $user->subscriptions?->last()->first_month;
            $second = $user->subscriptions?->last()->second_month;
            $third = $user->subscriptions?->last()->third_month;

            $total = $user->subscriptions?->last()->total;
            $paid = $user->subscriptions?->last()->paids;

            $lastPlan = $user->subscriptions?->last()->plan_id;
            $lastSub = $user->subscriptions?->last()->id;
            $sub = Subscription::find($lastSub);

            $dpartners = Partner::where('user_id', $user->id)
                ->where('show', 1)
                ->where('period', 0)
                ->where('plan_id', $lastPlan)
                ->get();

            $mpartners = Partner::where('user_id', $user->id)
                ->where('show', 1)
                ->where('period', 1)
                ->where('plan_id', $lastPlan)
                ->get();

            $dpartner = Partner::where('user_id', $user->id)
                ->where('show', 1)
                ->where('period', 0)
                ->where('plan_id', $lastPlan)
                ->count();

            $mpartner = Partner::where('user_id', $user->id)
                ->where('show', 1)
                ->where('period', 1)
                ->where('plan_id', $lastPlan)
                ->count();

            if ($lastPlan == 1) {

                if ($dpartner == 1 && $mpartner == 0) {

                    $partner = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 0)
                        ->where('plan_id', $lastPlan)
                        ->first();

                    $paid = 0;
                    $total = $partner->price;

                    if ($first == 1 && $second == 0 && $third == 0) {
                        $paid = $partner->price;

                        $total = $total * 3;

                    }

                    if ($first == 1 && $second == 1 && $third == 0) {

                        $total = $total * 3;
                        $paid = $partner->price * 2;

                    }

                    if ($first == 1 && $second == 1 && $third == 1) {

                        $total = $total * 3;
                        $paid = $partner->price * 3;

                    }

                    $sub->total = $total;
                    $sub->paids = $paid;
                    $sub->save();

                }

                if ($mpartner == 1 && $dpartner == 0) {

                    $partner = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 1)
                        ->where('plan_id', $lastPlan)
                        ->first();

                    $paid = 0;
                    $total = ($partner->price * 0.15);

                    if ($first == 1 && $second == 0 && $third == 0) {
                        $paid = $partner->price * 0.15;

                        $total = $total * 3;

                    }

                    if ($first == 1 && $second == 1 && $third == 0) {

                        $paid = ($partner->price * 0.15) * 2;

                        $total = $total * 3;

                    }

                    if ($first == 1 && $second == 1 && $third == 1) {

                        $total = $total * 3;
                        $paid = ($partner->price * 0.15) * 3;

                    }

                    $sub->total = $total;
                    $sub->paids = $paid;
                    $sub->save();

                }

            }

            if ($lastPlan == 2) {

                if ($dpartner == 2 && $mpartner == 0) {

                    $maxPrices = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 0)
                        ->where('plan_id', $lastPlan)
                        ->orderBy('price', 'desc')
                        ->limit(2)
                        ->pluck('price');

                    $maxPrice = $maxPrices[0] ?? null;
                    $secondMaxPrice = $maxPrices[1] ?? null;

                    $paid = 0;
                    $total = ($maxPrice + (0.1 * $maxPrice) + ($secondMaxPrice * 0.1)) * 3;

                    if ($first == 1 && $second == 0 && $third == 0) {
                        $paid = $maxPrice + (0.1 * $maxPrice) + ($secondMaxPrice * 0.1);

                        // $total = $total * 3;

                    }

                    if ($first == 1 && $second == 1 && $third == 0) {

                        // $total = $total * 3;
                        $paid = ($maxPrice + (0.1 * $maxPrice) + ($secondMaxPrice * 0.1)) * 2;

                    }

                    if ($first == 1 && $second == 1 && $third == 1) {

                        // $total = $total * 3;
                        $paid = ($maxPrice + (0.1 * $maxPrice) + ($secondMaxPrice * 0.1)) * 3;

                    }

                    $sub->total = $total;
                    $sub->paids = $paid;
                    $sub->save();

                }

                if ($mpartner > 1 && $dpartner == 0) {

                    $maxOne = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 1)
                        ->where('plan_id', $lastPlan)
                        ->max('price');

                    $maxId = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 1)
                        ->where('plan_id', $lastPlan)
                        ->orderBy('price', 'desc')
                        ->value('id');

                    $mpartners = Partner::where('user_id', $user->id)
                        ->where('id', '!=', $maxId)
                        ->where('show', 1)
                        ->where('period', 1)
                        ->where('plan_id', $lastPlan)
                        ->get();

                    $paid = 0;
                    $total = ($maxOne * 0.2);

                    if ($first == 1 && $second == 0 && $third == 0) {
                        $paid = $maxOne * 0.2;

                        foreach ($mpartners as $partner) {

                            $paid = $paid + ($partner->price * 0.1);
                            $total = $total + ($partner->price * 0.1);

                        }

                        $total = $total * 3;

                    }

                    if ($first == 1 && $second == 1 && $third == 0) {

                        $paid = $maxOne * 0.2;

                        foreach ($mpartners as $partner) {

                            $paid = $paid + ($partner->price * 0.1);
                            $total = $total + ($partner->price * 0.1);

                        }

                        $total = $total * 3;
                        $paid = $paid * 2;

                    }

                    if ($first == 1 && $second == 1 && $third == 1) {

                        $paid = $maxOne * 0.2;

                        foreach ($mpartners as $partner) {

                            $paid = $paid + ($partner->price * 0.1);
                            $total = $total + ($partner->price * 0.1);

                        }

                        $total = $total * 3;
                        $paid = $paid * 3;

                    }

                    $sub->total = $total;
                    $sub->paids = $paid;
                    $sub->save();

                }

                if ($mpartner == 1 && $dpartner == 1) {

                    $monthPartner = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 1)
                        ->where('plan_id', $lastPlan)
                        ->first();

                    $dailyPartner = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 0)
                        ->where('plan_id', $lastPlan)
                        ->first();

                    $dtotal = $dailyPartner->price + (0.1 * $dailyPartner->price);
                    $mtotal = ($monthPartner->price * 0.2);
                    $total = ($dtotal + $mtotal) * 3;

                    if ($first == 1 && $second == 0 && $third == 0) {

                        $dpaid = $dailyPartner->price + (0.1 * $dailyPartner->price);
                        $mpaid = ($monthPartner->price * 0.2);

                        $paid = ($dpaid + $mpaid);

                    }

                    if ($first == 1 && $second == 1 && $third == 0) {

                        $dpaid = $dailyPartner->price + (0.1 * $dailyPartner->price);
                        $mpaid = ($monthPartner->price * 0.2);

                        $paid = ($dpaid + $mpaid) * 2;

                    }

                    if ($first == 1 && $second == 1 && $third == 1) {

                        $dpaid = $dailyPartner->price + (0.1 * $dailyPartner->price);
                        $mpaid = ($monthPartner->price * 0.2);

                        $paid = ($dpaid + $mpaid) * 3;
                    }

                    $sub->total = $total;
                    $sub->paids = $paid;
                    $sub->save();

                }

                if ($mpartner == 1 && $dpartner == 0) {

                    $monthPartner = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 1)
                        ->where('plan_id', $lastPlan)
                        ->first();

                    $mtotal = ($monthPartner->price * 0.2);
                    $total = $mtotal * 3;

                    if ($first == 1 && $second == 0 && $third == 0) {

                        $mpaid = ($monthPartner->price * 0.2);

                        $paid = $mpaid;

                    }

                    if ($first == 1 && $second == 1 && $third == 0) {

                        $mpaid = ($monthPartner->price * 0.2);

                        $paid = $mpaid * 2;

                    }

                    if ($first == 1 && $second == 1 && $third == 1) {

                        $mpaid = ($monthPartner->price * 0.2);

                        $paid = $mpaid * 3;
                    }

                    $sub->total = $total;
                    $sub->paids = $paid;
                    $sub->save();

                }

                if ($dpartner == 1 && $mpartner == 0) {

                    $dailyPartner = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 0)
                        ->where('plan_id', $lastPlan)
                        ->first();

                    $dtotal = $dailyPartner->price + (0.1 * $dailyPartner->price);

                    $total = $dtotal * 3;

                    if ($first == 1 && $second == 0 && $third == 0) {

                        $dpaid = $dailyPartner->price + (0.1 * $dailyPartner->price);

                        $paid = $dpaid;

                    }

                    if ($first == 1 && $second == 1 && $third == 0) {

                        $dpaid = $dailyPartner->price + (0.1 * $dailyPartner->price);

                        $paid = $dpaid * 2;

                    }

                    if ($first == 1 && $second == 1 && $third == 1) {

                        $dpaid = $dailyPartner->price + (0.1 * $dailyPartner->price);

                        $paid = $dpaid * 3;
                    }

                    $sub->total = $total;
                    $sub->paids = $paid;
                    $sub->save();

                }

            }

            if ($lastPlan == 3) {

                $dpartner = Partner::where('user_id', $user->id)
                    ->where('show', 1)
                    ->where('period', 0)
                    ->where('plan_id', $lastPlan)
                    ->count();

                $mpartner = Partner::where('user_id', $user->id)
                    ->where('show', 1)
                    ->where('period', 1)
                    ->where('plan_id', $lastPlan)
                    ->count();

                if ($dpartner > 1 && $mpartner == 0) {

                    $maxOne = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 0)
                        ->where('plan_id', $lastPlan)
                        ->max('price');


                        $maxId = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 0)
                        ->where('plan_id', $lastPlan)
                        ->orderBy('price', 'desc')
                        ->value('id');

                    $dpartners = Partner::where('user_id', $user->id)
                        ->where('id', '!=', $maxId)
                        ->where('show', 1)
                        ->where('period', 0)
                        ->where('plan_id', $lastPlan)
                        ->get();

                    $paid = 0;
                    $total = $maxOne;

                    if ($first == 1 && $second == 0 && $third == 0) {
                        $paid = $maxOne;

                        foreach ($dpartners as $partner) {

                            $paid = $paid + ($partner->price * 0.1);
                            $total = $total + ($partner->price * 0.1);

                        }

                        $total = $total * 3;

                    }

                    if ($first == 1 && $second == 1 && $third == 0) {

                        $paid = $maxOne;

                        foreach ($dpartners as $partner) {

                            $paid = $paid + ($partner->price * 0.1);
                            $total = $total + ($partner->price * 0.1);

                        }

                        $total = $total * 3;
                        $paid = $paid * 2;

                    }

                    if ($first == 1 && $second == 1 && $third == 1) {

                        $paid = $maxOne;

                        foreach ($dpartners as $partner) {

                            $paid = $paid + ($partner->price * 0.1);
                            $total = $total + ($partner->price * 0.1);

                        }

                        $total = $total * 3;
                        $paid = $paid * 3;

                    }

                    $sub->total = $total;
                    $sub->paids = $paid;
                    $sub->save();

                }

                if ($mpartner > 1 && $dpartner == 0) {

                    $maxOne = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 1)
                        ->where('plan_id', $lastPlan)
                        ->max('price');

                           $maxId = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 1)
                        ->where('plan_id', $lastPlan)
                        ->orderBy('price', 'desc')
                        ->value('id');

                    $mpartners = Partner::where('user_id', $user->id)
                        ->where('id', '!=', $maxId)
                        ->where('show', 1)
                        ->where('period', 1)
                        ->where('plan_id', $lastPlan)
                        ->get();

                    $paid = 0;
                    $total = ($maxOne * 0.15);

                    if ($first == 1 && $second == 0 && $third == 0) {
                        $paid = $maxOne * 0.15;

                        foreach ($mpartners as $partner) {

                            $paid = $paid + ($partner->price * 0.05);
                            $total = $total + ($partner->price * 0.05);

                        }

                        $total = $total * 3;

                    }

                    if ($first == 1 && $second == 1 && $third == 0) {

                        $paid = $maxOne * 0.15;

                        foreach ($mpartners as $partner) {

                            $paid = $paid + ($partner->price * 0.05);
                            $total = $total + ($partner->price * 0.05);

                        }

                        $total = $total * 3;
                        $paid = $paid * 2;

                    }

                    if ($first == 1 && $second == 1 && $third == 1) {

                        $paid = $maxOne * 0.15;

                        foreach ($mpartners as $partner) {

                            $paid = $paid + ($partner->price * 0.05);
                            $total = $total + ($partner->price * 0.05);

                        }

                        $total = $total * 3;
                        $paid = $paid * 3;

                    }

                    $sub->total = $total;
                    $sub->paids = $paid;
                    $sub->save();

                }

                if ($mpartner > 1 && $dpartner > 1) {

                    $mmaxOne = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 1)
                        ->where('plan_id', $lastPlan)
                        ->max('price');

                    $dmaxOne = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 0)
                        ->where('plan_id', $lastPlan)
                        ->max('price');

                           $mmaxId = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 1)
                        ->where('plan_id', $lastPlan)
                        ->orderBy('price', 'desc')
                        ->value('id');

                    $mpartners = Partner::where('user_id', $user->id)
                        ->where('id', '!=', $mmaxId)
                        ->where('show', 1)
                        ->where('period', 1)
                        ->where('plan_id', $lastPlan)
                        ->get();

                           $dmaxId = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 0)
                        ->where('plan_id', $lastPlan)
                        ->orderBy('price', 'desc')
                        ->value('id');

                    $dpartners = Partner::where('user_id', $user->id)
                        ->where('id', '!=', $dmaxId)
                        ->where('show', 1)
                        ->where('period', 0)
                        ->where('plan_id', $lastPlan)
                        ->get();

                    $dpaid = 0;
                    $mpaid = 0;
                    $mtotal = $mmaxOne * 0.15;
                    $dtotal = $dmaxOne;

                    if ($first == 1 && $second == 0 && $third == 0) {
                        $mpaid = $mmaxOne * 0.15;
                        $dpaid = $dmaxOne;

                        foreach ($mpartners as $partner) {

                            $mpaid = $mpaid + ($partner->price * 0.05);
                            $mtotal = $mtotal + ($partner->price * 0.05);

                        }

                        foreach ($dpartners as $partner) {

                            $dpaid = $dpaid + ($partner->price * 0.1);
                            $dtotal = $dtotal + ($partner->price * 0.1);

                        }

                        $total = ($dtotal + $mtotal) * 3;
                        $paid = $dpaid + $mpaid ;

                    }

                    if ($first == 1 && $second == 1 && $third == 0) {

                        $mpaid = $mmaxOne * 0.15;
                        $dpaid = $dmaxOne;

                        foreach ($mpartners as $partner) {

                            $mpaid = $mpaid + ($partner->price * 0.05);
                            $mtotal = $mtotal + ($partner->price * 0.05);

                        }

                        foreach ($dpartners as $partner) {

                            $dpaid = $dpaid + ($partner->price * 0.1);
                            $dtotal = $dtotal + ($partner->price * 0.1);

                        }

                        $total = ($dtotal + $mtotal) * 3;
                        $paid = ($dpaid + $mpaid) * 2;

                    }

                    if ($first == 1 && $second == 1 && $third == 1) {

                        $mpaid = $mmaxOne * 0.15;
                        $dpaid = $dmaxOne;

                        foreach ($mpartners as $partner) {

                            $mpaid = $mpaid + ($partner->price * 0.05);
                            $mtotal = $mtotal + ($partner->price * 0.05);

                        }

                        foreach ($dpartners as $partner) {

                            $dpaid = $dpaid + ($partner->price * 0.1);
                            $dtotal = $dtotal + ($partner->price * 0.1);

                        }

                        $total = ($dtotal + $mtotal) * 3;
                        $paid = ($dpaid + $mpaid) * 3;

                    }

                    $sub->total = $total;
                    $sub->paids = $paid;
                    $sub->save();

                }

                if ($dpartner > 1 && $mpartner == 1) {

                    $maxOne = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 0)
                        ->where('plan_id', $lastPlan)
                        ->max('price');

                           $maxId = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 0)
                        ->where('plan_id', $lastPlan)
                        ->orderBy('price', 'desc')
                        ->value('id');

                    $dpartners = Partner::where('user_id', $user->id)
                        ->where('id', '!=', $maxId)
                        ->where('show', 1)
                        ->where('period', 0)
                        ->where('plan_id', $lastPlan)
                        ->get();

                    $partner = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 1)
                        ->where('plan_id', $lastPlan)
                        ->first();

                    $dpaid = 0;
                    $mpaid = 0;
                    $dtotal = $maxOne;
                    $mtotal = $partner->price * 0.15;

                    if ($first == 1 && $second == 0 && $third == 0) {
                        $dpaid = $maxOne;
                        $mpaid = $partner->price * 0.15;

                        foreach ($dpartners as $partner) {

                            $dpaid = $dpaid + ($partner->price * 0.1);
                            $dtotal = $dtotal + ($partner->price * 0.1);

                        }

                        $paid = $dpaid + $mpaid;
                        $total = ($mtotal + $dtotal) * 3;

                    }

                    if ($first == 1 && $second == 1 && $third == 0) {
                        $dpaid = $maxOne;
                        $mpaid = $partner->price * 0.15;

                        foreach ($dpartners as $partner) {

                            $dpaid = $dpaid + ($partner->price * 0.1);
                            $dtotal = $dtotal + ($partner->price * 0.1);

                        }

                        $paid = ($dpaid + $mpaid) * 2;
                        $total = ($mtotal + $dtotal) * 3;

                    }

                    if ($first == 1 && $second == 1 && $third == 1) {

                        $dpaid = $maxOne;
                        $mpaid = $partner->price * 0.15;

                        foreach ($dpartners as $partner) {

                            $dpaid = $dpaid + ($partner->price * 0.1);
                            $dtotal = $dtotal + ($partner->price * 0.1);

                        }

                        $paid = ($dpaid + $mpaid) * 3;
                        $total = ($mtotal + $dtotal) * 3;

                    }

                    $sub->total = $total;
                    $sub->paids = $paid;
                    $sub->save();

                }

                if ($mpartner > 1 && $dpartner == 1) {

                    $maxOne = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 1)
                        ->where('plan_id', $lastPlan)
                        ->max('price');

                           $maxId = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 1)
                        ->where('plan_id', $lastPlan)
                        ->orderBy('price', 'desc')
                        ->value('id');

                    $mpartners = Partner::where('user_id', $user->id)
                        ->where('id', '!=', $maxId)
                        ->where('show', 1)
                        ->where('period', 1)
                        ->where('plan_id', $lastPlan)
                        ->get();

                    $partner = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 0)
                        ->where('plan_id', $lastPlan)
                        ->first();

                    $dpaid = 0;
                    $mpaid = 0;
                    $dtotal = $partner->price;
                    $mtotal = $maxOne * 0.15;

                    if ($first == 1 && $second == 0 && $third == 0) {
                        $dpaid = $partner->price;
                        $mpaid = $maxOne * 0.15;

                        foreach ($mpartners as $partner) {

                            $mpaid = $mpaid + ($partner->price * 0.05);
                            $mtotal = $mtotal + ($partner->price * 0.05);

                        }

                        $paid = ($mpaid + $dpaid);
                        $total = ($dtotal + $mtotal) * 3;

                    }

                    if ($first == 1 && $second == 1 && $third == 0) {

                        $dpaid = $partner->price;
                        $mpaid = $maxOne * 0.15;

                        foreach ($mpartners as $partner) {

                            $mpaid = $mpaid + ($partner->price * 0.05);
                            $mtotal = $mtotal + ($partner->price * 0.05);

                        }

                        $paid = ($mpaid + $dpaid) * 2;
                        $total = ($dtotal + $mtotal) * 3;

                    }

                    if ($first == 1 && $second == 1 && $third == 1) {

                        $dpaid = $partner->price;
                        $mpaid = $maxOne * 0.15;

                        foreach ($mpartners as $partner) {

                            $mpaid = $mpaid + ($partner->price * 0.05);
                            $mtotal = $mtotal + ($partner->price * 0.05);

                        }

                        $paid = ($mpaid + $dpaid) * 3;
                        $total = ($dtotal + $mtotal) * 3;

                    }

                    $sub->total = $total;
                    $sub->paids = $paid;
                    $sub->save();

                }

                if ($mpartner == 1 && $dpartner == 1) {

                    $monthPartner = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 1)
                        ->where('plan_id', $lastPlan)
                        ->first();

                    $dailyPartner = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 0)
                        ->where('plan_id', $lastPlan)
                        ->first();

                    $dtotal = $dailyPartner->price;
                    $mtotal = ($monthPartner->price * 0.15);
                    $total = ($dtotal + $mtotal) * 3;

                    if ($first == 1 && $second == 0 && $third == 0) {

                        $dpaid = $dailyPartner->price;
                        $mpaid = ($monthPartner->price * 0.15);

                        $paid = ($dpaid + $mpaid);

                    }

                    if ($first == 1 && $second == 1 && $third == 0) {

                        $dpaid = $dailyPartner->price;
                        $mpaid = ($monthPartner->price * 0.15);

                        $paid = ($dpaid + $mpaid) * 2;

                    }

                    if ($first == 1 && $second == 1 && $third == 1) {

                        $dpaid = $dailyPartner->price;
                        $mpaid = ($monthPartner->price * 0.15);

                        $paid = ($dpaid + $mpaid) * 3;
                    }

                    $sub->total = $total;
                    $sub->paids = $paid;
                    $sub->save();

                }

                if ($dpartner == 1 && $mpartner == 0) {

                    $maxOne = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 0)
                        ->where('plan_id', $lastPlan)
                        ->max('price');

                    $paid = 0;
                    $total = $maxOne;

                    if ($first == 1 && $second == 0 && $third == 0) {
                        $paid = $maxOne;

                        $total = $total * 3;

                    }

                    if ($first == 1 && $second == 1 && $third == 0) {

                        $total = $total * 3;
                        $paid = $maxOne * 2;

                    }

                    if ($first == 1 && $second == 1 && $third == 1) {

                        $total = $total * 3;
                        $paid = $maxOne * 3;

                    }

                    $sub->total = $total;
                    $sub->paids = $paid;
                    $sub->save();

                }

                if ($mpartner == 1 && $dpartner == 0) {

                    $maxOne = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 1)
                        ->where('plan_id', $lastPlan)
                        ->max('price');

                    $paid = 0;
                    $total = ($maxOne * 0.15);

                    if ($first == 1 && $second == 0 && $third == 0) {
                        $paid = $maxOne * 0.15;

                        $total = $total * 3;

                    }

                    if ($first == 1 && $second == 1 && $third == 0) {

                        $paid = ($maxOne * 0.15) * 2;

                        $total = $total * 3;

                    }

                    if ($first == 1 && $second == 1 && $third == 1) {

                        $total = $total * 3;
                        $paid = ($maxOne * 0.15) * 3;

                    }

                    $sub->total = $total;
                    $sub->paids = $paid;
                    $sub->save();

                }

            }

            if ($lastPlan == 4) {

                $dpartner = Partner::where('user_id', $user->id)
                    ->where('show', 1)
                    ->where('period', 0)
                    ->where('plan_id', $lastPlan)
                    ->count();

                $mpartner = Partner::where('user_id', $user->id)
                    ->where('show', 1)
                    ->where('period', 1)
                    ->where('plan_id', $lastPlan)
                    ->count();

                if ($dpartner > 2 && $mpartner == 0) {

                    $maxPrices = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 0)
                        ->where('plan_id', $lastPlan)
                        ->orderBy('price', 'desc')
                        ->limit(2)
                        ->pluck('price');

                        $maxIds = Partner::where('user_id', $user->id)
                    ->where('show', 1)
                    ->where('period', 0)
                    ->where('plan_id', $lastPlan)
                    ->orderBy('price', 'desc')
                    ->limit(2)
                    ->pluck('id');




                    $maxId = $maxIds[0] ?? null;
                    $secondId = $maxIds[1] ?? null;

                    $maxPrice = $maxPrices[0] ?? null;
                    $secondMaxPrice = $maxPrices[1] ?? null;

                    $dpartners = Partner::where('user_id', $user->id)
                    ->where('id', '!=', $maxId)
                    ->where('id', '!=', $secondId)
                    ->where('show', 1)
                    ->where('period', 0)
                    ->where('plan_id', $lastPlan)
                    ->get();

                    $dpaid = 0;
                    $total = $maxPrice + $secondMaxPrice;

                    if ($first == 1 && $second == 0 && $third == 0) {
                        $dpaid = $maxPrice + $secondMaxPrice;

                        foreach ($dpartners as $partner) {

                            $dpaid = $dpaid + ($partner->price * 0.1);
                            $total = $total + ($partner->price * 0.1);

                        }

                        $total = $total * 3;

                    }

                    if ($first == 1 && $second == 1 && $third == 0) {

                        $dpaid = $maxPrice + $secondMaxPrice;

                        foreach ($dpartners as $partner) {

                            $dpaid = $dpaid + ($partner->price * 0.1);
                            $total = $total + ($partner->price * 0.1);

                        }

                        $total = $total * 3;
                        $dpaid = $dpaid * 2;

                    }

                    if ($first == 1 && $second == 1 && $third == 1) {

                        $dpaid = $maxPrice + $secondMaxPrice;

                        foreach ($dpartners as $partner) {

                            $dpaid = $dpaid + ($partner->price * 0.1);
                            $total = $total + ($partner->price * 0.1);

                        }

                        $total = $total * 3;
                        $dpaid = $dpaid * 3;

                    }

                    $sub->total = $total;
                    $sub->paids = $paid;
                    $sub->save();

                }

                if ($mpartner > 1 && $dpartner == 0) {

                    $maxOne = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 1)
                        ->where('plan_id', $lastPlan)
                        ->max('price');



                    $mpaid = 0;
                    $total = ($maxOne * 0.2);

                    if ($first == 1 && $second == 0 && $third == 0) {
                        $mpaid = $maxOne * 0.2;

                        foreach ($mpartners as $partner) {

                            $mpaid = $mpaid + ($partner->price * 0.1);
                            $total = $total + ($partner->price * 0.1);

                        }

                        $total = $total * 3;

                    }

                    if ($first == 1 && $second == 1 && $third == 0) {

                        $mpaid = $maxOne * 0.2;

                        foreach ($mpartners as $partner) {

                            $mpaid = $mpaid + ($partner->price * 0.1);
                            $total = $total + ($partner->price * 0.1);

                        }

                        $total = $total * 3;
                        $paid = $mpaid * 2;

                    }

                    if ($first == 1 && $second == 1 && $third == 1) {
                        $mpaid = $maxOne * 0.2;

                        foreach ($mpartners as $partner) {

                            $mpaid = $mpaid + ($partner->price * 0.1);
                            $total = $total + ($partner->price * 0.1);

                        }

                        $total = $total * 3;
                        $paid = $mpaid * 3;

                    }

                    $sub->total = $total;
                    $sub->paids = $paid;
                    $sub->save();

                }

                if ($mpartner > 1 && $dpartner > 2) {

                    $mmaxOne = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 1)
                        ->where('plan_id', $lastPlan)
                        ->max('price');

                    $maxPrices = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 0)
                        ->where('plan_id', $lastPlan)
                        ->orderBy('price', 'desc')
                        ->limit(2)
                        ->pluck('price');

                    $maxPrice = $maxPrices[0] ?? null;
                    $secondMaxPrice = $maxPrices[1] ?? null;

                    $dpaid = 0;
                    $mpaid = 0;
                    $mtotal = $mmaxOne * 0.2;
                    $dtotal = $maxPrice + $secondMaxPrice;

                    if ($first == 1 && $second == 0 && $third == 0) {
                        $mpaid = $mmaxOne * 0.2;
                        $dpaid = $maxPrice + $secondMaxPrice;

                        foreach ($mpartners as $partner) {

                            $mpaid = $mpaid + ($partner->price * 0.1);
                            $mtotal = $mtotal + ($partner->price * 0.1);

                        }

                        foreach ($dpartners as $partner) {

                            $dpaid = $dpaid + ($partner->price * 0.1);
                            $dtotal = $dtotal + ($partner->price * 0.1);

                        }

                        $total = ($dtotal + $mtotal) * 3;
                        $paid = ($dpaid + $dtotal);

                    }

                    if ($first == 1 && $second == 1 && $third == 0) {

                        $mpaid = $mmaxOne * 0.2;
                        $dpaid = $maxPrice + $secondMaxPrice;

                        foreach ($mpartners as $partner) {

                            $mpaid = $mpaid + ($partner->price * 0.1);
                            $mtotal = $mtotal + ($partner->price * 0.1);

                        }

                        foreach ($dpartners as $partner) {

                            $dpaid = $dpaid + ($partner->price * 0.1);
                            $dtotal = $dtotal + ($partner->price * 0.1);

                        }

                        $total = ($dtotal + $mtotal) * 3;
                        $paid = ($dpaid + $mpaid) * 2;

                    }

                    if ($first == 1 && $second == 1 && $third == 1) {

                        $mpaid = $mmaxOne * 0.2;
                        $dpaid = $maxPrice + $secondMaxPrice;

                        foreach ($mpartners as $partner) {

                            $mpaid = $mpaid + ($partner->price * 0.1);
                            $mtotal = $mtotal + ($partner->price * 0.1);

                        }

                        foreach ($dpartners as $partner) {

                            $dpaid = $dpaid + ($partner->price * 0.1);
                            $dtotal = $dtotal + ($partner->price * 0.1);

                        }

                        $total = ($dtotal + $mtotal) * 3;
                        $paid = ($dpaid + $mpaid) * 3;

                    }

                    $sub->total = $total;
                    $sub->paids = $paid;
                    $sub->save();

                }

                if ($dpartner > 2 && $mpartner == 1) {

                    $maxPrices = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 0)
                        ->where('plan_id', $lastPlan)
                        ->orderBy('price', 'desc')
                        ->limit(2)
                        ->pluck('price');

                    $maxPrice = $maxPrices[0] ?? null;
                    $secondMaxPrice = $maxPrices[1] ?? null;

                    $partner = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 1)
                        ->where('plan_id', $lastPlan)
                        ->first();

                    $dpaid = 0;
                    $mpaid = 0;
                    $dtotal = $maxPrice + $secondMaxPrice;
                    $mtotal = $partner->price * 0.2;

                    if ($first == 1 && $second == 0 && $third == 0) {
                        $dpaid = $maxPrice + $secondMaxPrice;
                        $mpaid = $partner->price * 0.2;

                        foreach ($dpartners as $partner) {

                            $dpaid = $dpaid + ($partner->price * 0.1);
                            $dtotal = $dtotal + ($partner->price * 0.1);

                        }

                        $paid = $dpaid + $mpaid;
                        $total = ($mtotal + $dtotal) * 3;

                    }

                    if ($first == 1 && $second == 1 && $third == 0) {
                        $dpaid = $maxPrice + $secondMaxPrice;
                        $mpaid = $partner->price * 0.2;

                        foreach ($dpartners as $partner) {

                            $dpaid = $dpaid + ($partner->price * 0.1);
                            $dtotal = $dtotal + ($partner->price * 0.1);

                        }

                        $paid = ($dpaid + $mpaid) * 2;
                        $total = ($mtotal + $dtotal) * 3;

                    }

                    if ($first == 1 && $second == 1 && $third == 1) {

                        $dpaid = $maxPrice + $secondMaxPrice;
                        $mpaid = $partner->price * 0.2;

                        foreach ($dpartners as $partner) {

                            $dpaid = $dpaid + ($partner->price * 0.1);
                            $dtotal = $dtotal + ($partner->price * 0.1);

                        }

                        $paid = ($dpaid + $mpaid) * 3;
                        $total = ($mtotal + $dtotal) * 3;

                    }

                    $sub->total = $total;
                    $sub->paids = $paid;
                    $sub->save();

                }

                if ($mpartner > 1 && $dpartner == 1) {

                    $maxOne = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 1)
                        ->where('plan_id', $lastPlan)
                        ->max('price');

                    $partner = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 0)
                        ->where('plan_id', $lastPlan)
                        ->first();

                    $dpaid = 0;
                    $mpaid = 0;
                    $dtotal = $partner->price + (0.1 * $partner->price);
                    $mtotal = $maxOne * 0.2;

                    if ($first == 1 && $second == 0 && $third == 0) {
                        $dpaid = $partner->price + (0.1 * $partner->price);
                        $mpaid = $maxOne * 0.2;

                        foreach ($mpartners as $partner) {

                            $mpaid = $mpaid + ($partner->price * 0.1);
                            $mtotal = $mtotal + ($partner->price * 0.1);

                        }

                        $paid = ($mpaid + $dpaid);
                        $total = ($dtotal + $mtotal) * 3;

                    }

                    if ($first == 1 && $second == 1 && $third == 0) {

                        $dpaid = $partner->price + (0.1 * $partner->price);
                        $mpaid = $maxOne * 0.2;

                        foreach ($mpartners as $partner) {

                            $mpaid = $mpaid + ($partner->price * 0.1);
                            $mtotal = $mtotal + ($partner->price * 0.1);

                        }

                        $paid = ($mpaid + $dpaid) * 2;
                        $total = ($dtotal + $mtotal) * 3;

                    }

                    if ($first == 1 && $second == 1 && $third == 1) {

                        $dpaid = $partner->price + (0.1 * $partner->price);
                        $mpaid = $maxOne * 0.2;

                        foreach ($mpartners as $partner) {

                            $mpaid = $mpaid + ($partner->price * 0.1);
                            $mtotal = $mtotal + ($partner->price * 0.1);

                        }

                        $paid = ($mpaid + $dpaid) * 3;
                        $total = ($dtotal + $mtotal) * 3;

                    }

                    $sub->total = $total;
                    $sub->paids = $paid;
                    $sub->save();

                }

                if ($mpartner == 1 && $dpartner == 1) {

                    $monthPartner = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 1)
                        ->where('plan_id', $lastPlan)
                        ->first();

                    $dailyPartner = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 0)
                        ->where('plan_id', $lastPlan)
                        ->first();

                    $dtotal = $dailyPartner->price + (0.1 * $dailyPartner->price);
                    $mtotal = ($monthPartner->price * 0.2);
                    $total = ($dtotal + $mtotal) * 3;

                    if ($first == 1 && $second == 0 && $third == 0) {

                        $dpaid = $dailyPartner->price + (0.1 * $dailyPartner->price);
                        $mpaid = ($monthPartner->price * 0.2);

                        $paid = ($dpaid + $mpaid);

                    }

                    if ($first == 1 && $second == 1 && $third == 0) {

                        $dpaid = $dailyPartner->price + (0.1 * $dailyPartner->price);
                        $mpaid = ($monthPartner->price * 0.2);

                        $paid = ($dpaid + $mpaid) * 2;

                    }

                    if ($first == 1 && $second == 1 && $third == 1) {

                        $dpaid = $dailyPartner->price + (0.1 * $dailyPartner->price);
                        $mpaid = ($monthPartner->price * 0.2);

                        $paid = ($dpaid + $mpaid) * 3;
                    }

                    $sub->total = $total;
                    $sub->paids = $paid;
                    $sub->save();

                }

                if ($mpartner == 1 && $dpartner == 0) {

                    $monthPartner = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 1)
                        ->where('plan_id', $lastPlan)
                        ->first();

                    $mtotal = ($monthPartner->price * 0.2);
                    $total = $mtotal * 3;

                    if ($first == 1 && $second == 0 && $third == 0) {

                        $mpaid = ($monthPartner->price * 0.2);

                        $paid = $mpaid;

                    }

                    if ($first == 1 && $second == 1 && $third == 0) {

                        $mpaid = ($monthPartner->price * 0.2);

                        $paid = $mpaid * 2;

                    }

                    if ($first == 1 && $second == 1 && $third == 1) {

                        $mpaid = ($monthPartner->price * 0.2);

                        $paid = $mpaid * 3;
                    }

                    $sub->total = $total;
                    $sub->paids = $paid;
                    $sub->save();

                }

                if ($dpartner == 1 && $mpartner == 0) {

                    $dailyPartner = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 0)
                        ->where('plan_id', $lastPlan)
                        ->first();

                    $dtotal = $dailyPartner->price + (0.1 * $dailyPartner->price);

                    $total = $dtotal * 3;

                    if ($first == 1 && $second == 0 && $third == 0) {

                        $dpaid = $dailyPartner->price + (0.1 * $dailyPartner->price);

                        $paid = $dpaid;

                    }

                    if ($first == 1 && $second == 1 && $third == 0) {

                        $dpaid = $dailyPartner->price + (0.1 * $dailyPartner->price);

                        $paid = $dpaid * 2;

                    }

                    if ($first == 1 && $second == 1 && $third == 1) {

                        $dpaid = $dailyPartner->price + (0.1 * $dailyPartner->price);

                        $paid = $dpaid * 3;
                    }

                    $sub->total = $total;
                    $sub->paids = $paid;
                    $sub->save();
                }

                if ($mpartner > 1 && $dpartner == 2) {

                    $mmaxOne = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 1)
                        ->where('plan_id', $lastPlan)
                        ->max('price');

                    $maxPrices = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 0)
                        ->where('plan_id', $lastPlan)
                        ->orderBy('price', 'desc')
                        ->limit(2)
                        ->pluck('price');

                    $maxPrice = $maxPrices[0] ?? null;
                    $secondMaxPrice = $maxPrices[1] ?? null;

                    $dpaid = 0;
                    $mpaid = 0;
                    $mtotal = $mmaxOne * 0.2;
                    $dtotal = $maxPrice + (0.1 * $maxPrice) + ($secondMaxPrice * 0.1);

                    if ($first == 1 && $second == 0 && $third == 0) {
                        $mpaid = $mmaxOne * 0.2;
                        $dpaid = $maxPrice + (0.1 * $maxPrice) + ($secondMaxPrice * 0.1);

                        foreach ($mpartners as $partner) {

                            $mpaid = $mpaid + ($partner->price * 0.1);
                            $mtotal = $mtotal + ($partner->price * 0.1);

                        }

                        $total = ($dtotal + $mtotal) * 3;
                        $paid = ($dpaid + $dtotal);

                    }

                    if ($first == 1 && $second == 1 && $third == 0) {

                        $mpaid = $mmaxOne * 0.2;
                        $dpaid = $maxPrice + (0.1 * $maxPrice) + ($secondMaxPrice * 0.1);

                        foreach ($mpartners as $partner) {

                            $mpaid = $mpaid + ($partner->price * 0.1);
                            $mtotal = $mtotal + ($partner->price * 0.1);

                        }

                        $total = ($dtotal + $mtotal) * 3;
                        $paid = ($dpaid + $mpaid) * 2;

                    }

                    if ($first == 1 && $second == 1 && $third == 1) {

                        $mpaid = $mmaxOne * 0.2;
                        $dpaid = $maxPrice + (0.1 * $maxPrice) + ($secondMaxPrice * 0.1);

                        foreach ($mpartners as $partner) {

                            $mpaid = $mpaid + ($partner->price * 0.1);
                            $mtotal = $mtotal + ($partner->price * 0.1);

                        }

                        $total = ($dtotal + $mtotal) * 3;
                        $paid = ($dpaid + $mpaid) * 3;

                    }

                    $sub->total = $total;
                    $sub->paids = $paid;
                    $sub->save();

                }

                if ($dpartner == 2 && $mpartner == 1) {

                    $maxPrices = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 0)
                        ->where('plan_id', $lastPlan)
                        ->orderBy('price', 'desc')
                        ->limit(2)
                        ->pluck('price');

                    $maxPrice = $maxPrices[0] ?? null;
                    $secondMaxPrice = $maxPrices[1] ?? null;

                    $partner = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 1)
                        ->where('plan_id', $lastPlan)
                        ->first();

                    $dpaid = 0;
                    $mpaid = 0;
                    $dtotal = $maxPrice + (0.1 * $maxPrice) + ($secondMaxPrice * 0.1);
                    $mtotal = $partner->price * 0.2;

                    if ($first == 1 && $second == 0 && $third == 0) {
                        $dpaid = $maxPrice + (0.1 * $maxPrice) + ($secondMaxPrice * 0.1);
                        $mpaid = $partner->price * 0.2;

                        foreach ($dpartners as $partner) {

                            $dpaid = $dpaid + ($partner->price * 0.1);
                            $dtotal = $dtotal + ($partner->price * 0.1);

                        }

                        $paid = $dpaid + $mpaid;
                        $total = ($mtotal + $dtotal) * 3;

                    }

                    if ($first == 1 && $second == 1 && $third == 0) {
                        $dpaid = $maxPrice + (0.1 * $maxPrice) + ($secondMaxPrice * 0.1);
                        $mpaid = $partner->price * 0.2;

                        foreach ($dpartners as $partner) {

                            $dpaid = $dpaid + ($partner->price * 0.1);
                            $dtotal = $dtotal + ($partner->price * 0.1);

                        }

                        $paid = ($dpaid + $mpaid) * 2;
                        $total = ($mtotal + $dtotal) * 3;

                    }

                    if ($first == 1 && $second == 1 && $third == 1) {

                        $dpaid = $maxPrice + (0.1 * $maxPrice) + ($secondMaxPrice * 0.1);
                        $mpaid = $partner->price * 0.2;

                        foreach ($dpartners as $partner) {

                            $dpaid = $dpaid + ($partner->price * 0.1);
                            $dtotal = $dtotal + ($partner->price * 0.1);

                        }

                        $paid = ($dpaid + $mpaid) * 3;
                        $total = ($mtotal + $dtotal) * 3;

                    }

                    $sub->total = $total;
                    $sub->paids = $paid;
                    $sub->save();

                }

                if ($dpartner == 2 && $mpartner == 0) {

                    $maxPrices = Partner::where('user_id', $user->id)
                        ->where('show', 1)
                        ->where('period', 0)
                        ->where('plan_id', $lastPlan)
                        ->orderBy('price', 'desc')
                        ->limit(2)
                        ->pluck('price');

                    $maxPrice = $maxPrices[0] ?? null;
                    $secondMaxPrice = $maxPrices[1] ?? null;

                    $paid = $maxPrice + (0.1 * $maxPrice) + ($secondMaxPrice * 0.1);
                    $total = $maxPrice + (0.1 * $maxPrice) + ($secondMaxPrice * 0.1);

                    if ($first == 1 && $second == 0 && $third == 0) {
                        $paid = $paid;

                        $total = $total * 3;

                    }

                    if ($first == 1 && $second == 1 && $third == 0) {

                        $total = $total * 3;
                        $paid = $paid * 2;

                    }

                    if ($first == 1 && $second == 1 && $third == 1) {

                        $total = $total * 3;
                        $paid = $paid * 3;

                    }

                    $sub->total = $total;
                    $sub->paids = $paid;
                    $sub->save();

                }

            }

        }

        $sumPaid = $users->sum('paids');

        // Calculate the sum of 'total' for all users
        $sumTotal = $users->sum('total');
        // dd($sumTotal);

        return view('admin.users.report', compact('users', 'sumPaid', 'sumTotal'));

    }
}

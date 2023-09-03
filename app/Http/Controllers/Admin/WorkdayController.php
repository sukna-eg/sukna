<?php

namespace App\Http\Controllers\Admin;

use App\Models\Partner;
use App\Models\Workday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WorkDayRequest;

class WorkdayController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Partner::whereHas('workdays')->withCount(['workdays'=>function ($q){
            $q->whereStatus(1);
        }])->get();
        return view('admin.workdays.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $days=Workday::WORKDAYS;
        $partners = Partner::whereDoesntHave('workdays')->get();
        return view('admin.workdays.create',compact('days','partners'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $days=Workday::WORKDAYS;
        foreach ($days as $i => $day) {
            if ($request[$day['en']]) {
                $validator = Validator::make([
                    $day['en']."-from"=>$request[$day['en']."-from"],
                    $day['en']."-to"=>$request[$day['en']."-to"],
                    $day['en']=>$request[$day['en']],
                    ], [
                        $day['en']."-from" => 'date_format:H:i',
                        $day['en']."-to" => 'date_format:H:i',
                        $day['en'] =>"in:1,2,3,4,5,6,7"
                ]);
                if ($validator->fails()) {
                Workday::create([
                        'day'=>$day,
                        'from'=>"00:00:00",
                        'to'=>"00:00:00",
                        'status'=>0,
                        'partner_id'=>$request->partner_id,
                    ]);
                } else {
                    Workday::create([
                        'day'=>$day,
                        'from'=>$request[$day['en']."-from"],
                        'to'=>$request[$day['en']."-to"],
                        'status'=>1,
                        'partner_id'=>$request->partner_id,
                    ]);
                }
            }else{
                Workday::create([
                    'day'=>$day,
                    'from'=>"00:00:00",
                    'to'=>"00:00:00",
                    'status'=>0,
                    'partner_id'=>$request->partner_id,
                ]);
            }
        }

    return redirect()->route('admin.workdays.index')
                    ->with('success', 'Workdays has been added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $partner = Partner::with(['workdays'=>function ($q){
            $q->whereStatus(1);
        }])->findOrFail($id);

        return view('admin.workdays.show',compact('partner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $workday = Workday::findOrFail($id);
        return view('admin.workdays.edit',compact('workday'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WorkDayRequest $request, string $id)
    {
        $workday = Workday::findOrFail($id);
        $workday->update($request->all());

        return redirect()->route('admin.workdays.index')
                        ->with('success','Workday has been updated successfully');
    }

    public function editShiftWorkdays($id)
    {
        $partner = Partner::with('workdays')->findOrFail($id);
        $workdays=$partner->workdays;
        return view('admin.workdays.partner-workdays-edit',compact('workdays','partner'));
    }

    public function updateShiftWorkdays(Request $request,$id)
    {
        $partner = Partner::with('workdays')->findOrFail($id);
        foreach ($partner->workdays as $i => $day) {
            if ($request[$day->getTranslation('day','en') ]) {
                $validator = Validator::make([
                    $day->getTranslation('day','en') ."-from"=>$request[$day->getTranslation('day','en')."-from"],
                    $day->getTranslation('day','en') ."-to"=>$request[$day->getTranslation('day','en')."-to"],
                    $day->getTranslation('day','en') =>$request[$day->getTranslation('day','en') ],
                    ], [
                        $day->getTranslation('day','en')."-from" => 'date_format:H:i',
                        $day->getTranslation('day','en')."-to" => 'date_format:H:i',
                        $day->getTranslation('day','en') =>"in:1,2,3,4,5,6,7"
                ]);
                if ($validator->fails()) {
                $day->update([
                        'from'=>"00:00:00",
                        'to'=>"00:00:00",
                        'status'=>0,
                    ]);
                } else {

                    $day->update([
                        'from'=>$request[$day->getTranslation('day','en')."-from"],
                        'to'=>$request[$day->getTranslation('day','en')."-to"],
                        'status'=>1,
                    ]);
                }
            }else{
                $day->update([
                    'from'=>"00:00:00",
                    'to'=>"00:00:00",
                    'status'=>0,
                ]);
            }
        }

        return redirect()->route('admin.workdays.show',$partner->id)
                        ->with('success', 'Workdays has been updated successfully');

    }
}

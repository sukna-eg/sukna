<?php

namespace App\Http\Controllers\Admin;

use App\Models\CallCounter;
use App\Models\ViewCounter;
use Illuminate\Http\Request;
use App\Models\WhatsappCounter;
use App\Http\Controllers\Controller;

class CounterController extends Controller
{
    public function whatsapp()
    {
        $data = WhatsappCounter::all();
        return view('admin.counters.whatsapp',compact('data'));
    }

    public function call()
    {
        $data = CallCounter::all();
        return view('admin.counters.call',compact('data'));
    }
    
    public function view()
    {
        $data = ViewCounter::all();
        return view('admin.counters.view',compact('data'));
    }

}

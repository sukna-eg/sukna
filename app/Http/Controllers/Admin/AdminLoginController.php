<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminLoginRequest;

class AdminLoginController extends Controller
{
    public function getLogin(){
        return view('admin.login');
    }
    public function postLogin(AdminLoginRequest $request){

     $remember_me = $request->has('remember_me') ? true : false;
     if (auth()->guard('admin')->attempt(['email'=>$request->input('email'),'password'=>$request->input('password')],$remember_me)){
         return redirect()->route('admin.dashboard');
     }
     return redirect()->back()->withInput()->with(['error'=>__('Invalid credintials')]);
    }

    public function logout(){
        $guard=$this->getGuard();
        $guard->logout();
        return redirect()->route("admin.login-page");
    }

    public function getGuard(){
        return auth('admin');
    }
}

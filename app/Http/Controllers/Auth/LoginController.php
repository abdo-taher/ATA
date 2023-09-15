<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\loginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */


    public function loginForm(){
        return view('login');
    }
    public function checkup(loginRequest $request){

        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->status == 0){
                return back()->with(['fail'=>'الايميل مغلق الرجاء التواصل مع الادمن المسؤل']);
            }
            return redirect()->intended('/');
        }else{
            return back()->with(['fail'=>'خطا في اسم المستخدم او كلمة المرور ']);
        }
    }

    public function logout(){
        auth()->logout();
        return view('login');
    }



}

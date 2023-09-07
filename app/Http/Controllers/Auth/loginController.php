<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\loginRequest;
use App\Models\Admin\adminModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class loginController extends Controller
{
    public function login(){
        return view('login');
    }

    public function checkup(loginRequest $request){
        $username = $request->username;
        $password = $request->password;
        $remember_token = $request->has('remember_token') ? true : false ;

        if (auth()->guard('admin')->attempt(['username'=>$username,'password'=>$password],$remember_token)){
                return redirect()->route('index')->with(['success'=>'مرحبا بك مرة اخري ,' ]);
        }else{
            return redirect()->route('login')->with(['fail'=>'خطا في اسم المستخدم او كلمة المرور ']);
        }
    }

    public function exit(){
        Session::flush();
        return redirect()->route('login')->with(['logout'=>'تم تسجيل الخروج بنجاح']);
    }
}

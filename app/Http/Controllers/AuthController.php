<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class AuthController extends Controller
{
    public function login()
    {
        if (!empty(Auth::check())) {
            if (Auth::user()->user_type == 1) {
                return redirect('admin/dashboard');
            } elseif (Auth::user()->user_type == 2) {
                return redirect('teacher/dashboard');
            } elseif (Auth::user()->user_type == 3) {
                return redirect('student/dashboard');
            } elseif (Auth::user()->user_type == 4) {
                return redirect('parent/dashboard');
            }
        }
        return view('auth.login');
    }
    public function AuthLogin(Request $request)
    {
        $remember  = !empty($request->remember) ? true : false;

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], true)) {
            
            if (Auth::user()->user_types === 1) {
                return redirect('admin/dashboard');
            } elseif (Auth::user()->user_types === 2) {
                return redirect('teacher/dashboard');
            } elseif (Auth::user()->user_types === 3) {
                return redirect('student/dashboard');
            } elseif (Auth::user()->user_types === 4) {
                return redirect('parent/dashboard');
            }
        } else {
            return redirect()->back()->with('error', 'Please enter correct email and password');
        }
    }

// for forgot password
    public function forgotPassword(){
        return view('auth.forgot');
    }

    public function postForgotPassword(Request $request){
        $user = User::getEmailSingle($request->email);
       if(!empty($user)){

       }else{
        return redirect()->back()->with('error','User not found');
       }
    }


    public function Authlogout()
    {
        Auth::logout();
        return redirect('/');
    }
}

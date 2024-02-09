<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPasswordMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
            if (Auth::user()->is_deleted === 1) {
                Auth::logout();
                return redirect()->back()->with('error', 'Unauthorized access.');
            } else {
                if (Auth::user()->user_types === 1) {
                    return redirect('admin/dashboard');
                } elseif (Auth::user()->user_types === 2) {
                    return redirect('teacher/dashboard');
                } elseif (Auth::user()->user_types === 3) {
                    return redirect('student/dashboard');
                } elseif (Auth::user()->user_types === 4) {
                    return redirect('parent/dashboard');
                }
            }
        } else {
            return redirect()->back()->with('error', 'Please enter correct email and password');
        }
    }

    // for forgot password
    public function forgotPassword()
    {
        return view('auth.forgot');
    }

    public function postForgotPassword(Request $request)
    {
        $user = User::getEmailSingle($request->email);
        if (!empty($user)) {
            $user->remember_token = Str::random(30);
            $user->save();
            Mail::to($user->email)->send(new ForgotPasswordMail($user));

            return redirect()->back()->with('success', 'Reset link has been sent to your email');
        } else {
            return redirect()->back()->with('error', 'User not found');
        }
    }

    public function reset($remember_token)
    {
        $user = User::getTokenSingle($remember_token);
        if (!empty($user)) {
            $data['user'] = $user;
            return view('auth.reset', $data);
        } else {
            abort(404);
        }
    }

    public function postReset($token, Request $request)
    {
        if ($request->password === $request->cpassword) {
            $user = User::getTokenSingle($token);
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->save();
            return redirect(url(''))->with('Success', 'Password reset successful');
        } else {
            return redirect()->back()->with('error', 'Password and Confirm Password does not match');
        }
    }



    public function Authlogout()
    {
        Auth::logout();
        return redirect('/');
    }
}

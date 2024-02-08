<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if (Auth::check()) {
            $userType = Auth::user()->user_types;

            switch ($userType) {
                case 1:
                    return view('admin.dashboard');
                    break;
                case 2:
                    return view('teacher.dashboard');
                    break;
                case 3:
                    return view('student.dashboard');
                    break;
                case 4:
                    return view('parent.dashboard');
                    break;
                default:
                    return abort(403, 'Unauthorized action.');
            }
        } else {
            return redirect('/');
        }
    }
}

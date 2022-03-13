<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AdminDashboardLoginController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __invoke()
    {
        if(auth()->user()){
            return redirect()->route('users.index');
        }
        
        if (Auth::attempt(['email' => 'admin@admin.com', 'password' => 'password']) ){
            return redirect()->route('users.index');
        }else{
            return redirect()->route('login')->withErrors(['errorlogin'=>'فشل تسجيل الدخول كأدمن']);
        }
    }
}

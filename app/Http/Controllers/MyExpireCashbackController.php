<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\ExpireCashback;
class MyExpireCashbackController extends Controller
{
    //
    public function index(){
        return view('user.expire-cashbacks.index');
    }
}

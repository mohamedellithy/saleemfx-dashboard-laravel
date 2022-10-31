<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\User;
class ExpireCashbacksController extends Controller
{
    //

    public function index(){
        $users = User::where('role','!=',1)->get();
        foreach($users as $user):
            dd($user->total_cashback_can_withdraw());
        endforeach;
    }
}

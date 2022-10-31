<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\User;
class ExpireCashbacksController extends Controller
{
    //

    public function index(){
        $date_max_ended = strtotime("-".Options()->setting['max_date_cashback_withdraw']." months");
        $users = User::where('role','!=',1)->get();
        $items = [];
        foreach($users as $user):
            $items[$user->id]= $user->cashbacks()->where('cash_backs.created_at','>=',date('Y-m-d H:i:s',$date_max_ended))->sum('value');
        endforeach;
        //$user->total_cashback_can_withdraw() -
        dd($items);
    }
}

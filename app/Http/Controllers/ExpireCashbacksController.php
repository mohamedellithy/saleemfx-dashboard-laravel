<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\User;
use App\ExpireCashback;
class ExpireCashbacksController extends Controller
{
    //

    public function index(){
        $date_max_ended = strtotime("-".Options()->setting['max_date_cashback_withdraw']." months");
        $users = User::where('role','!=',1)->get();
        $items = [];
        foreach($users as $user):
            $rest_value = $user->total_cashback_can_withdraw() - $user->cashbacks()->where('cash_backs.created_at','>=',date('Y-m-d H:i:s',$date_max_ended))->sum('value');
            if($rest_value > 0):
                $user->expire_cashbacks()->create([
                    'value' => $rest_value
                ]);
            endif;
        endforeach;
    }
}

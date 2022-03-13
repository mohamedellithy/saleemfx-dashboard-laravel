<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\DataTables\affiliateesDataTable;
use App\DataTables\myProfitAffiliatesDataTable;
use App\DataTables\myProfitsOrderAffiliateDataTable;
use App\DataTables\EmployeeSalariesDataTable;
use App\User;
use Mail;
use App\Mail\InvitationAffiliateMail;
class AffiliateController extends Controller
{
    //

    public function create_affiliate(){
        return view('user.affiliates.index');
    }

    public function store_affiliate(Request $request){
        $request->merge(['inviter_id'=>auth()->user()->id]);

        $this->validate($request,[
            'inviter_id' => 'unique:affiliates,inviter_id'
        ]);

        $code_generate = sha1(auth()->user()->id.rand(10,1000).strtotime(date('Y-m-d h:i:s')));

        auth()->user()->affiliates()->create([
           'code_affiliate' => $code_generate
        ]);

        return redirect()->back()->with('message','تم انشاء حساب تسويق بالعمولة بنجاح ');
    }

    public function show_affiliatees(affiliateesDataTable $dataTable) {
         return $dataTable->render('user.affiliates.affiliatee');
    }

    public function my_profit_affiliatees(myProfitAffiliatesDataTable $dataTable){
        return $dataTable->render('user.affiliates.profit-affiliate');
    }

    public function order_withdraw_affiliatees(Request $request){
        $this->validate($request,[
           'value' => 'required|lte:'.auth()->user()->affiliates->value_profits()
        ]);

        $withdraw_value = auth()->user()->affiliates->withdraw()->create([
            'withdraw_value' => $request->value,
            'status'         => 0
        ]);

        if($withdraw_value){
            return redirect()->back()->with('message','تم ارسال الطلب ينجاح');
        }
    }

    public function affiliater_withdraws(myProfitsOrderAffiliateDataTable $dataTable,Request $request){
        return $dataTable->with('status',$request->query('status') ?? 0)->render('user.affiliates.affiliate-withdraws');
    }
    
    public function show_employee_salaries(EmployeeSalariesDataTable $dataTable){
        return $dataTable->render('user.affiliates.employee-salaries');
    }
    
    public function send_invitation_email(Request $request){
        
        $check_if_exist = User::where('email',$request->invitee_email)->exists();
        if(!$check_if_exist){
            try{
                Mail::to($request->invitee_email)
                ->send(new InvitationAffiliateMail());
                return redirect()->back()->with('message','تم ارسال الدعوة بنجاح ');
            }catch(\Exception $e){
                return redirect()->back()->withErrors($e->getMessage());
            }
        }
        
        return redirect()->back()->with('message','البريد الالكتروني الذي تقوم بدعوته موجود بالفعل يمكنك ارسال دعوة لاشخاض أخرين');
       
    }
    
    
}

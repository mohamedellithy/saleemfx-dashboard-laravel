<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\affiliatersDataTable;
use App\DataTables\ProfitAffiliateDataTable;
use App\DataTables\WithdrawProfitsOrderAffiliateDataTable;
use App\DataTables\ProfitAffiliateEmployeesDataTable;
use App\User;
use App\Affiliate;
use App\ProfitAffiliate;
use App\BalanceWithdraw;
class affiliatersController extends Controller
{
    //
    public function show_affiliaters(affiliatersDataTable $dataTable) {
         return $dataTable->render('admin.affiliaters.affiliaters-show');
    }

    public function profites_affiliaters(ProfitAffiliateDataTable $dataTable) {
         return $dataTable->render('admin.affiliaters.profits-show');
    }
    
    public function affiliates_employmees(ProfitAffiliateEmployeesDataTable $dataTable){
        return $dataTable->render('admin.affiliaters.employees-show');
    }

    public function show_affiliater_details(User $user){
        return view('admin.affiliaters.show-details',compact('user'));
    }

    public function affiliaters_withdraw_profits(WithdrawProfitsOrderAffiliateDataTable $dataTable,Request $request){
        return $dataTable->with('status',$request->query('status') ?? 0)->render('admin.affiliaters.withdrow-profits');
    }

    public function change_status($order_id,$status){
        $update_status = BalanceWithdraw::where('id',$order_id)->update(['status' => $status]);
        if($update_status){
            return redirect()->back()->with('message','تم تحديث حالة الطلب بنجاح');
        }
    }
    
    public function change_affiliter_position(Request $request,Affiliate $affiliate){
        $update_status = $affiliate->update(['employee' => $request->input('position')]);
        if($update_status){
            return redirect()->back()->with('message','تم تحديث حالة الطلب بنجاح');
        }
    }
    
     public function change_affiliater_commission(Request $request,Affiliate $affiliate){
        $update_status = $affiliate->update(['commission_value' => $request->input('commission_value')]);
        if($update_status){
            return redirect()->back()->with('message','تم تحديث حالة الطلب بنجاح');
        }
    }
    
    
    
    public function add_salary_employee(Request $request,Affiliate $affiliate){
        $create_salary = $affiliate->profits()->create([
            'value' => $request->input('value'),
            'salary'=>1
        ]);
        if($create_salary){
            return redirect()->back()->with('message','تم اضافة المرتب بنجاح الى المسوق');
        }
    }
    
    public function delete_salary_employee($id){
        $delete_salary = ProfitAffiliate::destroy($id);
        if($delete_salary){
            return redirect()->back()->with('message','تم حذف المرتب بنجاح');
        }
    }
    
    
    
    
}

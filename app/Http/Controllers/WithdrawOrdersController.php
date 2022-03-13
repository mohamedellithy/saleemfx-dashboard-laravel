<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\WithdrawOrdersDataTable;
use App\BalanceWithdraw;
class WithdrawOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function pending_order(WithdrawOrdersDataTable $dataTable)
    {
        //
        return $dataTable->with('status','pending')->render('admin.withdraw-orders.pending-orders');
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function others_order(WithdrawOrdersDataTable $dataTable,Request $request)
    {
        //
        return $dataTable->with('status',$request->query('status') ?? 1)->render('admin.withdraw-orders.others-orders');
    }

    function change_status($order_id,$status){
        $update_status = BalanceWithdraw::where('id',$order_id)->update(['status' => $status]);
        if($update_status){
            return redirect()->route('withdraw-orders-pending')->with('message','تم تحديث حالة الطلب بنجاح');
        }
    }


}

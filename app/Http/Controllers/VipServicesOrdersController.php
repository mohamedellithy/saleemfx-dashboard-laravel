<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\VipServicesOrdersDataTable;
use App\VipOrder;
class VipServicesOrdersController extends Controller
{
    //

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(VipServicesOrdersDataTable $dataTable)
    {
        //
        return $dataTable->render('admin.vip-services.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if(auth()->user()->vip_order->first()){
            return back()->withErrors(['errors_in_order_vip'=>'فشل انشاء الطلب الطلب موجود بالفعل']);
        }

        $create_vip_services_order =  auth()->user()->vip_order()->create([
           'status' => 0
        ]);

        if($create_vip_services_order){
            return redirect()->route('my-services.index')->with('message','تم ارفاق الطلب بنجاح');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function change_status($order_id,$status)
    {
        $update_status = VipOrder::where('id',$order_id)->update(['status' => $status]);
        if($update_status){
            $service = VipOrder::find($order_id);
            if($status == 1){
                $service->withdraw()->create([
                   'withdraw_value' => 0,
                ]);
            }else{
                $service->withdraw()->where('withdraw_value',0)->delete();
            }
            return redirect()->route('vip-services.index')->with('message','تم تحديث حالة الطلب بنجاح');
        }
    }
}

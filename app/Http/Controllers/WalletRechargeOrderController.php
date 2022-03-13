<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\WalletRechargeOrderDataTable;
use App\ModelWordpress\PaymentMethod;
use App\WalletRechargeOrder;
class WalletRechargeOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(WalletRechargeOrderDataTable $dataTable,Request $request)
    {

        if($request->query('status')){
           return $dataTable->with('status',$request->query('status'))->render('admin.wallet-orders.index');
        }
        return $dataTable->render('admin.wallet-orders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $wallet_order = WalletRechargeOrder::find($id);
        return view('admin.wallet-orders.show',compact('wallet_order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function change_status($id,$status)
    {
        //
        $change_status = WalletRechargeOrder::where('id',$id)->update(['status'=>$status]);
        if($change_status){
          return redirect()->back()->with('message','تم تحديث حالة الطلب بنجاح ');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelWordpress\PaymentMethod;
use App\WalletRechargeOrder;
class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $payments        = PaymentMethod::published()->get();
        $recharge_orders = auth()->user()->wallet_order;
        return view('user.my-wallet.index')->with([
            'payments'        =>$payments,
            'recharge_orders' =>$recharge_orders
        ]);
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
        $this->validate($request,[
            'payment_id'        => 'required|exists:App\ModelWordpress\PaymentMethod,ID',
            'value'             => 'required',
            'image'             => 'required|image|mimes:png,jpg,jpeg,gif,svg'
        ]);

        $wallet_recharge = auth()->user()->wallet_order()->create($request->all());
        if($wallet_recharge){
           ImagesController::store($request,$wallet_recharge);
        }
        return redirect()->route('my-wallet.index')->with('message','تم تقديم الطلب بنجاح ');
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
    public function update(Request $request, $id)
    {
        //
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
        $payment  = WalletRechargeOrder::find($id);
        $payment->images()->delete();
        $payment  = WalletRechargeOrder::destroy($id);
        if($payment){
            return redirect()->route('my-wallet.index')->with('message','تم الغاء الطلب بنجاح ');
        }
    }
}

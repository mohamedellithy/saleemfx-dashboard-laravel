<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ForexCompany;
use Illuminate\Support\Facades\Validator;
use App\ModelWordpress\PaymentMethod;
class MyCashbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $companies = ForexCompany::select('id','name_ar','name_en')->get();
        $payments  = PaymentMethod::published()->get();
        return view('user.cashbacks.index',compact('companies','payments'));
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
        $valid = $this->validate($request,[
            'value' => 'required|gte:'.(Options()->setting['min_cashback_withdraw'] ?? 25 ).'|lte:'.(auth()->user()->total_cashback_can_withdraw() - auth()->user()->withdraw_cashbacks_pendings_total() ),
            'wallet'=>'required',
            'wallet_account'=>'required'
        ]);

        if((strtotime(date('Y-m-1')) > strtotime(date('Y-m-d')) ) || ( strtotime(date('Y-m-d')) > strtotime(date('Y-m-5')) ) ){
            return back()->withErrors('عذرا يمكنك فقط طلب سحب ارصدتك خلال 1 - 5 من كل شهر');
        }

        auth()->user()->withdraw_form_cashbacks()->create([
            'withdraw_value' => $request->value,
            'wallet'         => $request->wallet,
            'wallet_account' => $request->wallet_account,
            'status'         => 0,
        ]);

        return back()->with('message','لقد تم ارفاق الطلب بنجاح');
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
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ServicesOrdersDataTable;
use App\ServicesOrder;
class ServicesOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ServicesOrdersDataTable $dataTable)
    {
        //
        return $dataTable->render('admin.services.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function change_status($order_id,$status)
    {
        $update_status = ServicesOrder::where('id',$order_id)->update(['status' => $status]);
        if($update_status){
            $service = ServicesOrder::find($order_id);
            if($status == 1){
                $service->withdraw()->create([
                   'withdraw_value' => $service->value,
                ]);
            }else{
                $service->withdraw()->where('withdraw_value',$service->value)->delete();
            }
            return redirect()->route('services-orders.index')->with('message','تم تحديث حالة الطلب بنجاح');
        }
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

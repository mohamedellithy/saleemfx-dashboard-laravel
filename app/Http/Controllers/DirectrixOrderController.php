<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DirectrixOrder;
use App\DataTables\DirectrixOrderDataTable;
class DirectrixOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DirectrixOrderDataTable $dataTable)
    {
        //
        return $dataTable->render('admin.directrix-files.index');
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
        auth()->user()->directrix_orders()->create([
           'directrix_file_id' => $request->input('directrix_file_id'),
           'status'         => 0
        ]);

        return back()->with('message','تم ارسال الطلب بنجاح سيتم مراجعتة من قبل الدعم');
    }

    public function change_status($id,$status){
        //
        $change_status = DirectrixOrder::where('id',$id)->update(['status'=>$status]);
        if($change_status){
          return redirect()->back()->with('message','تم تحديث حالة الطلب بنجاح ');
        }
    }
}

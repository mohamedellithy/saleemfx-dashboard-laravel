<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ExpertsFilesOrderDataTable;
use App\FileOrder;
class FileOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ExpertsFilesOrderDataTable $dataTable)
    {
        //
        return $dataTable->render('admin.experts-files.index');
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
        auth()->user()->file_orders()->create([
           'expert_file_id' => $request->input('expert_file_id'),
           'status'         => 0
        ]);

        return back()->with('message','تم ارسال الطلب بنجاح سيتم مراجعتة من قبل الدعم');
    }

    public function change_status($id,$status){
        //
        $change_status = FileOrder::where('id',$id)->update(['status'=>$status]);
        if($change_status){
          return redirect()->back()->with('message','تم تحديث حالة الطلب بنجاح ');
        }
    }
}

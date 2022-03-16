<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\AccountsDataTable;
use App\Account;
class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AccountsDataTable $dataTable,Request $request)
    {
        //
        $query_search   = [];

        if($request->query('from')):
          $query_search['from']  = $request->query('from');
          $query_search['to']  = $request->query('to');
        endif;

        if($query_search):
            return $dataTable->with($query_search)->render('admin.accounts.index');
        else:
            return $dataTable->render('admin.accounts.index');
        endif;

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
    public function update($account_id,$status)
    {
        $update_status = Account::where('id',$account_id)->update(['status' => $status]);
        if($update_status){
            return redirect()->route('accounts.index')->with('message','تم تحديث حالة الطلب بنجاح');
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

    public function update_accounts_status_bulk(Request $request){
        $this->validate($request,[
            'select-accounts' => 'required',
            'status'          => 'required'
        ]);

        $selectedAccounts = explode(',', $request->input('select-accounts'));
        $update_status = Account::whereIn('id',$selectedAccounts)->update(['status' => $request->input('status') ]);
        if($update_status){
            return redirect()->route('accounts.index')->with('message','تم تحديث الحسابات بنجاح');
        }
        return $selectedAccounts;

    }
}

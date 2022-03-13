<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use App\ModelWordpress\Services;
use App\User;
use App\ForexCompany;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $dataTable,Request $request)
    {
        //
        $forexCompanies = ForexCompany::all();
        $services       = Services::all();
        $query_search   = [];

        if($request->query('company')):
          $query_search['companyID']  = $request->query('company');
        endif;

        if($request->query('services')):
          $query_search['serviceID']  = $request->query('services');
        endif;

        if($request->query('vipOrders')):
          $query_search['vipOrders']  = $request->query('vipOrders');
        endif;

        if($request->query('cashbacks')):
          $query_search['cashbacks']  = $request->query('cashbacks');
        endif;

        if($query_search):
             return $dataTable->with($query_search)->render('admin.users.index',compact(['forexCompanies','services']));
        else:
            return $dataTable->render('admin.users.index',compact(['forexCompanies','services']));
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
        $user_info = User::find($id);
        return view('admin.users.show',compact('user_info'));
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
        $status = User::destroy($id);
        if($status){
            return redirect()->route('users.index')->with('message','تم حذف العنصر بنجاح');
        }
    }
}

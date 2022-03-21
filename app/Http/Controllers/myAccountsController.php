<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\myAccountsDataTable;
use Illuminate\Validation\Rule;
use App\Account;
use App\ForexCompany;
use Mail;
use App\Mail\NotifyNewAccountMail;
class myAccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(myAccountsDataTable $dataTable)
    {
        //
         $this->middleware('arabicfilter');
         $companies = ForexCompany::select('id','name_ar','name_en')->get();
         return $dataTable->render('user.my-accounts.index',compact('companies'));
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
            'select-companies' => [
                'required',
                'exists:forex_companies,id'
            ],
            'account_number'   => [
                'required',
                 Rule::unique('accounts','account_number')->where(function($query){
                    return $query->where('deleted_at', null);
                })
            ]
        ]);

        $insert_account = auth()->user()->accounts()->create([
           'forex_company_id' => $request->input('select-companies'),
           'account_number'   => $request->input('account_number'),
           'account_balance'  => $request->input('account_balance')
        ]);

        if($insert_account){
            try{
                Mail::to(\Config::get('app.Notify_Email'))
                ->send(new NotifyNewAccountMail());
                return redirect()->route('my-accounts.index')->with('message','تم اضافة حساب الشركة بنجاح');
            }catch(\Exception $e){
                return redirect()->back()->withErrors($e->getMessage());
            }
        }
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
        $account = Account::find($id);
        return view('user.my-accounts.edit',compact('account'));
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

         $this->validate($request,[
            'account_balance'   => 'required'
        ]);


        $update_account = auth()->user()->accounts()->where('id',$id)->update([
           'account_balance'  => $request->input('account_balance')
        ]);

        if($update_account){
           return redirect()->back()->with('message','تم تعديل حساب الشركة بنجاح');
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
        $status = Account::destroy($id);
        if($status){
            return redirect()->route('my-accounts.index')->with('message','تم حذف العنصر بنجاح');
        }
    }
}

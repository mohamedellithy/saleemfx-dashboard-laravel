<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\CashBackDataTable;
use Illuminate\Validation\Rule;
use App\CashBack;
use App\Account;
use App\User;
use App\Affiliate;
use App\DataTables\AccountsCashBackDataTable;
use App\Imports\CashBacksImport;
use Maatwebsite\Excel\Facades\Excel;
class CashBackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CashBackDataTable $dataTable,Request $request)
    {
        //
        $query_search   = [];

        if($request->query('from')):
          $query_search['from']  = $request->query('from');
          $query_search['to']  = $request->query('to');
        endif;

        if($request->query('filter_cashbacks')):
            $query_search['filter_cashbacks'] = $request->query('filter_cashbacks');
        endif;

        if($query_search):
            return $dataTable->with($query_search)->render('admin.cashback-account.index');
        else:
            return $dataTable->render('admin.cashback-account.index');
        endif;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        if($request->query('ID')){
            $account_details = Account::find($request->query('ID'));
            return response()->json([
                'status'=>true,
                'html'=>view('admin.cashback-account.create',compact('account_details'))->render()
            ]);
        }
        return response()->json(['status'=>false]);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_cashback(AccountsCashBackDataTable $dataTable)
    {
        //
        $accounts = Account::get()->unique('forex_company_id');
        return $dataTable->render('admin.cashback-account.create-cashback',compact('accounts'));

    }

    public function create_import_cashback(){
        return view('admin.cashback-account.import-cashback');
    }


    public function store_import_cashback(Request $request){
        $this->validate($request,[
           'xlx_file' => 'required|mimes:csv,xlsx,xls'
        ]);
        try{
            Excel::import(new CashBacksImport, $request->file('xlx_file'));
        }catch(Exception $e){
           return redirect()->back()->withErrors(['error'=>'حدث خطأ اثناء استيراد الداتا']);
        }

        return redirect()->route('cashback-accounts.index')->with('message','تم استيراد الداتا بنجاح');
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
            'user_id'    => 'sometimes|exists:users,id',
            'company_id' => 'required|exists:forex_companies,id',
            'value'      => 'required|min:0',
            'month'      => 'required'
        ]);

        $accounts_data['status'] =  1;

        if($request->has('user_id')):
            $accounts_data['user_id']      =  $request->user_id;
        endif;

        if($request->has('company_id')):
            $accounts_data['forex_company_id'] =  $request->company_id;
        endif;

        $accounts = Account::where($accounts_data)->get();

        $this->validate($request,[
            'month' => Rule::unique('cash_backs')->where(function($query) use ($accounts){
                return $query->whereIn('account_id',$accounts->pluck('id')->toArray())->where('deleted_at',null);
            })
        ]);

        if($accounts):
            foreach($accounts as $account):
                $update_cashback = $account->cashback()->create($request->only([
                    'value','month'
                ]));

                # here add value affiliates to account that have it
                if($account->user->is_invited_by_affiliate()):
                    $account->user->affiliatee->profits()->create([
                        'value'=>  self::affiliate_profit($request->value,$account->user->affiliatee->id),
                        'invitee_id'=>$account->user->id
                    ]);
                endif;

            endforeach;
        endif;

        if($update_cashback){
            return redirect()->route('cashback-accounts.index')->with('message','تم اضافة العنصر بنجاح');
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
        if($id){
            $cashback_details = Cashback::find($id);
            return response()->json([
                'status'=>true,
                'html'=>view('admin.cashback-account.edit',compact('cashback_details'))->render()
            ]);
        }
        return response()->json(['status'=>false]);
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
        $cashback = Cashback::find($id);
        $this->validate($request,[
            'value' => 'required|min:0',
            'month' =>[
                'required',
                Rule::unique('cash_backs')->where(function($query) use ($cashback){
                    return $query->where('account_id',$cashback->account_id)->where('deleted_at',null);
                })->ignore($id)
            ]
        ]);


        $update_cashback = CashBack::where('id', $id)->update($request->only([
            'value','month'
        ]));

        # here add value affiliates to account that have it
        if($cashback->account->user->is_invited_by_affiliate()):
            $cashback->account->user->affiliatee->profits()->where([
                'value'     => self::affiliate_profit($cashback->value,$cashback->account->user->affiliatee->id),
                'invitee_id'=> $cashback->account->user->id,
                'created_at'=> $cashback->created_at
            ])->update([
                'value'=>  self::affiliate_profit($request->value,$cashback->account->user->affiliatee->id),
            ]);
        endif;

        if($update_cashback){
            return redirect()->route('cashback-accounts.index')->with('message','تم تعديل العنصر بنجاح');
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
        $cashback = Cashback::find($id);
        # here delete value affiliates to account that have it
        if($cashback->account->user->is_invited_by_affiliate()):
            $cashback->account->user->affiliatee->profits()->where([
                'value'     => self::affiliate_profit($cashback->value,$cashback->account->user->affiliatee->id),
                'invitee_id'=> $cashback->account->user->id,
                'created_at'=> $cashback->created_at
            ])->delete();
        endif;

        if($cashback->delete()){
            return redirect()->back()->with('message','تم حذف العنصر بنجاح');
        }
    }

    public static function affiliate_profit($value,$affiliate_id){
        $affiliate = Affiliate::find($affiliate_id);
        return ($value * ($affiliate->commission_value ? $affiliate->commission_value : Options()->setting['affiliate_value']) ) / 100;
    }

    public function delete_cashbacks_selected(Request $request){
        return response()->json([
            'test' => $request->input('cashback_ids'),
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelWordpress\Services;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;
use App\Account;
class MyServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $services    = Services::all();
        return view('user.my-services.index',compact(['services']));
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
            $services_details = Services::find($request->query('ID'));
            $type             = $request->query('type_form');
            $orderId          = $request->query('order_id');
            
            $accounts_forex   = null;
            if($services_details->meta->minimum_subscription){
                if($request->query('account_id')):
                    $accounts_forex = auth()->user()->active_accounts->where('id',$request->query('account_id'))->first();
                else:
                    $accounts_forex = auth()->user()->active_accounts->first();
                endif;
                
            }
            return response()->json([
                'status'=>true,
                'html'=>view('user.my-services.create-order',compact(['services_details','accounts_forex','type','orderId']))->render()
            ]);
        }
        return response()->json(['status'=>false]);
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
        $request->merge([
           'user_id' => auth()->user()->id
        ]);
        
        $this->validate($request,[
           'service_id'  => 'required|exists:App\ModelWordpress\Services,ID',
           'account_id'     => array(
               'sometimes',
               'exists:accounts,id',
                Rule::unique('services_orders')->where(function($query) use ($request){
                    return $query->where([
                       'service_id'=>$request->service_id,
                       'user_id'   => auth()->user()->id
                    ]);
                })
            ),
            'user_id'     => array(
               'sometimes',
               'exists:users,id',
                Rule::unique('services_orders')->where(function($query) use ($request){
                    return $query->where([
                       'service_id'=>$request->service_id,
                       'account_id'=>$request->account_id
                    ]);
                })
            )
        ]);

        $data_order = [
            'service_id' => $request->service_id,
            'value'      => $request->value * $request->period,
            'user_id'    => auth()->user()->id
        ];
        
        $account_forex = Account::find($request->input('account_id'));

        if(!auth()->user()->not_have_accounts):
            if(!$account_forex):
                  return redirect()->route('my-services.index')->withErrors(['Not_found_balance'=>'الحد الادني للاشتراك فى الخدمة أعلى من قيمة مبلغ تداولك فى الشركة']);
            endif;

        endif;
        
        if(auth()->user()->total_balance() < ($request->value * $request->period) ):
            return redirect()->route('my-services.index')->withErrors(['Not_found_balance'=>'ليس لديك رصيد كافي للاستراك فى الخدمة']);
        endif;
        
        $data_order['expire_at'] = date('Y-m-d h:i:s', strtotime('+'.$request->period.' months '));
        
        if($account_forex):
            $create_order_services = $account_forex->services_orders()->create($data_order);
        else:
            $create_order_services = auth()->user()->services_orders()->create($data_order);
        endif;

        if($create_order_services){
            return redirect()->route('my-services.index')->with('message','تم اضافة العنصر بنجاح');
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
           'value'       => 'required',
           'service_id'  => 'required|exists:App\ModelWordpress\Services,ID',
           'period'      => 'required'
        ]);

        if(auth()->user()->total_balance() < ($request->value * $request->period) ){
            return redirect()->route('my-services.index')->withErrors(['Not_found_balance'=>'ليس لديك رصيد كافي للاستراك فى الخدمة']);
        }
        
        $data = [
           'value'      => $request->value * $request->period,
           'expire_at'  => date('Y-m-d h:i:s', strtotime('+'.$request->period.' months ')),
           'status'     => 0
        ];
        
        if($request->has('account_id')){
             $data['account_id'] = $request->input('account_id');
        }
        
        $update_order_services = auth()->user()->services_orders()->where('id',$id)->update($data);

        if($update_order_services){
            return redirect()->route('my-services.index')->with('message','تم تعديل الطلب بنجاح');
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

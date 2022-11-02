<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Account extends Model
{
    //
    use SoftDeletes;
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','user_id','forex_company_id', 'account_number','account_balance','status'
    ];

    public function forex_company(){
        return $this->belongsTo('App\ForexCompany','forex_company_id','id')->withTrashed();;
    }

    public function user(){
        return $this->belongsTo('App\User','user_id','id')->withTrashed();;
    }

    public function cashback(){
        return $this->hasMany('App\CashBack','account_id','id')->withTrashed();;
    }

    public function getAccountBalanceAttribute($value){
        return $value;
    }


    public function services_orders(){
        return $this->hasMany('App\ServicesOrder','account_id','id');
    }

    function getServiceIsOrderedAttribute($service_id){
        /* service_is_ordered */
        return $this->services_orders()->where('service_id',$service_id)->exists();
    }





    function getServiceIsPendedAttribute($service_id){
        /* service_is_pended */
        return $this->services_orders()->where([
            'service_id'=>$service_id,
            'status'    =>0
        ])->exists();
    }

    function GETServiceIsExpiredAttribute($service_id){
        /* service_is_expired */
        return $this->services_orders()->where([
            'service_id'=>$service_id,
            'status'    =>1
        ])->where('expire_at','<',date('Y-m-d H:i:s'))->exists();
    }

    function ScopeServiceIsActivated($query,$service_id){
        /* service_is_activated */
        return $this->services_orders()->where([
            'service_id'=>$service_id,
            'status'    =>1
        ])->where('expire_at','>=',date('Y-m-d H:i:s'))->exists();
    }

     function getServicesIsRefusedAttribute($service_id){
        /* service_is_refused */
        return $this->services_orders()->where([
            'service_id'=>$service_id,
            'status'    =>2
        ])->exists();
    }

    public function GetStatusTextAttribute(){
        # status_text
        # 0 -> pending , 1 -> accepted , 2 -> refused , 3 -> ended
        if($this->status == 0)
            $status =  __('master.pending');

        if($this->status == 1)
            $status = __('master.accepted');

        if($this->status == 2)
           $status = __('master.refused');

        if($this->status == 3)
           $status = __('master.ended_order');

        return '<label style="width:100px;font-size: 12px;text-align: center;" class="status-label status-'.$this->status.'">'.$status.'</label>';
    }
}

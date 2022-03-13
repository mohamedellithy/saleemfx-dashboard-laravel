<?php

namespace App\ModelWordpress;

use Corcel\Model\Post as Corcel;
use Illuminate\Database\Eloquent\Model;
class Services extends Corcel
{
    //
    protected $connection = 'wordpress';
    protected $postType = 'services';

    public function orders(){
        return $this->hasMany(\App\ServicesOrder::class,'service_id','ID');
    }

    public function ScopeNotHaveOrders($query){
       $services_ids = auth()->user()->services_orders != null ? auth()->user()->services_orders->pluck('service_id')->toArray() : array();
       return $query->whereNotIn('ID',$services_ids);
    }

    public function getCanHaveServicesAttribute(){
        // can_have_services
        return ($this->meta->minimum_subscription <= auth()->user()->account_balance_value);
    }

    public function getNotAllowedToUserAttribute(){
        // not_allowed_to_user
        $order = $this->orders()->where('status','!=' ,1)->where('user_id',auth()->user()->id)->get();
        return empty($order) ? true : false;
    }

    public function getUserNotHaveOrderAttribute(){
        // user_not_have_order
        return !$this->orders()->where('user_id',auth()->user()->id)->exists();
    }

    public function getUserHaveOrderExpiredAttribute(){
        // user_have_order_expired
        return $this->orders()->where('user_id',auth()->user()->id)->where(function($q){
            $q->where('expire_at','<=',date('Y-m-d H:i:s'))->Where('expire_at','!=',null);
        })->exists();
    }

    public function getUserHaveOrderAndAllowAttribute(){
        // user_have_order_and_allow
        return $this->orders()->where('user_id',auth()->user()->id)->where(function($q){
            $q->where('expire_at','>',date('Y-m-d H:i:s'))->orWhere('expire_at',null);
        })->exists();
    }
}

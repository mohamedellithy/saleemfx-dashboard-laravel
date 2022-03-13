<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Affiliate extends Model
{
    //

    protected $fillable = ['inviter_id','code_affiliate','employee','status','commission_value'];

    public function affiliatees(){
        return $this->hasMany('App\User','reference_affiliate_id','id');
    }

    public function affiliaters(){
        return $this->belongsTo('App\User','inviter_id','id');
    }

    public function profits(){
        return $this->hasMany('App\ProfitAffiliate','affiliate_id','id');
    }

    public function value_profits(){
        return $this->profits()->sum('value');
    }
    
    public function value_salaries(){
        return $this->profits()->where('salary',1)->sum('value');
    }
    
    public function value_comissions(){
        return $this->profits()->where('salary',0)->sum('value');
    }

    public function withdraw(){
        return $this->morphMany(BalanceWithdraw::class, 'withdrawable');
    }
    
    public function getEmployeeSalariesAttribute(){
        return $this->profits()->where('salary',1)->get();
    }
    
    public function getEmployeeComissionsAttribute(){
        return $this->profits()->where('salary',0)->get();
    }
    
    
}

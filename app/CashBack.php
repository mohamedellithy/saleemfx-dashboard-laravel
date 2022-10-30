<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CashBack extends Model
{
    //
    use SoftDeletes;
    protected $fillable = [
        'value','month','account_id'
    ];


    public function account(){
        return $this->belongsTo('App\Account','account_id','id')->withTrashed();
    }

    public function cashback_allow_to_withdraw(){
        $date_max_ended = strtotime("+".Options()->setting['max_date_cashback_withdraw']." months",strtotime($this->created_at));
        if($date_max_ended < time()  ):
            return false;
        endif;

        return true;
    }
}

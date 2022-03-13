<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BalanceWithdraw extends Model
{
    //
      //
    protected $fillable = ['withdrawable_id','withdrawable_type','withdraw_value','status','wallet','wallet_account'];

    /**
     * Get the parent commentable model (forex-companies or users and more).
     */
    public function Withdrawable(){
        return $this->morphTo();
    }


    public function GetStatusOrderAttribute(){
        # status_order
        # 0 -> pending , 1 -> accepted , 2 -> refused , 3 -> ended
        if($this->status == 0)
            $status =  'بانتظار تأكيد الدفع';

        if($this->status == 1)
            $status = 'تم الدفع';

        if($this->status == 2)
           $status = 'تم الرفض';

        return '<label style="font-size: 12px;" class="status-label status-'.$this->status.'">'.$status.'</label>';
    }


}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class VipOrder extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['status'];

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    public function GetStatusTextAttribute(){
        # status_text
        # 0 -> pending , 1 -> accepted , 2 -> refused , 3 -> ended
        if($this->status == 0)
            $status =  'قيد التنفيذ';

        if($this->status == 1)
            $status = 'تم الموافقة';

        if($this->status == 2)
           $status = 'تم الرفض';

        return '<label class="status-label status-'.$this->status.'">'.$status.'</label>';
    }

    public function withdraw(){
        return $this->morphMany(BalanceWithdraw::class, 'withdrawable');
    }
}

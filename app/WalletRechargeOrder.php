<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WalletRechargeOrder extends Model
{
    //
    protected $fillable = [
        'payment_id','user_id','value','notice','transaction_no','status',
    ];

    public function images(){
         return $this->morphMany(Image::class, 'imageable');
    }

    public function payment_method(){
        return $this->belongsTo(ModelWordpress\PaymentMethod::class, 'payment_id','ID');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function GetStatusOrderAttribute(){
        # status_order
        # 0 -> pending , 1 -> accepted , 2 -> refused , 3 -> ended
        if($this->status == 0)
            $status =  'قيد التنفيذ';

        if($this->status == 1)
            $status = 'تم الموافقة';

        if($this->status == 2)
           $status = 'تم الرفض';

        return '<label class="status-label status-'.$this->status.'">'.$status.'</label>';
    }
}

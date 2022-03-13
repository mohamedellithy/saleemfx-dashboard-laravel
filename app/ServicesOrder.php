<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicesOrder extends Model
{
    //
    protected $table    = 'services_orders';
    protected $connection = 'mysql';

    protected $fillable = ['service_id','value','user_id','expire_at'];

    // and setting it in the constructor also doesnt work
    public function __construct(array $attributes = [])
    {
        $this->setConnection('mysql');
        parent::__construct($attributes);
    }

    public function services(){
        return $this->belongsTo('App\ModelWordpress\Services','service_id','id');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
    
    public function acount(){
        return $this->belongsTo('App\Account','account_id','id');
    }

    public function withdraw(){
        return $this->morphMany(BalanceWithdraw::class, 'withdrawable');
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
}

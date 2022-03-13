<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashBack extends Model
{
    //
    protected $fillable = [
        'value','month','account_id'
    ];
    

    public function account(){
        return $this->belongsTo('App\Account','account_id','id');
    }
}

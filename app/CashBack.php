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
}

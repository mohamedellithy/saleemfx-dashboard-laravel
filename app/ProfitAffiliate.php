<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ProfitAffiliate extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['value','invitee_id','salary'];
    public function affiliater(){
        return $this->belongsTo('App\Affiliate','affiliate_id','id');
    }

    public function affiliatee(){
        return $this->belongsTo('App\User','invitee_id','id');
    }
    
    public function getSalariesAttribute(){
        // salaries
        return $this->where('salary',1)->sum('value');
    }
}

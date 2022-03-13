<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderCourse extends Model
{
    //
    protected $fillable =['user_id','firstname','lastname','email','phone','telegram_number','payed_status'];
    
    public function course(){
        return $this->belongsTo('App\ModelWordpress\Courses','course_id','id');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
}

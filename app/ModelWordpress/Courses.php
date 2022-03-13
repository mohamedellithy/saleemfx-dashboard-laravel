<?php

namespace App\ModelWordpress;

use Corcel\Model\Post as Corcel;
use Illuminate\Database\Eloquent\Model;
class Courses extends Corcel
{
    //
    protected $connection = 'wordpress';
    protected $postType = 'lp_course';
    
    public function course_order(){
        return $this->hasMany(\App\OrderCourse::class,'course_id','ID');
    }
   
}

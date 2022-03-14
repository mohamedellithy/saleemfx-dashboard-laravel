<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForexCompany extends Model
{
    //
    protected $fillable = ['id','name_ar','name_en','link_company'];
    public function images(){
         return $this->morphOne(Image::class, 'imageable');
    }
}

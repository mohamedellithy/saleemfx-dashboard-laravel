<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForexCompany extends Model
{
    //
    protected $fillable = ['id','name_ar','name_en','link_company'];
    public function images(){
         return $this->morphMany(Image::class, 'imageable');
    }
}

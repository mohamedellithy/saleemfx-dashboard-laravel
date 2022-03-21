<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ForexCompany extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['id','name_ar','name_en','link_company'];
    public function images(){
         return $this->morphOne(Image::class, 'imageable')->withTrashed();
    }
}

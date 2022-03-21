<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class AnalyticsCategory extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['name_ar','name_en'];
}

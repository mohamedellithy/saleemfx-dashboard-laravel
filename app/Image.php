<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Image extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['imageable_id','imageable_type','image_url'];

    /**
     * Get the parent commentable model (forex-companies or users and more).
     */
    public function Imageable(){
        return $this->morphTo();
    }
}

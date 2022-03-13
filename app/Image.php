<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    protected $fillable = ['imageable_id','imageable_type','image_url'];

    /**
     * Get the parent commentable model (forex-companies or users and more).
     */
    public function Imageable(){
        return $this->morphTo();
    }
}

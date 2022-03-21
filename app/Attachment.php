<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Attachment extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['attachmentable_id','attachmentable_type','attachment_url','attachment_name'];

    /**
     * Get the parent commentable model (forex-companies or users and more).
     */
    public function attachmentable(){
        return $this->morphTo();
    }

}

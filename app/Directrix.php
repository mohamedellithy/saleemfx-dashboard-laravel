<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Directrix extends Model
{
    //
    use SoftDeletes;
    protected $fillable = [
       'name','description','allow'
    ];

    public function attachments(){
         return $this->morphMany(Attachment::class, 'attachmentable');
    }

    public function GetStatusTextAttribute(){
        # status_text
        # 0 -> disallow , 1 -> allow
        if($this->allow == 0)
            $status =  'غير مسموح';

        if($this->allow == 1)
            $status = 'مسموح';

        return '<label class="status-label status-'.$this->allow.'">'.$status.'</label>';
    }
}

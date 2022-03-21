<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class FileOrder extends Model
{
    //
    use SoftDeletes;
    protected $fillable = [
        'user_id','expert_file_id'
    ];

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    public function expert_file(){
        return $this->belongsTo('App\ExpertsFiles','expert_file_id','id');
    }

    public function GetStatusOrderAttribute(){
        # status_order
        # 0 -> pending , 1 -> accepted , 2 -> refused , 3 -> ended
        if($this->status == 0)
            $status =  'قيد التنفيذ';

        if($this->status == 1)
            $status = 'مسموح';

        if($this->status == 2)
           $status = 'غير مسموح';

        return $status;
    }
}

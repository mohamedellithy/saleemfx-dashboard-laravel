<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class ExpireCashback extends Model
{
    //
    protected $fillable = [
        'value','user_id'
    ];
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Attachment;
class AttachmentsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function store($request,object $model,$direct = null)
    {
        if(!empty($model)):
            if($direct == null):
                $attachment = $request->file('attachment');
            else:
                $attachment = $request;
            endif;
            $extension = $attachment->getClientOriginalExtension();
            $realName  = $attachment->getClientOriginalName();
            $new_name = 'attachment_'.time().rand(100,1000).'.'.$extension;
            $attachment->storeAs('public/dashboard/attachments',$new_name);
            $model->attachments()->create([
                'attachmentable_id'   => $model->id,
                'attachmentable_type' => 'App/'.$model->getTable(),
                'attachment_url'      => 'dashboard/attachments/'.$new_name,
                'attachment_name'     =>  $realName
            ]);
        endif;
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Image;
class ImagesController extends Controller
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
                $image = $request->file('image');
            else:
                $image = $request;
            endif;
            $extension = $image->getClientOriginalExtension();
            $new_name = 'Image_'.time().rand(100,1000).'.'.$extension;
            $image->storeAs('public/dashboard/images',$new_name);
            $model->images()->create([
                'imageable_id'   => $model->id,
                'imageable_type' => 'App/'.$model->getTable(),
                'image_url'      => 'dashboard/images/'.$new_name,
            ]);
        endif;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function update(Request $request,$model = null)
    {
        //
        if(!empty($model)):
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $new_name = 'Image_'.time().'.'.$extension;
            $image->storeAs('public/dashboard/images',$new_name);
            $model->images()->update([
                'image_url'      => 'dashboard/images/'.$new_name
            ]);
        endif;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

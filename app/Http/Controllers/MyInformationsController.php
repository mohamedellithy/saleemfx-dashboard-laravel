<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class MyInformationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //
       return view('user.my-information.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $this->validate($request,[
            'firstname' =>'required',
            'lastname'  =>'required',
            'phone'     =>'required|min:10|max:15'
        ]);
        
        $update_userinfo = auth()->user()->update($request->only([
         'firstname','lastname','phone','telegram_number'
        ]));
        
        
        return redirect()->back()->with('message','تم تحديث بياناتك بنجاح');
        
    }

}

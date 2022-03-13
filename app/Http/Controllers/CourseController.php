<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    //

    public function form_register_course(){
         return view('courses.form-register-course');
    }
}

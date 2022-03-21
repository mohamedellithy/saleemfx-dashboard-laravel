<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelWordpress\Courses;
use App\OrderCourse;
use Illuminate\Validation\Rule;
use App\DataTables\OrderCoursesDataTable;
class OrderCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(OrderCoursesDataTable $dataTable)
    {
        //

        return $dataTable->render('admin.courses.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Courses $course)
    {
        //

        return view('courses.form-register-course')->with('course',$course);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Courses $course)
    {
        //
        $this->validate($request,[
           'firstname'=>'required',
           'lastname'=>'required',
           'email'=>[
               "required",
               "email",
                Rule::unique('order_courses')->where(function ($query) use ($course) {
                    return $query->where([
                        'course_id' => $course->ID,
                    ]);
                })
            ],
           'phone'=>'required',
           'telegram_number'=>'required'
        ]);


        if(auth()->user()):
            $request->merge([
               'user_id'=>auth()->user()->id
            ]);

            $this->validate($request,[
               'user_id'=>[
                    Rule::unique('order_courses')->where(function ($query) use ($course) {
                        return $query->where([
                            'course_id' => $course->ID,
                        ]);
                    })
                ]
            ]);

        endif;

        $course->course_order()->create($request->all());

        return redirect()->back()->with('message','تم التسجيل فى الدورة بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
        $course = OrderCourse::destroy($id);
        if($course){
            return redirect()->back()->with('message','لقد تم حذف الطلب بنجاح');
        }
    }
}

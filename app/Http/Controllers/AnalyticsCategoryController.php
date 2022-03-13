<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\AnalyticsCategoryDataTable;
use App\AnalyticsCategory;
class AnalyticsCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AnalyticsCategoryDataTable $dataTable){
        //
         // return $dataTable;
        return $dataTable->render('admin.analytics-category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.analytics-category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $this->validate($request,[
            'name_ar' =>'required|unique:analytics_categories,name_ar',
            'name_en' =>'required|unique:analytics_categories,name_en',
        ]);

        $create_analytics = AnalyticsCategory::create($request->all());
        if($create_analytics){
           return view('admin.analytics-category.create')->with('message','تم اضافة التصنيف بنجاح ');
        }
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
        $analytics_category = AnalyticsCategory::find($id);
        return view('admin.analytics-category.edit',compact('analytics_category'));
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
        $this->validate($request,[
            'name_ar' =>'required|unique:analytics_categories,name_ar,'.$id,
            'name_en' =>'required|unique:analytics_categories,name_en,'.$id
        ]);
        AnalyticsCategory::where('id', $id)->update($request->only(['name_ar','name_en']));
        return redirect()->back()->with('message','تم تعديل البيانات بنجاح');
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
        $status = AnalyticsCategory::destroy($id);
        if($status){
            return redirect()->route('analytics-categories.index')->with('message','تم حذف العنصر بنجاح');
        }
    }
}

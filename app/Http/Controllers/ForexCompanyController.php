<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ForexCompanyDataTable;
use App\User;
use App\ForexCompany;
use Illuminate\Validation\Rule;
use Storage;
class ForexCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ForexCompanyDataTable $dataTable)
    {
        //
        return $dataTable->render('admin.forex-company.index');
        # return view('admin.forexCompany.index');
    }

    /**
     * Display a listing of the resource
     *
     * @return \Illuminate\Http\Response
     */
    public function datatable(Request $request){
        $model = User::query();
        return Datatables()->of($model)
                ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.forex-company.create');
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
            'name_ar' =>[
                'required',
                Rule::unique('forex_companies','name_ar')->where(function($query) {
                    return $query->where('deleted_at',null);
                })
            ],
            'name_en' =>[
                'required',
                Rule::unique('forex_companies','name_en')->where(function($query) {
                    return $query->where('deleted_at',null);
                })
            ],
            'link_company' => 'sometimes|URL',
            'image' =>'required|image|mimes:png,jpg,jpeg,gif'
        ]);

        $create_company = ForexCompany::create($request->all());
        if($create_company){
           ImagesController::store($request,$create_company);
           return view('admin.forex-company.create')->with('message','تم اضافة الشركة بنجاح');
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
        $forex_company = ForexCompany::find($id);
        return view('admin.forex-company.edit',compact('forex_company'));
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
            'name_ar' =>'required|unique:forex_companies,name_ar,'.$id,
            'name_en' =>'required|unique:forex_companies,name_en,'.$id,
            'link_company' => 'sometimes|URL',
            'image'   =>'sometimes|image|mimes:png,jpg,jpeg,gif'
        ]);
        ForexCompany::where('id', $id)->update($request->only(['name_ar','name_en','link_company']));
        if($request->hasFile('image')){
           $company = ForexCompany::find($id);
           ImagesController::update($request,$company);
        }
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
        $ForexCompany = ForexCompany::find($id);

        if($ForexCompany->images->first())
             Storage::delete(asset('storage/'.$ForexCompany->images->first()->image_url));

        $ForexCompany->images()->delete();
        $status = ForexCompany::destroy($id);
        if($status){
            return redirect()->route('forex-companies.index')->with('message','تم حذف العنصر بنجاح');
        }
    }
}

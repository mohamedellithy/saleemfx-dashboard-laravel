<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ExpertsFilesDataTable;
use App\ExpertsFiles;
use App\Http\Resources\AttachmentResources;
class ExpertsFilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ExpertsFilesDataTable $dataTable)
    {
        //
        return $dataTable->render('admin.experts-files.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.experts-files.create');
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
           'name'        => 'required|unique:experts_files,name',
           'description' => 'required',
           'attachments.*' => 'required'
        ]);

        $experts_files = ExpertsFiles::create($request->all());
        if($experts_files){
            if($request->hasFile('attachments')):
                foreach($request->file('attachments') as $attachment):
                    AttachmentsController::store($attachment,$experts_files,true);
                endforeach;
            endif;
        }

        return redirect()->back()->with('message','تم اضافة الاسكربتات بنجاح');
    }


    function change_status($expert_id,$status){
        $update_status = ExpertsFiles::where('id',$expert_id)->update(['allow' => $status]);
        if($update_status){
            return redirect()->route('experts-files.index')->with('message','تم تحديث حالة الطلب بنجاح');
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
        $experts_files = ExpertsFiles::find($id);
        $attachments   = AttachmentResources::collection($experts_files->attachments);
        return view('admin.experts-files.edit')->with([
            'experts_files' =>$experts_files,
            'attachments'   =>$attachments
        ]);
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
           'name'          => 'required|unique:experts_files,name,'.$id,
           'description'   => 'required',
           'attachments.*' => 'sometimes'
        ]);

        $experts_files = ExpertsFiles::where('id',$id)->update($request->only(['name','description','allow']));
        $experts       = ExpertsFiles::find($id);
        if($experts_files){
            if($request->hasFile('attachments')):
                $experts->attachments()->delete();
                foreach($request->file('attachments') as $attachment):
                    AttachmentsController::store($attachment,$experts,true);
                endforeach;
            endif;
        }

        return redirect()->back()->with('message','تم تعديل الاسكربتات بنجاح');
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
        $experts = ExpertsFiles::find($id);
        $experts->attachments()->delete();
        $status  = ExpertsFiles::destroy($id);
        if($status){
            return redirect()->route('experts-files.index')->with('message','تم حذف العنصر بنجاح');
        }
    }
}

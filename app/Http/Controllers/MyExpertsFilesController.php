<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\MyExpertsFilesDataTable;
use App\ExpertsFiles;
use App\ForexCompany;
use App\ModelWordpress\Services;
class MyExpertsFilesController extends Controller
{
    //
    public function index(MyExpertsFilesDataTable $dataTable) {
        $companies = ForexCompany::select('id','name_ar','name_en')->get();
        $service   = Services::hasMeta('type_service','experts')->first();
        return $dataTable->render('user.experts-files.index',compact([
            'companies','service'
        ]));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ForexCompany;
use App\ModelWordpress\Services;
use App\DataTables\MyDirectrixDataTable;
class MyDirectrixServicesController extends Controller
{
    public function index(MyDirectrixDataTable $dataTable) {
        $companies = ForexCompany::select('id','name_ar','name_en')->get();
        $service   = Services::hasMeta('type_service','experts')->first();
        return $dataTable->render('user.directrix-services.index',compact([
            'companies','service'
        ]));
    }
}

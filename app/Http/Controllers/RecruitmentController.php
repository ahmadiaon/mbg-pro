<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\UserDetail\Recruitment;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class RecruitmentController extends Controller
{
    public function index(){        
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'form-recruitment'
        ];

        return view('recruitment.index', [
            'title'         => 'Form Recruitment',
            'layout'    => $layout
        ]);
    }

    public function indexRecruitment(){        
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'recruitment-index'
        ];

        return view('recruitment.indexRecruitment', [
            'title'         => 'Recruitment',
            'layout'    => $layout
        ]);
    }

    public function show(Request $request){
        $data = Recruitment::where('uuid', $request->uuid)->first();

        return ResponseFormatter::toJson($data, 'Data Recruitment');
    }
    public function delete(Request $request)
    {
         $store = Recruitment::where('uuid',$request->uuid)->delete();
         return ResponseFormatter::toJson($store, 'Data Recruitment');
    }

    public function anyData(){
        $employeeee = Recruitment::all();

        // return DataTables::of($employeeee)    
        // ->make(true);

        return ResponseFormatter::toJson($employeeee, 'Data PPK');
    }

    public function store(Request $request){
        $validateData = $request->all();

        if(empty($validateData['uuid'])){
            $validateData['uuid'] = ResponseFormatter::toUUID($validateData['company_uuid'].'-'.$validateData['position_uuid'].'-'.$validateData['date_start']);
        }
        // return ResponseFormatter::toJson($validateData, 'Data Stored');
        $strore = Recruitment::updateOrCreate(['uuid' =>  $validateData['uuid']], $validateData);
        return ResponseFormatter::toJson($strore, 'Data Stored');
    }
}

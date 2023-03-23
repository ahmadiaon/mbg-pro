<?php

namespace App\Http\Controllers\UserDetail;

use App\Helpers\ResponseFormatter;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\UserDetail\UserDependent;
use App\Models\UserDetail\UserDetail;

class UserDependentController extends Controller
{
    public function create($nik_employee = null, $is_edit = null){
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'user-dependent',
        ];
        
        return view('user_detail.dependent.create', [
            'title'         => 'Tambah Karyawan',
            'layout'    => $layout
        ]);

    }

    public function show($nik_employee){
        $data = Employee::where_employee_nik_employee_nullable($nik_employee);
        
        $data->isEdit = 1;
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employees-index',
        ];

        
        return view('user_detail.dependent.create', [
            'title'         => 'Tambah Karyawan',
            'data'  => $data,
            'status'    => $data->status,
            'user_detail_uuid' => $data->user_detail_uuid,
            'layout'    => $layout
        ]);
        return $nik_employee;
    }

    public function store(Request $request){      
        $validateData = $request->all();
        // return ResponseFormatter::toJson($validateData, 'store-user-dependent');
        $data = session('recruitment-user');
        if(empty($validateData['date_start'])) {
            $validateData['date_start'] = $data['detail']['date_start'];
        }
        if(empty($validateData['user_detail_uuid'])) {
            $validateData['user_detail_uuid'] = $validateData['uuid'] ;
        }

        $validateData = UserDependent::updateOrCreate(['uuid' => $validateData['uuid']], $validateData );
        $data_store = Employee::showWhereNik_employee($validateData['uuid']);
        $data['detail'] = $data_store;
        return ResponseFormatter::toJson($data, 'store-user-dependent');
    }

    public function anyDataOne($uuid){
        $data = UserDependent::where('uuid', $uuid)->first();
        return ResponseFormatter::toJson($data, 'data user_detail');
    }
}

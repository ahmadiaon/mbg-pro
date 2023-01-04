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
    public function create($user_detail_uuid){
        $data = UserDetail::where('uuid', $user_detail_uuid)->get()->first();
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => false,
            'javascript_datatable'  => false,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'karyawan',
        ];
        
        return view('user_detail.dependent.create', [
            'title'         => 'Tambah Karyawan',
            'data'  =>'',
            'status'    => $data->status,
            'user_detail_uuid' =>$user_detail_uuid,
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

        $dependent = UserDependent::updateOrCreate(['uuid' => $request->user_detail_uuid], $request->all());

        return ResponseFormatter::toJson($dependent, 'store-user-dependent');
        
        if($request->isEdit == 1){
            return redirect()->intended('/user/profile/'.$request->nik_employee);
        }
        return redirect()->intended('/user-education/create/'.$request->user_detail_uuid);
    }

    public function anyDataOne($uuid){
        $data = UserDependent::where('uuid', $uuid)->first();
        return ResponseFormatter::toJson($data, 'data user_detail');
    }
}

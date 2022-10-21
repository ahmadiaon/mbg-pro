<?php

namespace App\Http\Controllers\UserDetail;
use App\Models\UserDetail\UserHealth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\UserDetail\UserDetail;

class UserHealthController extends Controller
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
            'active'                        => 'admin-hr-employees'
        ];
        
        return view('user_detail.health.create', [
            'title'         => 'Add People',
            'data'  => '',
            'user_detail_uuid' => $user_detail_uuid,
            'layout'    => $layout
        ]);
    }
    public function show($nik_employee){
        $data = Employee::where_employee_nik_employee_nullable($nik_employee);
        // dd($data);
        $data->isEdit = 1;
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employees-index',
        ];

        
        return view('user_detail.health.create', [
            'title'         => 'Tambah Karyawan',
            'data'  => $data,
            'user_detail_uuid' => $data->employee_uuid,
            'layout'    => $layout
        ]);
        return $nik_employee;
    }
    public function store(Request $request){
     
    //    dd($request);
        $validateDataLicence = $request->validate([
            'user_detail_uuid'  => '',
            'isEdit'    => '',
            'user_health_uuid'  => '',
            'name_health' =>'',
            'year' =>'',
            'health_care_place' =>'',
            'status_health' =>'',
            'long' =>''
        ]);

        if(empty($request->user_health_uuid)){
            $validateDataLicence['uuid'] = 'health-'.Str::uuid();
            $validateDataLicence['data_status'] = 1;
        }else{
            $validateDataLicence['uuid'] = $validateDataLicence['user_health_uuid'];
        }
        // dd($validateDataLicence);
        $store = UserHealth::updateOrCreate(['uuid' => $validateDataLicence['uuid']], $validateDataLicence );
        
        if($validateDataLicence['isEdit'] == 1){
            return redirect()->intended('/user/profile/'.$request->nik_employee);
        }
        return redirect()->intended('/user-employee/create/'.$request->user_detail_uuid);
    }
}

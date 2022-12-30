<?php

namespace App\Http\Controllers\UserDetail;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\UserDetail\UserLicense;

class UserLicenseController extends Controller
{
    public function create($user_detail_uuid){
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => false,
            'javascript_datatable'  => false,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'karyawan'
        ];
        
        return view('user_detail.license.create', [
            'title'         => 'Add People',
            'data'  => '',
            'user_detail_uuid' => $user_detail_uuid,
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

        
        return view('user_detail.license.create', [
            'title'         => 'Tambah Karyawan',
            'data'  => $data,
            'user_detail_uuid' => $data->user_detail_uuid,
            'layout'    => $layout
        ]);
        return $nik_employee;
    }
    public function store(Request $request){
      
       
        $validateDataLicence = $request->validate([
            'user_detail_uuid'  => '',
            'uuid'  => '',
            'sim_a' => '',
            'sim_b1' => '',
            'sim_b2' => '',
            'sim_c' => '',
            'sim_d' => '',
            'sim_a_umum' => '',
            'sim_b1_umum' => '',
            'sim_b2_umum' => '',
            'date_end_sim_a' => '',
            'date_end_sim_b1' => '',
            'date_end_sim_b2' => '',
            'date_end_sim_c' => '',
            'date_end_sim_d' => '',
            'date_end_sim_a_umum' => '',
            'date_end_sim_b1_umum' => '',
            'date_end_sim_b2_umum' => '',
        ]);

        if(empty($request->user_license_uuid)){
            $validateDataLicence['uuid'] = 'license-'.$request->user_detail_uuid;            
        }else{
            $validateDataLicence['uuid'] = $request->user_license_uuid;
        }
        // dd($validateDataLicence);
        $license = UserLicense::updateOrCreate(['uuid' => $validateDataLicence['uuid']], $validateDataLicence );
        
        if($request->isEdit == 1){
            return redirect()->intended('/user/profile/'.$request->nik_employee);
        }

        
        $store = UserLicense::updateOrCreate(['uuid' => $validateDataLicence['uuid']], $validateDataLicence );
        return redirect()->intended('/user-health/create/'.$request->user_detail_uuid);
    }
}

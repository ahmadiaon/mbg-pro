<?php

namespace App\Http\Controllers\UserDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\UserDetail\UserEducation;

class UserEducationController extends Controller
{
    //
    public function create($user_detail_uuid){
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => false,
            'javascript_datatable'  => false,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'karyawan',
        ];
        
        return view('user_detail.education.create', [
            'title'         => 'Tambah Karyawan',
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

        
        return view('user_detail.education.create', [
            'title'         => 'Tambah Karyawan',
            'data'  => $data,
            'user_detail_uuid' => $data->user_detail_uuid,
            'layout'    => $layout
        ]);
        return $nik_employee;
    }

    public function store(Request $request){
        // dd($request);
        $validateData = $request->validate([
            // foreign key
            'user_detail_uuid'=>'',

            'sd_name'=>'',
            'sd_place'=>'',
            'sd_year'=>'',

            'smp_name'=>'',
            'smp_place'=>'',
            'smp_year'=>'',

            'sma_name'=>'',
            'sma_place'=>'',
            'sma_jurusan'=>'',
            'sma_year'=>'',

            'ptn_name'=>'',
            'ptn_place'=>'',
            'ptn_jurusan'=>'',
            'ptn_year'=>'',

            'dll_name'=>'',
            'dll_place'=>'',
            'dll_jurusan'=>'',
            'dll_year'=>'',  
        ]);

        if(empty($request->user_education_uuid)){
            $validateData['uuid'] = 'education-'.$request->user_detail_uuid;            
        }else{
            $validateData['uuid'] = $request->user_education_uuid;
        }
        // dd($validateData);
        $store = UserEducation::updateOrCreate(['uuid' => $validateData['uuid']], $validateData );
        
        if($request->isEdit == 1){
            return redirect()->intended('/user/profile/'.$request->nik_employee);
        }

        return redirect()->intended('/user-license/create/'.$store->user_detail_uuid);
    }
    
}

<?php

namespace App\Http\Controllers\UserDetail;

use App\Helpers\ResponseFormatter;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\UserDetail\UserLicense;

class UserLicenseController extends Controller
{
  
    public function anyDataOne($uuid){
        $data = UserLicense::where('uuid', $uuid)->first();
        return ResponseFormatter::toJson($data, 'data user_detail');
    }
    public function create($nik_employee = null, $is_edit = null){
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'user-license',
        ];           
        return view('user_detail.license.create', [
            'title'         => 'Tambah Karyawan',
            'layout'    => $layout
        ]);
    }

    public function store(Request $request){
        $isEdit = true;
        $validateData = $request->all();
        $data = session('recruitment-user');
        if(empty($validateData['date_start'])) {
            $validateData['date_start'] = $data['detail']['date_start'];
        }
        if(empty($validateData['user_detail_uuid'])) {
            $validateData['user_detail_uuid'] = $validateData['uuid'] ;
        }

        $validateData = UserLicense::updateOrCreate(['uuid' => $validateData['uuid']], $validateData );
        $data_store = Employee::showWhereNik_employee($validateData['uuid']);
        $data['detail'] = $data_store;
        session()->put('recruitment-user', $data);
        return ResponseFormatter::toJson($validateData, 'Data Store User License');
    }
}

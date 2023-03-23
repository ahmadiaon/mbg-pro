<?php

namespace App\Http\Controllers\UserDetail;

use App\Helpers\ResponseFormatter;
use App\Models\UserDetail\UserHealth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\UserDetail\UserDetail;

class UserHealthController extends Controller
{
    public function create($nik_employee = null, $is_edit = null){
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'user-health',
        ];

        
        return view('user_detail.health.create', [
            'title'         => 'Kesehatan',
            'layout'    => $layout
        ]);

    }
    public function store(Request $request){
        $validateData = $request->all();
        $data = session('recruitment-user');
        if(empty($validateData['date_start'])) {
            $validateData['date_start'] = $data['detail']['date_start'];
        }
        if(empty($validateData['user_detail_uuid'])) {
            $validateData['user_detail_uuid'] = $validateData['uuid'] ;
        }
        
        $validateData = UserHealth::updateOrCreate(['uuid' => $validateData['uuid']], $validateData );
        $data_store = Employee::showWhereNik_employee($validateData['uuid']);
        $data['detail'] = $data_store;
        session()->put('recruitment-user', $data);
        return ResponseFormatter::toJson( $validateData, 'Data Store User Health');
    }

    public function anyDataOne($uuid){
        $data = UserHealth::where('uuid', $uuid)->first();
        return ResponseFormatter::toJson($data, 'data user_education');
    }    
}

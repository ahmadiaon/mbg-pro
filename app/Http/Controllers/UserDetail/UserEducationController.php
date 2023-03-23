<?php

namespace App\Http\Controllers\UserDetail;

use App\Helpers\ResponseFormatter;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\UserDetail\UserEducation;

class UserEducationController extends Controller
{
    public function store(Request $request){
        $validateData = $request->all();        

        $data = session('recruitment-user');
        if(empty($validateData['date_start'])) {
            $validateData['date_start'] = $data['detail']['date_start'];
        }
        if(empty($validateData['user_detail_uuid'])) {
            $validateData['user_detail_uuid'] = $validateData['uuid'] ;
        }

       
        $validateData = UserEducation::updateOrCreate(['uuid' => $validateData['uuid']], $validateData );
        $data_store = Employee::showWhereNik_employee($validateData['uuid']);
        $data['detail'] = $data_store;
        
        session()->put('recruitment-user', $data);
        return ResponseFormatter::toJson($data_store, 'store-user-education');
 
        return ResponseFormatter::toJson($validateData, 'Data Store User Education');

    }

    public function create(){
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'user-education',
        ];
        
        return view('user_detail.education.create', [
            'title'         => 'Pendidikan',
            'layout'    => $layout
        ]);

    }

    public function anyDataOne($uuid){
        $data = UserEducation::where('uuid', $uuid)->first();
        return ResponseFormatter::toJson($data, 'data user_education');
    }
    
}

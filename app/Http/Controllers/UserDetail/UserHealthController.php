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
    public function store(Request $request){
        $isEdit = true;
        $validateData = $request->all();

        if(!empty($request->name_health)){
            if($validateData['uuid'] == null){
                $isEdit = false;
                $validateData['uuid'] = $validateData['user_detail_uuid'];
            }
            $validateData = UserHealth::updateOrCreate(['uuid' => $validateData['uuid']], $validateData );
        }else{
            if(empty($request->isEdit)){
                $isEdit = false;
            }
        }
        if($isEdit){
            $validateData = Employee::noGet_employeeAll_detail()->where('user_details.uuid', $validateData['uuid'])->get()->first();

        }        
        return ResponseFormatter::toJson( $validateData, 'Data Store User Helath');
    }

    public function anyDataOne($uuid){
        $data = UserHealth::where('uuid', $uuid)->first();
        return ResponseFormatter::toJson($data, 'data user_education');
    }    
}

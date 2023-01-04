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

        
        // dd($request);
        $validateData = $request->all();

        if($validateData['uuid'] == null){
            $validateData['uuid'] = $validateData['user_detail_uuid'];
        }

        $store = UserEducation::updateOrCreate(['uuid' => $validateData['uuid']], $validateData );

        return ResponseFormatter::toJson($store, 'Data Store User Education');

        if(empty($request->user_education_uuid)){
            $validateData['uuid'] = 'education-'.$request->user_detail_uuid;            
        }else{
            $validateData['uuid'] = $request->user_education_uuid;
        }
        // dd($validateData);
       
        
        if($request->isEdit == 1){
            return redirect()->intended('/user/profile/'.$request->nik_employee);
        }

        return redirect()->intended('/user-license/create/'.$store->user_detail_uuid);
    }

    public function anyDataOne($uuid){
        $data = UserEducation::where('uuid', $uuid)->first();
        return ResponseFormatter::toJson($data, 'data user_education');
    }
    
}

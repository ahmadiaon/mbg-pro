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

        
        // dd($request);
        $validateData = $request->all();

        if($validateData['uuid'] == null){
            $validateData['uuid'] = $validateData['user_detail_uuid'];
        }

        $store = UserHealth::updateOrCreate(['uuid' => $validateData['uuid']], $validateData );

        return ResponseFormatter::toJson($store, 'Data Store User Health');

        if($request->isEdit == 1){
            return redirect()->intended('/user/profile/'.$request->nik_employee);
        }

        return redirect()->intended('/user-license/create/'.$store->user_detail_uuid);
    }

    public function anyDataOne($uuid){
        $data = UserHealth::where('uuid', $uuid)->first();
        return ResponseFormatter::toJson($data, 'data user_education');
    }
    
}

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

    public function store(Request $request){
        $validateData = $request->all();
        if($validateData['uuid'] == null){
            $validateData['uuid'] = $validateData['user_detail_uuid'];
        }

        $store = UserLicense::updateOrCreate(['uuid' => $validateData['uuid']], $validateData );

        return ResponseFormatter::toJson($store, 'Data Store User License');
    }
}

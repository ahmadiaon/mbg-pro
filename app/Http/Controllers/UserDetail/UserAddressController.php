<?php

namespace App\Http\Controllers\UserDetail;

use App\Helpers\ResponseFormatter;
use App\Models\UserDetail\UserAddress;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;

class UserAddressController extends Controller
{
    public function anyDataOne($uuid){
        $data = UserAddress::where('uuid', $uuid)->first();
        return ResponseFormatter::toJson($data, 'data user_detail');
    }

    public function store(Request $request){  
        $isEdit = true;
        $validateData = $request->all();

        if($validateData['isEdit'] == null){
            $isEdit = false;
        }
        $validateData = UserAddress::updateOrCreate(['uuid' => $validateData['uuid']], $validateData);

        if($isEdit){
            $validateData = Employee::noGet_employeeAll_detail()->where('user_details.uuid', $validateData['uuid'])->get()->first();

        }   
        return ResponseFormatter::toJson($validateData, 'store-user-dependent');
    }
}

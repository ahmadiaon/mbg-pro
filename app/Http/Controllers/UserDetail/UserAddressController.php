<?php

namespace App\Http\Controllers\UserDetail;

use App\Helpers\ResponseFormatter;
use App\Models\UserDetail\UserAddress;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserAddressController extends Controller
{
    public function anyDataOne($uuid){
        $data = UserAddress::where('uuid', $uuid)->first();
        return ResponseFormatter::toJson($data, 'data user_detail');
    }

    public function store(Request $request){  
        $dependent = UserAddress::updateOrCreate(['uuid' => $request->user_detail_uuid], $request->except(['uuid']));
        return ResponseFormatter::toJson($dependent, 'store-user-dependent');
        
        if($request->isEdit == 1){
            return redirect()->intended('/user/profile/'.$request->nik_employee);
        }
        return redirect()->intended('/user-education/create/'.$request->user_detail_uuid);
    }
}

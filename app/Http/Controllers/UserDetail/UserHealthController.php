<?php

namespace App\Http\Controllers\UserDetail;
use App\Models\UserDetail\UserHealth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserHealthController extends Controller
{
    public function create($user_detail_uuid){
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => false,
            'javascript_datatable'  => false,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'admin-hr-employees'
        ];
        
        return view('user_detail.health.hr.create', [
            'title'         => 'Add People',
            'user_detail_uuid' => $user_detail_uuid,
            'layout'    => $layout
        ]);
    }
    public function store(Request $request){
        // dd($request);
       
        $validateDataLicence = $request->validate([
            'user_detail_uuid'  => '',
            'uuid'  => '',
            'name_health' =>'',
            'year' =>'',
            'health_care_place' =>'',
            'status_health' =>'',
            'long' =>''
        ]);

        if(empty($request->uuid)){
            $validateDataLicence['uuid'] = 'health-'.Str::uuid();
        }

        
        $store = UserHealth::updateOrCreate(['uuid' => $validateDataLicence['uuid']], $validateDataLicence );
        return redirect()->intended('/admin-hr/employee/create/'.$request->user_detail_uuid);
    }
}

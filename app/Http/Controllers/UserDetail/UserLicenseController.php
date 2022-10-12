<?php

namespace App\Http\Controllers\UserDetail;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserDetail\UserLicense;

class UserLicenseController extends Controller
{
    public function create($user_detail_uuid){
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => false,
            'javascript_datatable'  => false,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'karyawan'
        ];
        
        return view('user_detail.licence.hr.create', [
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
            'sim_A' => '',
            'sim_B1' => '',
            'sim_B2' => '',
            'sim_C' => '',
            'sim_D' => '',
            'sim_A_UMUM' => '',
            'sim_B1_UMUM' => '',
            'SIM_B2_UMUM' => '',
        ]);

        if(empty($request->uuid)){
            $validateDataLicence['uuid'] = 'licence-'.Str::uuid();
        }
        // dd($validateDataLicence);

        
        $store = UserLicense::updateOrCreate(['uuid' => $validateDataLicence['uuid']], $validateDataLicence );
        return redirect()->intended('/admin-hr/health/create/'.$request->user_detail_uuid);
    }
}

<?php

namespace App\Http\Controllers\UserDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserDetail\UserEducation;

class UserEducationController extends Controller
{
    //
    public function create($user_detail_uuid){
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => false,
            'javascript_datatable'  => false,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'karyawan',
        ];
        
        return view('user_detail.education.hr.create', [
            'title'         => 'Tambah Karyawan',
            'user_detail_uuid' => $user_detail_uuid,
            'layout'    => $layout
        ]);
    }

    public function store(Request $request){
        // dd($request);
        $validateData = $request->validate([
            // foreign key
            'user_detail_uuid'=>'',

            'sd_name'=>'',
            'sd_place'=>'',
            'sd_year'=>'',

            'smp_name'=>'',
            'smp_place'=>'',
            'smp_year'=>'',

            'sma_name'=>'',
            'sma_place'=>'',
            'sma_jurusan'=>'',
            'sma_year'=>'',

            'ptn_name'=>'',
            'ptn_place'=>'',
            'ptn_jurusan'=>'',
            'ptn_year'=>'',

            'dll_name'=>'',
            'dll_place'=>'',
            'dll_jurusan'=>'',
            'dll_year'=>'',  
        ]);
        if(empty($request->uuid)){
            $dependents['uuid'] = 'education-'.Str::uuid();
        }
        $store = UserEducation::create($validateData);

        return redirect()->intended('/admin-hr/experience/create/'.$store->user_detail_uuid);

    }
    
}

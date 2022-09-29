<?php

namespace App\Http\Controllers\UserDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserDetail\UserEducation;

class UserEducationController extends Controller
{
    //
    public function create(){
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => false,
            'javascript_datatable'  => false,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'admin-hr',
            'active-sub'                        => 'employee'
        ];
        
        return view('hr.user.education.create', [
            'title'         => 'Add People',
            'user_detail_uuid' => session('user_detail_uuid'),
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
        $validateData['uuid'] = 'education-'.Str::uuid();
        $store = UserEducation::create($validateData);

        return redirect()->intended('/admin-hr/experience/create')->with('user_detail_uuid',$store->user_detail_uuid);

    }
    
}

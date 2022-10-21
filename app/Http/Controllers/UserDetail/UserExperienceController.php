<?php

namespace App\Http\Controllers\UserDetail;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserDetail\UserExperience;

class UserExperienceController extends Controller
{
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
        
        return view('user_detail.experience.create', [
            'title'         => 'Tambah Karyawan',
            'user_detail_uuid' =>$user_detail_uuid,
            'layout'    => $layout,
            'data'  => ''
        ]);
    }

    public function store(Request $request){
        // dd($request);
       
        if($request->exp_1_name){
            $experiences = [
                'user_detail_uuid'  => $request->user_detail_uuid,
                'uuid' => 'experience-'.Str::uuid(),
                'experience_place_name' =>$request->exp_1_name,
                'experience_position' =>$request->exp_1_position,
                'experience_date_start' =>$request->exp_1_date_start,
                'experience_date_end' =>$request->exp_1_date_end,
                'experience_reason' =>$request->exp_1_reason
            ];

            $experience =UserExperience::create($experiences );

          }
          if($request->exp_2_name){
            $experiences_2 = [
                'user_detail_uuid'  => $request->user_detail_uuid,
                'uuid' => 'experience-'.Str::uuid(),
                'experience_place_name' =>$request->exp_2_name,
                'experience_position' =>$request->exp_2_position,
                'experience_date_start' =>$request->exp_2_date_start,
                'experience_date_end' =>$request->exp_2_date_end,
                'experience_reason' =>$request->exp_2_reason
            ];

            $experience_2 =UserExperience::create($experiences_2 );

          }
          if($request->exp_3_name){
            $experiences_3 = [
                'user_detail_uuid'  => $request->user_detail_uuid,
                'uuid' => 'experience-'.Str::uuid(),
                'experience_place_name' =>$request->exp_3_name,
                'experience_position' =>$request->exp_3_position,
                'experience_date_start' =>$request->exp_3_date_start,
                'experience_date_end' =>$request->exp_3_date_end,
                'experience_reason' =>$request->exp_3_reason
            ];

            $experience_3 =UserExperience::create($experiences_3 );

          }
          if($request->exp_4_name){
            $experiences_4 = [
                'user_detail_uuid'  => $request->user_detail_uuid,
                'uuid' => 'experience-'.Str::uuid(),
                'experience_place_name' =>$request->exp_4_name,
                'experience_position' =>$request->exp_4_position,
                'experience_date_start' =>$request->exp_4_date_start,
                'experience_date_end' =>$request->exp_4_date_end,
                'experience_reason' =>$request->exp_4_reason
            ];

            $experience_4 =UserExperience::create($experiences_4 );

          }
          if(empty($request->user_dependent_uuid)){
            $dependents['uuid'] = 'dependent-'.$request->user_detail_uuid;            
        }else{
            $dependents['uuid'] = $request->user_dependent_uuid;
        }
        $dependent = UserExperience::updateOrCreate(['uuid' => $dependents['uuid']], $dependents );
        // dd($dependents);
        if($request->isEdit == 1){
            return redirect()->intended('/user/profile/'.$request->nik_employee);
        }


          return redirect()->intended('/user-licence/create/'.$request->user_detail_uuid);
    }
}

<?php

namespace App\Http\Controllers\UserDetail;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserDetail\UserDependent;
use App\Models\UserDetail\UserDetail;

class UserDependentController extends Controller
{
    public function create($user_detail_uuid){
        $data = UserDetail::where('uuid', $user_detail_uuid)->get()->first();
        // return $data;
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => false,
            'javascript_datatable'  => false,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'karyawan',
        ];
        
        return view('user_detail.dependent.hr.create', [
            'title'         => 'Tambah Karyawan',
            'status'    => $data->status,
            'user_detail_uuid' =>$user_detail_uuid,
            'layout'    => $layout
        ]);
    }

    public function store(Request $request){
        // dd($request);
        $validateDataUser = $request->validate([
            'user_detail_uuid' =>  'required',
            'mother_name' =>  'required',
            'mother_gender' =>  'required',
            'mother_education' =>  'required',
            'mother_place_birth' =>  'required',
            'mother_date_birth' =>  'required',

            'father_name' =>  'required',
            'father_gender' =>  'required',
            'father_education' =>  'required',
            'father_place_birth' =>  'required',
            'father_date_birth' =>  'required'
        ]);
       
       
        $dependents = [
            'user_detail_uuid' =>  $request->user_detail_uuid,
            'mother_name' =>  $request->mother_name,
            'mother_gender' =>  $request->mother_gender,
            'mother_education' =>  $request->mother_education,
            'mother_place_birth' =>  $request->mother_place_birth,
            'mother_date_birth' =>  $request->mother_date_birth,

            'father_name' =>  $request->father_name,
            'father_gender' =>  $request->father_gender,
            'father_education' =>  $request->father_education,
            'father_place_birth' =>  $request->father_place_birth,
            'father_date_birth' =>  $request->father_date_birth
        ];

        if($request->mother_name){
            $dependents['mother_in_law_name'] = $request->mother_in_law_name;
            $dependents['mother_in_law_gender'] = $request->mother_in_law_gender;
            $dependents['mother_in_law_place_birth'] = $request->mother_in_law_place_birth;
            $dependents['mother_in_law_date_birth'] = $request->mother_in_law_date_birth;
            $dependents['mother_in_law_education'] = $request->mother_in_law_education;

            $dependents['father_in_law_name'] = $request->father_in_law_name;
            $dependents['father_in_law_gender'] = $request->father_in_law_gender;
            $dependents['father_in_law_place_birth'] = $request->father_in_law_place_birth;
            $dependents['father_in_law_date_birth'] = $request->father_in_law_date_birth;
            $dependents['father_in_law_education'] = $request->father_in_law_education;
        }

        if($request->couple_name){
            $dependents['couple_name'] = $request->couple_name;
            $dependents['couple_gender'] = $request->couple_gender;
            $dependents['couple_place_birth'] = $request->couple_place_birth;
            $dependents['couple_date_birth'] = $request->couple_date_birth;
            $dependents['couple_education'] = $request->couple_education;
        }

        if($request->child1_name){
            $dependents['child1_name'] = $request->child1_name;
            $dependents['child1_gender'] = $request->child1_gender;
            $dependents['child1_place_birth'] = $request->child1_place_birth;
            $dependents['child1_date_birth'] = $request->child1_date_birth;
            $dependents['child1_education'] = $request->child1_education;
        }
        if($request->child2_name){
            $dependents['child2_name'] = $request->child2_name;
            $dependents['child2_gender'] = $request->child2_gender;
            $dependents['child2_place_birth'] = $request->child2_place_birth;
            $dependents['child2_date_birth'] = $request->child2_date_birth;
            $dependents['child2_education'] = $request->child2_education;
        }
        if($request->child3_name){
            $dependents['child3_name'] = $request->child3_name;
            $dependents['child3_gender'] = $request->child3_gender;
            $dependents['child3_place_birth'] = $request->child3_place_birth;
            $dependents['child3_date_birth'] = $request->child3_date_birth;
            $dependents['child3_education'] = $request->child3_education;
        }

        if(empty($request->uuid)){
            $dependents['uuid'] = 'dependent-'.Str::uuid();
        }
        // dd($dependents);

        
        $dependent = UserDependent::updateOrCreate(['uuid' => $dependents['uuid']], $dependents );
        return redirect()->intended('/admin-hr/education/create/'.$request->user_detail_uuid);
    }
}

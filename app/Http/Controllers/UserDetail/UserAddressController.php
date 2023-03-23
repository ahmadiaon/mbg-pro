<?php

namespace App\Http\Controllers\UserDetail;

use App\Helpers\ResponseFormatter;
use App\Models\UserDetail\UserAddress;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\Poh;

class UserAddressController extends Controller
{
    public function anyDataOne($uuid){
        $data = UserAddress::where('uuid', $uuid)->first();
        return ResponseFormatter::toJson($data, 'data user_detail');
    }

    public function store(Request $request){  

        $validateData = $request->all();        

        $data = session('recruitment-user');
        if(empty($validateData['date_start'])) {
            $validateData['date_start'] = $data['detail']['date_start'];
        }
        if(empty($validateData['user_detail_uuid'])) {
            $validateData['user_detail_uuid'] = $validateData['uuid'] ;
        }
        $validateData = UserAddress::updateOrCreate(['uuid' => $validateData['uuid']], $validateData);
        $data_store = Employee::showWhereNik_employee($validateData['uuid']);
        $data['detail'] = $data_store;
        session()->put('recruitment-user', $data);

        return ResponseFormatter::toJson($data_store, 'store-user-dependent');
    }

    public function create(){
        
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'user-address',
        ];
        $pohs = Poh::all();
        
        return view('user_detail.address.create', [
            'title'         => 'Alamat',
            'pohs' => $pohs,
            'layout'    => $layout
        ]);

    }

    public function createRecruitment(Request $request){
        $validateData = $request->all();
        return ResponseFormatter::toJson($validateData, 'store-user-dependent');
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employees-index',
        ];

        $pohs = Poh::all();
        
        
        return view('user_detail.recruitment.create', [
            'title'         => 'Tambah Karyawan',
            'pohs' => $pohs,
            'layout'    => $layout
        ]);
    }
}



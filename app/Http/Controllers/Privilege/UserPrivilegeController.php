<?php

namespace App\Http\Controllers\Privilege;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\Privilege\Privilege;
use App\Models\Privilege\UserPrivilege;
use Illuminate\Http\Request;
use Svg\Tag\Rect;
use Yajra\Datatables\Datatables;

class UserPrivilegeController extends Controller
{
    public function index(){
        // return 'aa';
        $privileges = Privilege::latest()->whereNull('deleted_at')->get();
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'user-privilege'
        ];
        return view('user_privilege.index', [
            'title'         => 'User Privilege',
            'privileges'    => $privileges,
            'layout'    => $layout,
        ]);
    }

    public function store(Request $request){
        $data = $request->all();
        $nik_employee = $request->nik_employee;
        $data = $request->except(['nik_employee','_token']);
        foreach($data as $item=>$value){
            UserPrivilege::updateOrCreate(['uuid'=>$nik_employee.'-'.$value],
            [
                'nik_employee' => $nik_employee,
                'privilege_uuid'    => $value
            ]);
           
        }
        
        return ResponseFormatter::toJson($data, 'Data Stored');
        return $request;
    }
    public function anyData(){

        $data = Employee::data_employee();
        // dd($data);
        return Datatables::of($data)     
        ->make(true);
    }


}

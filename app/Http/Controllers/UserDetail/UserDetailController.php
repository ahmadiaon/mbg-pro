<?php

namespace App\Http\Controllers\UserDetail;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeTotalHmMonth;
use App\Models\HourMeterPrice;
use App\Models\Poh;
use App\Models\Religion;
use App\Models\UserDetail\UserAddress;
use App\Models\UserDetail\UserDetail;
use App\Models\UserDetail\UserReligion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Replace;
use Yajra\Datatables\Datatables;

class UserDetailController extends Controller
{
    public function login(){
        return view('authentication.login', [
            'title'         => 'Login'
        ]);
    }
    public function storePayrol(){
        $data = [
            'udin'=>'udin'
        ];
        return response()->json(['code'=>200, 'message'=>'Data deleted successfully','data' => $data], 200);
    }
    public function index(){
        
        // dd(UserDetail::getAll());    
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'admin-hr',
            'active-sub'                        => 'employee'
        ];
        return view('hr.user.index', [
            'title'         => 'Employee',
            'layout'    => $layout
        ]);
    }
    
    public function indexUser(){
        $user = DB::table('users')
        ->join('employees','employees.uuid','users.employee_uuid')
        ->join('user_details','user_details.uuid','employees.user_detail_uuid')
        ->join('positions','positions.uuid','employees.position_uuid')
        ->join('departments','departments.uuid','employees.department_uuid')
        ->where('employees.uuid', session('dataUser')->employee_uuid)
        ->get([
            'employees.*',
            'employees.uuid as employee_uuid',
            'positions.position',
            'departments.department',
            'user_details.*',
        ])
        ->first();

        // dd(session('dataUser'));
        $hour_meter_pricees = HourMeterPrice::all();

        $hm = DB::table('employee_total_hm_months')
        ->join('hour_meter_prices','hour_meter_prices.uuid', 'employee_total_hm_months.hour_meter_price_uuid')
        ->where('employee_total_hm_months.employee_uuid',$user->employee_uuid)
        ->get([
        'hour_meter_prices.uuid as hour_meter_price_uuid',
        'hour_meter_prices.name',
        
        'employee_total_hm_months.value'
        ]);
        // return $hm;
        // dd($hm);
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employee',
        ];
        return view('employee.index', [
            'title'         => 'Employee',
            'user'      => $user,
            'hour_meter_prices' => $hour_meter_pricees,
            'employee_total_hm_months'  => $hm,
            'layout'    => $layout
        ]);
    }
    public function create(){
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employees-index',
        ];

        $religions = Religion::all();
        $pohs = Poh::all();
        
        return view('user_detail.edit', [
            'title'         => 'Tambah Karyawan',
            'religions' => $religions,
            'pohs' => $pohs,
            'data'  => null,
            'layout'    => $layout
        ]);
    }

    public function show($nik_employee){
        $data = Employee::where_employee_nik_employee_nullable($nik_employee);
        $data->isEdit = 1;
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employees-index',
        ];

        $religions = Religion::all();
        $pohs = Poh::all();
        
        return view('user_detail.edit', [
            'title'         => 'Tambah Karyawan',
            'religions' => $religions,
            'data'  => $data,
            'pohs' => $pohs,
            'layout'    => $layout
        ]);
        return $nik_employee;
    }

    

    public function store(Request $request){

        //user_detail
        //user_religion
        //user_address
        //

        // dd($request);
        $isEdit = false;
        
        $validateDataUser = $request->validate([
            'user_detail_uuid'  => '',
            'user_religion_uuid'    => '',
            'user_address_uuid' =>'',

            'name' => 'required',
            'nik_number' => 'required',
            'kk_number' => 'required',
            'citizenship' => 'required',
            'gender' => 'required',//pkwt-pkwtt

           'place_of_birth' => 'required',
           'date_of_birth' => 'required',
            
           'blood_group' => 'required',
            'status' => 'required',  
            'npwp_number' => '',
            'financial_number' => '',
            'bpjs_ketenagakerjaan' => '',  
            'bpjs_kesehatan' => '',  

            'phone_number' => '',  
        ]);
       
        $validateDataUserAddress = $request->validate([
            'poh_uuid' => '',
            'desa' => 'required',
            'rt' => '',
            'rw' => '',
            'kecamatan' => '',//pkwt-pkwtt

           'kabupaten' => 'required',
           'provinsi' => '',
        ]);

        $validateDataUserReligion = $request->validate([
            'uuid'  => '',
            'religion_uuid' => '',
            'user_detail_uuid' => '',
        ]);

        if($validateDataUser['user_detail_uuid'] == null){
            $user_detail_uuid = strtolower(str_replace(' ','-',$validateDataUser['name'] ) .'-'.rand(99,9999));
            $validateDataUser['uuid'] = $user_detail_uuid;
            $validateDataUserAddress['uuid'] = 'address-'.$user_detail_uuid;
            $validateDataUserReligion['uuid'] = 'religion-'.$user_detail_uuid;            
        }else{
            $isEdit = true;
            $validateDataUser['uuid'] =  $validateDataUser['user_detail_uuid'];
            $validateDataUserAddress['uuid'] = $validateDataUser['user_address_uuid'];
            $validateDataUserReligion['uuid'] = $validateDataUser['user_religion_uuid'];
        }

        $storeUser = UserDetail::updateOrCreate(['uuid' => $validateDataUser['uuid']],$validateDataUser);

        $validateDataUserAddress['user_detail_uuid'] = $storeUser->uuid;
        $validateDataUserAddress['is_last'] = '1';

        $storeUserAddress = UserAddress::updateOrCreate(['uuid' => $validateDataUserAddress['uuid']],$validateDataUserAddress);

        $validateDataUserReligion['user_detail_uuid'] = $storeUser->uuid;


        $storeUserReligion = UserReligion::updateOrCreate(['uuid' => $validateDataUserReligion['uuid']],$validateDataUserReligion);
        $das = [
            'religion'  => $storeUserReligion,
            'user'  => $storeUser,
            'address'   => $storeUserAddress
        ];
        
        if($isEdit == true){
            return redirect()->intended('/user/profile/'.$request->nik_employee);
        }
        return redirect()->intended('/user-dependent/create/'.$storeUser->uuid);
    }

    public function anyData()
    {
        $dataAny =  UserDetail::getAll();
        

        return Datatables::of($dataAny)
        ->addColumn('action', function ($model) {
            $url = "/admin/vehicle/";
            $url_edit = "'".$url.$model->uuid."'";
            $url_delete = "'".$url."delete/'";
            return '<a class="text-decoration-none" href="/admin-hr/employees/contract/show/' . $model->nik_employee . '"><button class="btn btn-secondary py-1 px-2 mr-1"><i class="icon-copy bi bi-eye-fill"></i></button></a><input type="hidden" value="'. $model->nik_employee .'"><button id="'.$model->nik_employee .'" onclick="runEditVehicle(' . $model->nik_employee . ','.$url_edit.')"  class="btn btn-warning py-1 px-2 mr-1"><i class="icon-copy dw dw-pencil"></i></button>
            <button onclick="isDeletevehicle(' . $model->nik_employee . ','.$url_delete.')"  type="button" class="btn btn-danger  py-1 px-2"><i class="icon-copy dw dw-trash"></i></button>';
        })
        ->make(true);
            
    }
    

}

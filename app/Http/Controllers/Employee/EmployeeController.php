<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use Illuminate\Http\Request;
use App\Models\Poh;
use App\Models\Religion;
use App\Models\Department;
use App\Models\Position;
use App\Models\Company;
use App\Models\Privilege\UserPrivilege;
use App\Models\Roaster;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Yajra\Datatables\Datatables;

class EmployeeController extends Controller
{
    public function index(){
        // return Employee::getAll();
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => false,
            'active'                        => 'employees-index'
        ];
        return view('employee.index', [
            'title'         => 'Daftar Karyawan',
            'layout'    => $layout,
        ]);
    }
    public function create($user_detail_uuid){
        $contract_number = '001';
        $nik_employee = "001";
        $machine_id = 1;
        $religions = Religion::all();
        $pohs = Poh::all();
        $departments = Department::all();
        $positions = Position::all();
        $companies = Company::all();
        $roasters = Roaster::all();

        $employee = Employee::latest()->first();
        if($employee->count() > 0){
            // return $employee;
            $nik_employees = $employee->nik_employee;
            $nik_employees = 'MBLE-20220528001';
            $nik_employee = $nik_employees[13].$nik_employees[14].$nik_employees[15] + 1;
            $machine_id = $employee->machine_id + 1;
            $contract_number = $employee->contract_number + 1;
        }else{
            $contract_number = '001';
            $nik_employee = "001";
            $machine_id =1;
        }

        // dd($employee);

        $d = Carbon::today('Asia/Jakarta')->isoFormat('D');
        $m = Carbon::today('Asia/Jakarta')->isoFormat('M');
        $y = Carbon::today('Asia/Jakarta')->isoFormat('Y');

         $date_now = $d.' '.ResponseFormatter::getMonthName($m).' '.$y;

        $d = Carbon::today()->addDays(90)->isoFormat('D');
        $m = Carbon::today()->addDays(90)->isoFormat('M');
        $y = Carbon::today()->addDays(90)->isoFormat('Y');
        $date_add = $d.' '.ResponseFormatter::getMonthName($m).' '.$y;
        // dd($positions);
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => false,
            'javascript_datatable'  => false,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'admin-hr-employees'
        ];
        
        return view('employee.hr.create', [
            'title'         => 'Add People',
            'user_detail_uuid' => $user_detail_uuid,
            'layout'    => $layout,
            'pohs' => $pohs,
            'positions' => $positions,
            'religions' => $religions,
            'companies' => $companies,
            'roasters' => $roasters,
            'departments' => $departments,
            'date_now'  =>$date_now,
            'long'      => 3,
            'date_add'  => $date_add,
            'contract_number'   => $contract_number,
            'nik_employee'      => $nik_employee,
            'machine_id'    =>$machine_id
        ]);
    }
    public function store(Request $request){
        // dd($request);
        $validateData = $request->validate([
           'user_detail_uuid' => '',
           'machine_id' => '',
           'nik_employee' => '',
           'position_uuid' => '',
           'department_uuid' => '',

           'contract_number'=>'',
           'contract_status' => '',//pkwt-pkwtt
           'date_start_contract'=>'',
           'date_end_contract'=>'',
           'date_document_contract'=>'',
            
           'long_contract'=>'', //month
           'employee_status' => '',      //trainer
        ]);
        $contract_numbers = explode("/",$request->contract_number);
        $validateData['contract_number'] =$contract_numbers[0];
        $validateData['date_start_contract'] = ResponseFormatter::toDate($request->date_start_contract);
        $validateData['date_end_contract'] = ResponseFormatter::toDate($request->date_end_contract);
        $validateData['date_document_contract'] = ResponseFormatter::toDate($request->date_start_contract);
        $validateData['uuid'] = 'employe-'.Str::uuid();

        $validateDataUser['uuid'] = 'User-'.Str::uuid();
        $validateDataUser['employee_uuid'] =   $validateData['uuid'];
        $validateDataUser['role'] = 'employee';
        $validateDataUser['nik_employee'] = $validateData['nik_employee'];;
        $validateDataUser['password'] = Hash::make('password');
        $storeUser = User::create(
            $validateDataUser
        );




        // $validateData['contract_number'] = 'education-'.Str::uuid();
        // dd($validateData);
        $store = Employee::create($validateData);

        return redirect()->intended('/user')->with('success',"Karyawan Ditambahkan");

    }

    public function show(Request $request){
        $data = Employee::where_employee_nik_employee($request->uuid);
        $userPrivileges = UserPrivilege::where('nik_employee', $request->uuid)->get();
        if(!empty($userPrivileges)){
            $data->user_privileges = $userPrivileges;
        }
       

        return ResponseFormatter::toJson($data, 'Data Privilege');
    }

    public function profile($nik_employee){
        $data = Employee::where_employee_nik_employee($nik_employee);
        // dd($data);
        $userPrivileges = UserPrivilege::where('nik_employee', $nik_employee)->get();
        if(!empty($userPrivileges)){
            $data->user_privileges = $userPrivileges;
        }

        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employees-index'
        ];
        return view('employee.show', [
            'title'         => 'Profile Karyawan',
            'data'  => $data,
            'layout'    => $layout,
        ]);
    }

    public function anyData(){

        $data = Employee::getAll();
        // return $data;

        return Datatables::of($data)     
        ->make(true);
    }


}

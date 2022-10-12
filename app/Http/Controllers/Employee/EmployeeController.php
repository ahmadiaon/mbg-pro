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
use App\Models\Roaster;
use Carbon\Carbon;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    public function index(){
        return Employee::getAll();
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
        // $validateData['contract_number'] = 'education-'.Str::uuid();
        // dd($validateData);
        $store = Employee::create($validateData);

        return redirect()->intended('/admin-hr')->with('success',"Karyawan Ditambahkan");

    }


}

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
use App\Models\Employee\EmployeeSalary;
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
        $d = Carbon::today('Asia/Jakarta')->isoFormat('D');
        $m = Carbon::today('Asia/Jakarta')->isoFormat('M');
        $y = Carbon::today('Asia/Jakarta')->isoFormat('Y');


        $contract_number = '001';
        $nik_employee = "001";
        $machine_id = 1;
        $religions = Religion::all();
        $pohs = Poh::all();
        $departments = Department::all();
        $positions = Position::all();
        $companies = Company::all();
        $roasters = Roaster::all();

       $employee = Employee::where('nik_employee', '!=',null)->where('created_at', '!=',null)->latest()->first();
        if($employee->count() > 0){
            // return $employee;
            $nik_employees = $employee->nik_employee;
            $nik_suggest = explode('-', $nik_employees);
            $nik = $nik_suggest[1][4].$nik_suggest[1][5].$nik_suggest[1][6] + 1;
            $machine_id = $employee->machine_id + 1;
            $contract_number = $employee->contract_number + 1;
        }

        // dd($employee);

        

         $date_now = $d.' '.ResponseFormatter::getMonthName($m).' '.$y;
         $date_now =  $y.'-'.$m.'-'.$d;

        $d = Carbon::today()->addDays(90)->isoFormat('D');
        $m = Carbon::today()->addDays(90)->isoFormat('M');
        $y = Carbon::today()->addDays(90)->isoFormat('Y');
        $date_add = $d.' '.ResponseFormatter::getMonthName($m).' '.$y;
        $date_adds = $y.'-'.$m.'-'.$d;
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
            'date_add'  => $date_adds,
            'contract_number'   => $contract_number,
            'nik_employee'      => $nik,
            'machine_id'    =>$machine_id
        ]);
    }
    public function storeFile(Request $request){
        $validatedData = $request->validate([
            'nik_employee_file' => '',
        ]);
        // return ResponseFormatter::toJson($validatedData, 'da');
        if($request->file('user_file')) {
            $imageName =   $validatedData['nik_employee_file']. '.'.$request->user_file->getClientOriginalExtension();
            $name = 'file/user/'.$imageName;
            if(file_exists($name)){
                $name = mt_rand(5, 99985) .'-'.$imageName;
                $name = 'file/user/'.$imageName;
            }
            
            $isMoved = $request->user_file->move('file/user/',$name);

            if($isMoved){
                $validatedData['file_path'] = $imageName;
            }
            $store = Employee::updateOrCreate(['nik_employee' => $validatedData['nik_employee_file']], $validatedData);
        }
      
        
        return ResponseFormatter::toJson($validatedData, 'file store');
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

        $validateDataSalaries = $request->validate([
           'salary' => '',
           'insentif' => '',
           'premi_bk' => '',
           'premi_nbk' => '',
           'premi_kayu' => '',
           'premi_mb' => '',
           'premi_rj' => '',
           'insentif_hm' => '',
           'deposit_hm' => '',
           'tonase' => '',
            'date_start' => '',
            'date_end' => '',
         ]);
        
   


        $contract_numbers = explode("/",$request->contract_number);
        $validateData['contract_number'] =$contract_numbers[0];
        if(empty($request->uuid)){
            $validateData['uuid'] = $validateData['nik_employee'];           
        }

        $store = Employee::updateOrCreate(['uuid' => $validateData['uuid']], $validateData );
        

        $validateDataUser['uuid'] =$store->uuid;
        $validateDataUser['employee_uuid'] =   $validateData['uuid'];
        $validateDataUser['role'] = 'employee';
        $validateDataUser['nik_employee'] = $validateData['nik_employee'];;
        $validateDataUser['password'] = Hash::make('password');
        $store = User::updateOrCreate(['uuid' => $validateDataUser['uuid']], $validateDataUser );
        
        $validateDataSalaries['uuid'] = $validateData['uuid'];
        $validateDataSalaries['employee_uuid'] = $validateData['uuid'];
        $validateDataSalaries['date_start'] = Carbon::today('Asia/Jakarta');

        $store = EmployeeSalary::updateOrCreate(['uuid' => $validateDataSalaries['uuid']], $validateDataSalaries );


        $abc = [
            'validateDataUser' => $validateDataUser,
            'validateData' => $validateData,
            'validateDataSalaries' => $validateDataSalaries,
        ];
        dd($abc);
        return redirect()->intended('/user')->with('success',"Karyawan Ditambahkan");
    }

    public function show(Request $request){
        $data = Employee::where_employee_nik_employee_nullable($request->uuid);
        $userPrivileges = UserPrivilege::where('nik_employee', $request->uuid)->get();
        if(!empty($userPrivileges)){
            $data->user_privileges = $userPrivileges;
        }
        return ResponseFormatter::toJson($data, 'Data Privilege');
    }

    public function profile($nik_employee){
        $data = Employee::where_employee_nik_employee_nullable($nik_employee);        
        if(!empty($data->user_privileges)){
            foreach($data->user_privileges as $item){
                $thiss = $item->privilege_uuid;
                $data->$thiss = 1;
            }
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

        return Datatables::of($data)     
        ->make(true);
    }


}

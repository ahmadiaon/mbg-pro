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
use App\Models\Employee\EmployeeCompany;
use App\Models\Employee\EmployeePremi;
use App\Models\Employee\EmployeeSalary;
use App\Models\Premi;
use App\Models\Privilege\UserPrivilege;
use App\Models\Roaster;
use App\Models\User;
use App\Models\UserDetail\UserDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Yajra\Datatables\Datatables;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use Illuminate\Support\Facades\Storage;

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

    public function import(Request $request){
        // return 'aaa';
        $the_file = $request->file('uploaded_file');

        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();

        try{
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();

            $rows = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ','DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DV','DW','DX','DY','DZ'];
        


            $no_employee = 3;
            $employees = [];
            /*
            1. loop all employee
            2.
            EmployeeHourMeterDay::
            */

            while((int)$sheet->getCell( 'A'.$no_employee)->getValue() != null){
                $date_row = 3;
               $nik_employee = $sheet->getCell( 'B'.$no_employee)->getValue();

                

                $date = ResponseFormatter::excelToDate($sheet->getCell( 'F'.$no_employee)->getValue());

                $premis = [];
                $column_premi = 21;
                while($sheet->getCell( $rows[$column_premi].'2')->getValue() != null){
                    $premis[$sheet->getCell( $rows[$column_premi].'2')->getValue()] = $rows[$column_premi];
                    $column_premi++;
                }

                // dd($premis);
                $position_uuid = ResponseFormatter::toUuidLower($sheet->getCell( 'D'.$no_employee)->getValue());
                $department_uuid = ResponseFormatter::toUuidLower($sheet->getCell( 'E'.$no_employee)->getValue());
                $store['position'] = Position::updateOrCreate(['uuid' => $position_uuid], ['position' => $sheet->getCell( 'D'.$no_employee)->getValue()]);
                $store['department'] = Department::updateOrCreate(['uuid' => $department_uuid], ['department' => $sheet->getCell( 'E'.$no_employee)->getValue()]);
                
                $employee = [
                    'nik_employee'  => $nik_employee,
                    'user_detail_uuid' => $nik_employee,
                    'machine_id'    => $sheet->getCell( 'U'.$no_employee)->getValue(),
                    'nik_employee' => $nik_employee, 
                    'position_uuid' => $position_uuid,
                    'department_uuid' => $department_uuid,
                    'date_start_contract' => $date, 
                    'date_document_contract' => $date, 
                    'date_start' => $date, 
                    'tax_status'    => $sheet->getCell( 'G'.$no_employee)->getValue(),  
                    'date_start'    => $date
                ];
                
                $store['employees'] = Employee::updateOrCreate(['uuid'    => $nik_employee], $employee);

                $user_details = [
                    'name'  => $sheet->getCell( 'C'.$no_employee)->getValue(),
                    'nik_number'    => $sheet->getCell( 'M'.$no_employee)->getValue(),
                    'financial_number' => $sheet->getCell( 'H'.$no_employee)->getValue(),
                    'financial_name' =>  $sheet->getCell( 'I'.$no_employee)->getValue(),
                    'bpjs_ketenagakerjaan' => $sheet->getCell( 'J'.$no_employee)->getValue(),
                    'bpjs_kesehatan' => $sheet->getCell( 'K'.$no_employee)->getValue(),
                    'npwp_number' => $sheet->getCell( 'L'.$no_employee)->getValue(),
                    'date_start' => $date
                ];
                $store['user_details'] = UserDetail::updateOrCreate(['uuid' => $nik_employee], $user_details);

                $user = [
                    'employee_uuid' => $nik_employee,
                    'role'  => 'employee',
                    'nik_employee' => $nik_employee,
                    'password' => Hash::make('password'), 
                ];
                $store['users'] =  User::updateOrCreate(['uuid' => $nik_employee],$user);

                $employee_salaries = [
                    'salary'    => $sheet->getCell( 'R'.$no_employee)->getValue(),
                    'insentif' => (empty($sheet->getCell( 'S'.$no_employee)->getValue())?null:$sheet->getCell( 'S'.$no_employee)->getValue()),
                    'tunjangan' =>(empty($sheet->getCell( 'T'.$no_employee)->getValue())?null:$sheet->getCell( 'T'.$no_employee)->getValue()), 
                    'date_start' => $date,
                    'employee_uuid' => $nik_employee
                ];
                
                $store['employee_salary'] =  EmployeeSalary::updateOrCreate(['uuid'  => $nik_employee], $employee_salaries);
                $employee_premis = [
                    'employee_uuid' => $nik_employee,
                ];
                foreach($premis as $premi => $key){
                    $employee_premis['premi_uuid'] =  $premi;
                    $employee_premis['premi_value'] = $sheet->getCell( $key.$no_employee)->getValue();
                    $employee_premis['date_start'] = $date;
                    
                    $store['employees_premi-'.$premi] =  EmployeePremi::updateOrCreate(['uuid' => $nik_employee.'-'.$premi],$employee_premis);
                }
                // dd($store);
                $no_employee++;
            }
        } catch (Exception $e) {
            $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
        return redirect()->back();
    }

    public function exportSimple(){
        $row = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ','DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DV','DW','DX','DY','DZ'];
        
        $premis = Premi::all();
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $createSheet->setCellValue('B1', 'Template Import Data Karyawan Simpel');
        $createSheet->setCellValue('A2', 'No.');
        $createSheet->setCellValue('B2', 'NIK');
        $createSheet->setCellValue('C2', 'Nama');
        $createSheet->setCellValue('D2', 'Jabatan');
        $createSheet->setCellValue('E2', 'Departemen');
        $createSheet->setCellValue('F2', 'Tanggal Awal Kontrak');
        $createSheet->setCellValue('G2', 'Status Pajak');
        $createSheet->setCellValue('H2', 'No Rekening');
        $createSheet->setCellValue('I2', 'Nama Rekening');
        $createSheet->setCellValue('J2', 'No BPJS Ketenagakerjaan');
        $createSheet->setCellValue('K2', 'BPJS Kesehatan');
        $createSheet->setCellValue('L2', 'No NPWP');
        $createSheet->setCellValue('M2', 'NIK Kependudukan');
        $createSheet->setCellValue('N2', 'Nama Ibu');
        $createSheet->setCellValue('O2', 'BPJS TK 2%');
        $createSheet->setCellValue('P2', 'BPJS KESEHATAN 1%');
        $createSheet->setCellValue('Q2', 'BPJS PENSIUN 1%');
        $createSheet->setCellValue('R2', 'Gaji Pokok');
        $createSheet->setCellValue('S2', 'Insentif');
        $createSheet->setCellValue('T2', 'Tunjangan');
        $createSheet->setCellValue('U2', 'Nama Mesin Fingger');
        
        $index_column = 2;
        $index_row = 21;
        foreach($premis as $premi){
            $cell = $row[$index_row].$index_column;
            $createSheet->setCellValue($cell, $premi->uuid);
            $index_row++;
        }
        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/Template Penambahan Karyawan -'.rand(99,9999).'file.xls';
        $crateWriter->save($name);

        return response()->download($name);
    }

    public function cekNikEmployee(Request $request){
        $data = Employee::where('nik_employee', $request->nik_employee)->get()->first();
        
        return ResponseFormatter::toJson($data, 'data nik');
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
        // return Carbon::today('Asia/Jakarta')->isoFormat('YYYY-MM-DD');
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
            'date_now'  => Carbon::today('Asia/Jakarta')->isoFormat('YYYY-MM-DD'),
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
           'nik_employee' => 'unique:employees',
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
        $store_employee_company = EmployeeCompany::updateOrCreate(['uuid' => $validateData['uuid']], ['employee_uuid' => $store->uuid,'company_uuid'=>$request->company_uuid]);

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
        // dd($abc);
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
        
        // dd($data);
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
            'active'                        => 'employees-profile'
        ];
        return view('employee.show', [
            'title'         => 'Profile Karyawan',
            'data'  => $data,
            'layout'    => $layout,
        ]);
    }

    public function anyData(){

        $data = Employee::join('user_details','user_details.uuid','=','employees.user_detail_uuid')
        ->join('positions','positions.uuid','=','employees.position_uuid')
        ->get([
            'user_details.name',
            'user_details.photo_path',
            'positions.position',
            'employees.employee_status',
            'employees.uuid',
            'employees.machine_id',
            'employees.nik_employee'
        ]);
        // return view('datatableshow', [ 'data'         => $data]);
        return Datatables::of($data)     
        ->make(true);
    }

















    // 
    public function allowance(){
        $layout = [
        'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => false,
            'active'                        => 'employees-index'
        ];
        return view('employee.allowance.index', [
            'title'         => 'Daftar Karyawan',
            'layout'    => $layout,
        ]);

    }


}

<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Department;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeCompany;
use App\Models\Employee\EmployeePremi;
use App\Models\Employee\EmployeeRoaster;
use App\Models\Employee\EmployeeSalary;
use App\Models\Position;
use App\Models\Premi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class EmployeeChanggeController extends Controller
{
    public function index(){
        $employees = Employee::getAll();
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employee-changge'
        ];
        return view('employee.changge.index', [
            'title'         => 'Perubahan Karyawan',
            'year_month'        => Carbon::today()->isoFormat('Y-M'),
            'layout'    => $layout,
            'employees' => $employees,
            'nik_employee' => ''
        ]);
    }
    public function create(){
        $employees = Employee::getAll();
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employee-changge'
        ];
        return view('employee.changge.create', [
            'title'         => 'Perubahan Karyawan',
            'year_month'        => Carbon::today()->isoFormat('Y-M'),
            'layout'    => $layout,
            'employees' => $employees,
            'nik_employee' => ''
        ]);
    }

    public function export($year_month){
        $day_month = ResponseFormatter::getEndDay($year_month);
        // $employees = Employee::get_employee_active_year_month($year_month);
        // $employees = Employee::get_employee_all_latest_full_data();
        // return view('datatableshow', [ 'data'         => $employees]);

        $arr_position = Position::all();        
        $arr_position = ResponseFormatter::createIndexArray($arr_position,'uuid');

        $arr_department = Department::all();
        $arr_department = ResponseFormatter::createIndexArray($arr_department,'uuid');

        $arr_company = Company::all();
        $arr_company = ResponseFormatter::createIndexArray($arr_company,'uuid');



        $arr_employee = Employee::leftJoin('user_details','user_details.uuid','employees.user_detail_uuid')
        ->leftJoin('employee_companies','employee_companies.employee_uuid','employees.uuid')
        ->leftJoin('companies','companies.uuid','employee_companies.company_uuid')
        ->whereNull('employees.date_end')
        ->get([
            'user_details.name',
            'companies.company',
            'employees.*'
        ]);

        $arr_employee_roaster = EmployeeRoaster::whereNull('date_end')->get();
        $arr_employee_roaster = ResponseFormatter::createIndexArray($arr_employee_roaster,'uuid');

        $arr_employee_salary = EmployeeSalary::whereNull('date_end')->get();
        $arr_employee_salary = ResponseFormatter::createIndexArray($arr_employee_salary,'uuid');

        $arr_employee_premi = EmployeePremi::whereNull('date_end')->get();


        // dd($arr_employee);
        $arr_employee = ResponseFormatter::createIndexArray($arr_employee, 'uuid');

        foreach($arr_employee as $employee){
            $employee->position = $arr_position[$employee->position_uuid]->position;
            $employee->department = $arr_department[$employee->department_uuid]->department;
            if(!empty($arr_employee_roaster[$employee->nik_employee])){
                $employee->roaster_uuid = $arr_employee_roaster[$employee->nik_employee]->roaster_uuid;
            }
            if(!empty($arr_employee_salary[$employee->nik_employee])){
                $employee->salary = $arr_employee_salary[$employee->nik_employee]->salary;
                $employee->tunjangan = $arr_employee_salary[$employee->nik_employee]->tunjangan;
                $employee->insentif = $arr_employee_salary[$employee->nik_employee]->insentif;
                $employee->hour_meter_price_uuid = $arr_employee_salary[$employee->nik_employee]->hour_meter_price_uuid;
            }            
        }

        foreach($arr_employee_premi as $employee_premi){
            $col_name = $employee_premi->premi_uuid;
            if(!empty($arr_employee[$employee_premi->employee_uuid])){
                $arr_employee[$employee_premi->employee_uuid]->$col_name = $employee_premi->premi_value;
            }            
        }

      

        // var_dump($arr_employee);die;

        // masukan ke table atribut size
       

        $row = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ','DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DV','DW','DX','DY','DZ'];
        $colomn = [
            'no'=>'No.',
            'nik_employee-one'=>'NIK',
            'name-one'=>'Nama',
            'position-old'=>'Jabatan Lama',
            'position-new'=>'Jabatan Baru',
            'department-old'=>'Department Lama',
            'department-new'=>'Department Baru',	
            'company-old'=>'Site Lama',
            'company-new'=>'Site Baru',	
            'contract_status-old'=>'Kontrak Status Lama',	
            'contract_status-new'=>'Kontrak Status Baru',	
            'employee_status-old'=>'Status Karyawan Lama',	
            'employee_status-new'=>'Status Karyawan Baru',	
            'roaster_uuid-old'=>'Roaster Lama',	
            'roaster_uuid-new'=>'Roaster Baru',	
            'salary-old'=>'Gaji Pokok Lama',
            'salary-new'=>'Gaji Pokok Baru',	
            'insentif-old'=>'Insentif Lama',	
            'insentif-new'=>'Insentif Baru',	
            'tunjangan-old'=>'Tunjangan Lama',	
            'tunjangan-new'=>'Tunajangan Baru',	
            'hour_meter_price_uuid-old'=>'Hm Lama',
            'hour_meter_price_uuid-new'=>'HM BAru'
        ];
        $premis = Premi::all();
        $col = [];
        foreach($premis as $premi){
            $colomn[$premi->uuid.'-old'] = $premi->uuid.' Lama';
            $colomn[$premi->uuid.'-new'] = $premi->uuid.' Baru';
        }
        $colomn['tanggal-efektif'] =  'Tanggal Mulai Efektif';
        $colomn['tanggal-1'] =  'Tanggal diajukan';
        $colomn['tanggal-2'] =  'Jenis Perubahan';
        $colomn['tanggal-3'] =  'Tanggal diproses';
        $colomn['tanggal-4'] =  'Status Perubahan';
       
        $new_column = $colomn;
        // dd($new_column);
        $col_ = 5;
        $row_ = 0;
        $last_col = 0;
        
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        foreach($new_column as $column_excel){
            $createSheet->setCellValue($row[$row_].$col_, $column_excel);
            $last_col = $row_;
            $row_++;
        }

        $col_ = 15;
        foreach($arr_employee as $employee){
            $row_ = 0;
            foreach($new_column as $index=>$column){
                $arr_index = explode('-',$index);
                if(!empty($arr_index[1])){
                    $createSheet->setCellValue($row[$row_].$col_,$employee[$arr_index[0]]);
                }
                $row_++;
            }
            $col_++;
        }

        $status_changges = [
            'ROTASI',
            'MUTASI',
            'DEMOSI',
            'PROMOSI',
            'S-PHK',
            'PENGAJUAN'
        ];
        $col_ = 15;
        foreach($status_changges as $status){
            $createSheet->setCellValue($row[$last_col].$col_, $status);
            $col_++;
        }
       

        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/karyawan_perubahan/Template Karyawan Perubahan -'.'-'.rand(99,9999).'file.xls';
        $crateWriter->save($name);

        return response()->download($name);
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
        
            $no_employee = 6;
            $employees = [];

            while((int)$sheet->getCell( 'A'.$no_employee)->getValue() != null){
                $date_row = 3;

                $employee_uuid = ResponseFormatter::toUUID($sheet->getCell( 'B'.$no_employee)->getValue());
                $date = ResponseFormatter::excelToDate($sheet->getCell( 'F'.$no_employee)->getValue());


                $employee_out = [
                    'employee_uuid'  => $employee_uuid,
                    'out_status' =>  $sheet->getCell( 'E'.$no_employee)->getValue(),
                    'date_out'    => $date
                ];

                // EmployeeOut::updateOrCreate(['uuid'=> $employee_uuid ],$employee_out);
               
                $no_employee++;
            }
        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
        return redirect()->back();
    }
}

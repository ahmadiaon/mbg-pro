<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeSalary;
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
        $employees = Employee::get_employee_active_year_month($year_month);
        $employees = Employee::get_employee_all_latest_full_data();
        // return view('datatableshow', [ 'data'         => $employees]);

        $status_changges = [
            'ROTASI',
            'MUTASI',
            'DEMOSI',
            'PROMOSI',
            'S-PHK',
            'PENGAJUAN'
        ];

        $row = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ','DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DV','DW','DX','DY','DZ'];
        $colomn = [
            'No.',
            'NIK',
            'Nama',
            'Jabatan Lama',
            'Jabatan Baru',
            'Department Lama',
            'Department Baru',	
            'Site Lama',
            'Site Baru',	
            'Atasan Lama',	
            'Atasan Baru',	
            'Kontrak Status',	
            'Kontrak Status Lama',	
            'Status Karyawan Lama',	
            'Status Karyawan Baru',	
            'Gaji Pokok Lama',
            'Gaji Pokok Baru',	
            'Insentif Lama',	
            'Insentif Baru',	
            'Tunjangan Lama',	
            'Tunajangan Baru',	
            'Hm Lama',
            'HM BAru'
        ];
        $row_status_changge = 20;
        $premis = Premi::all();
        $col = [];
        foreach($premis as $premi){
            $col[]=$premi->uuid;
            $col[]=$premi->uuid.' Lama';
            $row_status_changge = $row_status_changge +2;
        }
        $new_column = array_merge($colomn, $col);
        $last =[
            'Tanggal diajukan',
            'Jenis Perubahan',
            'Tanggal diproses',
            'Status Perubahan',
        ];
        $new_column = array_merge($new_column, $last);

        // dd($new_column);
        $col_ = 5;
        $row_ = 0;
        
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        foreach($new_column as $column_excel){
            $createSheet->setCellValue($row[$row_].$col_, $column_excel);
            $row_++;
        }

        $code_row = [
            'B' => 'employee_uuid',
            'C' => 'name',
            'D' => 'position',
            'E' => 'position',
            'F' => 'department',
            'G' => 'department',
            'F' => 'company_uuid',
            'G' => 'company_uuid',
            'J' => 'contract_status',
            'K' => 'contract_status',
            'L' => 'employee_status',
            'M' => 'employee_status',
            'N' => 'salary',
            'O' => 'salary',
            'P' => 'insentif',
            'Q' => 'insentif',
            'R' => 'tunjangan',
            'S' => 'tunjangan',
            'T' => 'hour_meter_price_uuid',
            'U' => 'hour_meter_price_uuid',
        ];
        $col_ = 6;
        foreach($employees as $employee){
            foreach ($code_row as $code=>$key) {
                $col_name = $key;
                $createSheet->setCellValue($code.$col_, $employee->$col_name);
            }
            $row_ = 21;
            foreach($premis as $premi){
                $createSheet->setCellValue($row[$row_].$col_, $employee[$premi->uuid]);

                
                $createSheet->setCellValue($row[$row_+1].$col_, $employee[$premi->uuid]);
                $row_ = $row_ + 2;
            }
            $col_++;
        }


        $col_ = $col_ + 100;
        $row_status_changge = $row_status_changge+2;
        foreach($status_changges as $item){
            $createSheet->setCellValue($row[$row_status_changge].$col_, $item);
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
            $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
        return redirect()->back();
    }
}

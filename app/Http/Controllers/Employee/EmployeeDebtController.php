<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeDebt;
use App\Models\Employee\EmployeePaymentDebt;
use App\Models\PaymentOther;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use Illuminate\Support\Facades\DB;

class EmployeeDebtController extends Controller
{
    public function index(){
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employee-debt'
        ];
        $payment_others = PaymentOther::all();
        $employees = Employee::getAll();
        return view('employee_debt.index', [
            'title'         => 'Hutang',
            'layout'    => $layout,
            'employees' => $employees,
            'payment_others'    => $payment_others,
            'year_month'        => Carbon::today()->isoFormat('Y-M')
        ]);
    }

    public function export($year_month){
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $createSheet->setCellValue('C1', 'Template Penambahan Hutang');
        
        $createSheet->setCellValue('B1', 'Excel');
        $createSheet->setCellValue('B3', 'Bulan');
        $createSheet->setCellValue('B4', 'Tahun');

        $createSheet->setCellValue('C3', $month);
        $createSheet->setCellValue('C4', $year);
        $createSheet->setCellValue('A5', 'No');
        $createSheet->setCellValue('B5', 'NIK');
        $createSheet->setCellValue('C5', 'Nama');
        $createSheet->setCellValue('D5', 'Jabatan');
        $createSheet->setCellValue('E5', 'Tanggal Pinjaman');
        $createSheet->setCellValue('F5', 'Besar Pinjaman');
        $createSheet->setCellValue('D5', 'Jabatan');
        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/file-pinjaman-'.$year_month.'-'.rand(99,9999).'file.xls';
        $crateWriter->save($name);

        // return 'aaa';
        return response()->download($name);
    }

    public function import(Request $request){
        $the_file = $request->file('uploaded_file');
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();

        try{
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();

            $abjads = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ','DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DV','DW','DX','DY','DZ'];
            $year = $sheet->getCell('C4')->getValue();
            $month = $sheet->getCell('C3')->getValue();
            $year_month = $year.'-'.$month;
            $day_month = ResponseFormatter::getEndDay($year_month);

            $dates = $year.'-'.$month.'-'.'1';
            $default_date = $year_month.'-'.$day_month;

            $no_employee = 6;
            $employees = [];

            while((int)$sheet->getCell( 'A'.$no_employee)->getValue() != null){
                $employee_uuid = ResponseFormatter::toUUID($sheet->getCell( 'B'.$no_employee)->getValue());
                $date_debt = ResponseFormatter::excelToDate($sheet->getCell( 'E'.$no_employee)->getValue());
                if(empty($date_debt)){
                    $date_debt = $default_date;
                }

                $value_debt = $sheet->getCell( 'F'.$no_employee)->getValue();
                $value_debt = (int)$value_debt;           
           

                $employee_debt = [
                    'uuid' => $employee_uuid.'-'.$default_date,
                    'employee_uuid' => $employee_uuid,
                    'date_debt' =>  $date_debt,
                    'value_debt' => $value_debt ,
                    'min_payment_debt' => 0,
                    'max_payment_debt' => $value_debt,
                ];
                // dd(  $employee_debt);
                $store_employee_debt = EmployeeDebt::updateOrCreate(['uuid'  => $employee_debt['uuid']], $employee_debt);

                $no_employee++;
            }
            return back();
        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
    }

    public function anyData(){
        $arr_employee_debt = Employee::noGet_employeeAll_detail()->join('employee_debts','employee_debts.employee_uuid', 'employees.uuid')
        ->groupBy(
            'user_details.photo_path',
            'user_details.name',
            'employees.nik_employee',
            'positions.position',
        )
        ->select(
            'user_details.photo_path',
            'user_details.name',
            'employees.nik_employee',
            'positions.position',
            DB::raw("SUM(employee_debts.value_debt) as value_debt")
        )
        ->get();

        // dd($arr_employee_debt);

        $data_sum = EmployeePaymentDebt::join('employees','employees.uuid', 'employee_payment_debts.employee_uuid')
        ->join('positions','positions.uuid','employees.position_uuid')
        ->join('user_details','user_details.uuid','employees.user_detail_uuid')
        ->groupBy(
            'user_details.name',
            'employee_payment_debts.employee_uuid',
            'positions.position',
            'employees.nik_employee',
        )
        ->select( 
            'user_details.name',
            'employee_payment_debts.employee_uuid',
            'positions.position',
            'employees.nik_employee',
            DB::raw("SUM(employee_payment_debts.value_payment_debt) as value_payment_debt")
        )
        ->get();
        $data_sum = ResponseFormatter::createIndexArray($data_sum,'nik_employee');
      
        foreach($arr_employee_debt as $dt){            
            $dt->remaining_new_debt = $dt->value_debt -  $data_sum[$dt->nik_employee]->value_payment_debt;
        }







        

        return ResponseFormatter::toJson($arr_employee_debt,'data employee debt');

        dd($arr_employee_debt);
    }
}

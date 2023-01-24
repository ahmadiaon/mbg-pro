<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeDebt;
use App\Models\Employee\EmployeePaymentDebt;
use App\Models\Employee\EmployeePaymentOther;
use App\Models\PaymentOther;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class EmployeePaymentDebtController extends Controller
{
    public function index(){
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employee-payment-debt'
        ];
        $payment_others = PaymentOther::all();
        $employees = Employee::getAll();
        return view('employee_payment_debt.index', [
            'title'         => 'Pembayaran Hutang',
            'layout'    => $layout,
            'employees' => $employees,
            'payment_others'    => $payment_others,
            'year_month'        => Carbon::today()->isoFormat('Y-M')
        ]);
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
                $value_payment_debt = $sheet->getCell( 'F'.$no_employee)->getValue();
                $value_payment_debt = (int)$value_payment_debt;  
                $date_debt = ResponseFormatter::excelToDate($sheet->getCell( 'E'.$no_employee)->getValue());
                
                if(empty($date_debt)){
                    $date_debt = $default_date;
                }

                $get_employee_debt = EmployeeDebt::where('employee_uuid', $employee_uuid)->get();

                if($get_employee_debt->count() <= 0){
                    $employee_debt = [
                        'uuid' => $employee_uuid.'-'.$default_date,
                        'employee_uuid' => $employee_uuid,
                        'date_debt' =>  $date_debt,
                        'value_debt' => $value_payment_debt ,
                        'min_payment_debt' => 0,
                        'max_payment_debt' => $value_payment_debt,
                    ];
                    $store_employee_debt = EmployeeDebt::updateOrCreate(['uuid'  => $employee_debt], $employee_debt);
                }

                $employee_payment_debt = [
                    'uuid' => $employee_uuid.'-'.$default_date,
                    'employee_uuid' => $employee_uuid,
                    'date_payment_debt' =>  $date_debt,
                    'value_payment_debt' => $value_payment_debt
                ];
                $store_employee_payment = EmployeePaymentDebt::updateOrCreate(['uuid' => $employee_payment_debt['uuid']],$employee_payment_debt);

                $no_employee++;
            }
            return back();
        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
    }
    public function export($year_month){
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $createSheet->setCellValue('C1', 'Template Pembayaran Hutang');
        
        $createSheet->setCellValue('B1', 'Excel');
        $createSheet->setCellValue('B3', 'Bulan');
        $createSheet->setCellValue('B4', 'Tahun');

        $createSheet->setCellValue('C3', $month);
        $createSheet->setCellValue('C4', $year);
        $createSheet->setCellValue('A5', 'No');
        $createSheet->setCellValue('B5', 'NIK');
        $createSheet->setCellValue('C5', 'Nama');
        $createSheet->setCellValue('D5', 'Jabatan');
        $createSheet->setCellValue('E5', 'Tanggal Bayar');
        $createSheet->setCellValue('F5', 'Besar Bayar');
        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/file-pembayaran-'.$year_month.'-'.rand(99,9999).'file.xls';
        $crateWriter->save($name);

        // return 'aaa';
        return response()->download($name);

    }

    public function anyDataMonth($year_month){
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];

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
        $arr_employee_debt = ResponseFormatter::createIndexArray($arr_employee_debt,'nik_employee');



        $data = EmployeePaymentDebt::join('employees','employees.uuid', 'employee_payment_debts.employee_uuid')
        ->join('positions','positions.uuid','employees.position_uuid')
        ->join('user_details','user_details.uuid','employees.user_detail_uuid')
        ->whereYear('employee_payment_debts.date_payment_debt', $year)
        ->whereMonth('employee_payment_debts.date_payment_debt', $month)
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


        foreach($data as $dt){
            $dt->value_debt = $arr_employee_debt[$dt->employee_uuid]->value_debt ;
            $dt->remaining_old_debt = $arr_employee_debt[$dt->employee_uuid]->value_debt -$data_sum[$dt->employee_uuid]->value_payment_debt + $dt->value_payment_debt;
            
            $dt->remaining_new_debt = $arr_employee_debt[$dt->employee_uuid]->value_debt -  $dt->value_payment_debt ;
        }

       
        return ResponseFormatter::toJson($data, 'data employee payment debt');
        return DataTables::of($data)
        ->make(true);
    }
}

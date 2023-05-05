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
    
    public function delete(Request $request)
    { //used
        $validatedData = $request->all();
        $storeData = EmployeePaymentDebt::where('uuid' , $validatedData['uuid'])->delete();
        return ResponseFormatter::toJson($storeData, 'Data Stored');
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
            $default_date = $year_month.'-01';

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

                $row_data = [
                    'uuid' => $employee_uuid.'-'.$date_debt,
                    'employee_uuid' => $employee_uuid,
                    'date_payment_debt' => $date_debt,
                    'value_payment_debt' => $value_payment_debt,
                ];
                // dd($row_data);
                $store_employee_debt = EmployeePaymentDebt::updateOrCreate(['uuid'  => $row_data['uuid']], $row_data);
                $no_employee++;
            }
            return back();
        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
    }
    public function export(){
        $arr_date_today = (session('year_month'));        
        $year_month = $arr_date_today['year'] . '-' . $arr_date_today['month'];        
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
    public function store(Request $request)
    { //used
        $validatedData = $request->all();

        if (empty($validatedData['uuid'])) {
            $validatedData['uuid'] = $validatedData['employee_uuid'] . '-' .  $validatedData['date_payment_debt'];
        }

        $storeData = EmployeePaymentDebt::updateOrCreate(['uuid' =>  $validatedData['uuid']], $validatedData);

        return ResponseFormatter::toJson($storeData, 'Data Stored');
    }
}

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

            $dates = $year.'-'.$month.'-'.'1';

            $no_employee = 6;
            $employees = [];

            while((int)$sheet->getCell( 'A'.$no_employee)->getValue() != null){
                $remaining_old_debt = $sheet->getCell( 'F'.$no_employee)->getValue();
                $value_payment_debt = $sheet->getCell( 'G'.$no_employee)->getValue();
                $remaining_new_debt = $sheet->getCell( 'H'.$no_employee)->getValue();

                
                $remaining_new_debt = $sheet->getCell( 'H'.$no_employee)->getValue();
                $employee_uuid = ResponseFormatter::toUUID($sheet->getCell( 'B'.$no_employee)->getValue());
                $employee_debt_uuid = 'DEBT-'.$employee_uuid;

                $employee_debt = [
                    'uuid' => $employee_debt_uuid,
                    'employee_uuid' => $employee_uuid,
                    'date_debt' =>  $dates,
                    'value_debt' => $remaining_old_debt ,
                    'min_payment_debt' => 0,
                    'max_payment_debt' => $remaining_old_debt,
                ];
                $store_employee_debt = EmployeeDebt::updateOrCreate(['uuid'  => $employee_debt_uuid], $employee_debt);

                $employees_data = [
                    'uuid'  => 'PAYMENT-DEBT-'.$store_employee_debt->uuid.'-'.$store_employee_debt->date_debt,
                    'debt_uuid' => $store_employee_debt->uuid,
                    'date_payment_debt' => $dates,
                    'remaining_old_debt' => $remaining_old_debt,
                    'value_payment_debt' =>$value_payment_debt,
                    'remaining_new_debt' =>$remaining_new_debt
                ];

                $store_employee_payment = EmployeePaymentDebt::updateOrCreate(['uuid' => $employees_data['uuid']],$employees_data);
                $no_employee++;
            }
            return back();
        } catch (Exception $e) {
            $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
    }

    public function anyDataMonth($year_month){
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];

        $data = EmployeePaymentDebt::join('employee_debts','employee_debts.uuid', 'employee_payment_debts.debt_uuid')
        ->join('employees','employees.uuid', 'employee_debts.employee_uuid')
        ->join('positions','positions.uuid','employees.position_uuid')
        ->join('user_details','user_details.uuid','employees.user_detail_uuid')
        ->whereYear('employee_payment_debts.date_payment_debt', $year)
        ->whereMonth('employee_payment_debts.date_payment_debt', $month)
        ->get([
            'user_details.name',
            'employee_debts.employee_uuid',
            'employee_debts.value_debt',
            'positions.position',
            'employees.nik_employee',
            'employee_payment_debts.*',
            ]
        );
        return DataTables::of($data)
        ->make(true);
    }
}

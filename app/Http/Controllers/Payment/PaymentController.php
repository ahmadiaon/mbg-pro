<?php

namespace App\Http\Controllers\Payment;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeePayment;
use App\Models\Payment\Payment;
use App\Models\Payment\PaymentGroup;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class PaymentController extends Controller
{
    public function store(Request $request){
        $validatedData = $request->validate([
            'uuid' => '',
            'payment_group_uuid' => '',
            'date' => '',
            'date_end' => '',
            'long' => '',
            'employee_create_uuid' => '',
            'employee_know_uuid' => '',
            'employee_approve_uuid' => '',
            'description' => '',
        ]);
        


        if(empty($validatedData['uuid'])){
            $validatedData['uuid'] = $validatedData['date'].'-'.$validatedData['payment_group_uuid'].'-'.rand(99,999);
        }
        // return ResponseFormatter::toJson($validatedData, "request");
        $store = Payment::updateOrCreate(['uuid' => $validatedData['uuid']], $validatedData);
        return ResponseFormatter::toJson($store, "request");
        
    }

    public function import(Request $request){

        // return 'aaa';
        $the_file = $request->file('uploaded_file');
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();

        try{
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $row_limit    = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range    = range( 2, $row_limit );
            $column_range = range( 'C', $column_limit );
            $startcount = 2;
            $data = array();

            $abjads = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ','DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DV','DW','DX','DY','DZ'];
        
            // DESCRIPTION
            $month_hm =  $sheet->getCell( 'C3')->getValue();
            $year_hm = $sheet->getCell( 'C4')->getValue();
            $datetime = Carbon::createFromFormat('Y-m', $year_hm.'-'.$month_hm);
            // return $day_month = Carbon::parse($datetime)->endOfMonth()->isoFormat('D');


            $no_employee = 6;
            $employees = [];
            /*
            1. loop all employee
            2.
            EmployeeHourMeterDay::
            */
            // mobililsasi
            while((int)$sheet->getCell( 'A'.$no_employee)->getValue() != null){
                $excelDate= $sheet->getCell( 'E'.$no_employee)->getValue();
             

                $date = ResponseFormatter::excelToDate($excelDate);
           
                $date_end = date('Y-m-d', strtotime($date. ' + 1 days'));
                $payment_group_uuid = ResponseFormatter::toUUID($sheet->getCell( 'F'.$no_employee)->getValue());
                PaymentGroup::updateOrCreate(['uuid' => $payment_group_uuid], ['payment_group' => $payment_group_uuid, 'date_start' => '2022-01-01']);
                $nik_employee = ResponseFormatter::toUUID($sheet->getCell( 'B'.$no_employee)->getValue());
                $data_payment = [
                    'uuid' => $payment_group_uuid.'-'.$date.'-'.$nik_employee.'-'.$sheet->getCell( 'A'.$no_employee)->getValue(),
                    'payment_group_uuid' => $payment_group_uuid,
                    'date' => $date,
                    'date_end' => $date_end,
                    'long' => 1,
                    'employee_create_uuid' => '',
                    'employee_know_uuid' => '',
                    'employee_approve_uuid' => '',
                    'description' => $sheet->getCell( 'H'.$no_employee)->getValue(),
                ];
                Payment::updateOrCreate(['uuid' =>$data_payment['uuid'] ],$data_payment);
                $data_employee_payment = [
                    'uuid' => $payment_group_uuid.'-'.$date.'-'.$nik_employee.'-'.$sheet->getCell( 'A'.$no_employee)->getValue(),
                    'employee_uuid' => $nik_employee,
                    'payment_uuid' => $data_payment['uuid'],
                    'value' => $sheet->getCell( 'J'.$no_employee)->getValue(),
                    'link_absen' => 'none',
                ];
                EmployeePayment::updateOrCreate(['uuid' =>$data_employee_payment['uuid'] ],$data_employee_payment);
              
                $no_employee++;
            }
            return back();
            dd($employees);
        } catch (Exception $e) {
            $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
    }

    public function export($year_month){
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];
        $month = (int)$month;
        $months = ["","Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $abjads = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ','DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DV','DW','DX','DY','DZ'];
        
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $createSheet->setCellValue('B1', 'Template Pembayaran');
        
        $createSheet->setCellValue('C1', 'Excel');
        $createSheet->setCellValue('B3', 'Bulan');
        $createSheet->setCellValue('B4', 'Tahun');

        $createSheet->setCellValue('C3', $month);
        $createSheet->setCellValue('C4', $year);

        $createSheet->setCellValue('A5', 'No.');
        $createSheet->setCellValue('C5', 'Nama');
        $createSheet->setCellValue('B5', 'NIK');
        $createSheet->setCellValue('D5', 'Jabatan');
        $createSheet->setCellValue('E5', 'TANGGAL');
        $createSheet->setCellValue('F5', 'Kegiatan');
        $createSheet->setCellValue('G5', 'Jumlah');
        $createSheet->setCellValue('H5', 'Keterangan');
        $createSheet->setCellValue('I5', 'Harga Satuan (Rp.)');
        $createSheet->setCellValue('J5', 'Total (Rp.)');


        $payments = Payment::join('payment_groups','payment_groups.uuid','payments.payment_group_uuid')
        ->join('employee_payments','employee_payments.payment_uuid','payments.uuid')
        ->join('employees','employees.uuid','employee_payments.employee_uuid')
        ->join('user_details','user_details.uuid','employees.user_detail_uuid')
        ->join('positions','positions.uuid','employees.position_uuid')
        ->whereYear('payments.date', $year)
        ->whereMonth('payments.date', $month)
        ->get([
            'payments.*',
            'positions.position',
            'user_details.name',
            'payment_groups.payment_group',
            'employee_payments.*'
        ]);

        $employee_row = 6;

        foreach($payments as $payment){

            $createSheet->setCellValue('A'.$employee_row,  $employee_row-5); 
            $createSheet->setCellValue('B'.$employee_row,  $payment->employee_uuid); 
            $createSheet->setCellValue('C'.$employee_row,  $payment->name); 
            $createSheet->setCellValue('D'.$employee_row,  $payment->position); 
            $createSheet->setCellValue('E'.$employee_row,  $payment->date); 
            $createSheet->setCellValue('F'.$employee_row,  $payment->description); 
            $createSheet->setCellValue('G'.$employee_row,  '1'); 
            $createSheet->setCellValue('H'.$employee_row,  $payment->payment_group); 
            $createSheet->setCellValue('I'.$employee_row,  $payment->value); 
            $createSheet->setCellValue('J'.$employee_row,  $payment->value); 

            $employee_row++;
        }

        // dd($payments);









        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/Pembayaran-'.$year_month.'-'.rand(99,9999).'file.xls';
        $crateWriter->save($name);

        return response()->download($name);

        return $year_month;
    }

    public function show($uuid){
        $payment = Payment::where('uuid', $uuid)->get()->first();
        $employee_payments = EmployeePayment::where('payment_uuid', $uuid)->get();

        $employees = Employee::getAll();
        $payment_groups = PaymentGroup::get();

        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employee-payment'
        ];
        return view('employee_payment.create', [
            'title'         => 'Tonase',
            'employees' => $employees,
            'payment'   => $payment,
            'employee_payments'     => $employee_payments,
            'payment_groups' => $payment_groups,
            'layout'    => $layout
        ]);

    }
    

    public function indexPayrol($year_month){
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];
        

        $employees = Employee::getAll();

        // dd($employees);
        // return $employees;
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'payment'
        ];
        return view('payment.payrol.index', [
            'title'         => 'Mobilisasi Karyawan',
            'employees' => $employees,
            'month'     => $year.'-'.$month,
            'layout'    => $layout
        ]);
    }
    public function createPayrol(){
        $employees = Employee::getAll();

        $payment_groups = PaymentGroup::all();
        $layout = [
                'head_core'            => true,
                'javascript_core'       => true,
                'head_datatable'        => true,
                'javascript_datatable'  => true,
                'head_form'             => true,
                'javascript_form'       => true,
                'active'                        => 'payment-employee'
            ];
            return view('payment.payrol.create', [
                'title'         => 'Mobilisasi Karyawan',
                'payment_groups' => $payment_groups,
                'employees' => $employees,
                'uuid'      => '',
                'layout'    => $layout
            ]);
    }

    public function storePayrol(Request $request){
        $validatedData = $request->validate([
            'uuid' => '',
            'payment_group_uuid' => '',
            'date' => '',
            'known_employee_uuid' => '',
            'approve_employee_uuid' => '',
            'create_employee_uuid' => '',
            'description' => '',
        ]);
        


        if(!$validatedData['uuid']){
            $validatedData['uuid'] = "uuid".Str::uuid();
        }
         
        $store = Payment::updateOrCreate(['uuid' => $validatedData['uuid']], $validatedData);
        return ResponseFormatter::toJson($validatedData, "request");
        
    }
    
    public function editPayrol($uuid){
        $employees = Employee::getAll();
        
        $payment_groups = PaymentGroup::all();
        $layout = [
                'head_core'            => true,
                'javascript_core'       => true,
                'head_datatable'        => true,
                'javascript_datatable'  => true,
                'head_form'             => true,
                'javascript_form'       => true,
                'active'                        => 'payment-employee'
            ];
        return view('payment.payrol.create', [
            'title'         => 'Mobilisasi Karyawan',
            'payment_groups' => $payment_groups,
            'employees' => $employees,
            'uuid'      => $uuid,
            'layout'    => $layout
        ]);
    }
    public function showPayrol(Request $request){
        
        $data = Payment::where('uuid', $request->uuid)->get()->first();
        return ResponseFormatter::toJson($data, 'Data Payment');
    }
    public function dataPayment($year_month){
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];
        $payments = Payment::join('payment_groups','payment_groups.uuid','payments.payment_group_uuid')
        ->whereYear('payments.date', $year)
        ->whereMonth('payments.date', $month)
        ->get([
            'payments.*',
            'payment_groups.payment_group'
        ]);
        
        return Datatables::of($payments)
        ->addColumn('action', function ($model) {
            $url = "/payrol/payment/show/".$model->uuid;
            
            return '<a class="text-decoration-none" href="'.$url.'">
                            <button class="btn btn-secondary py-1 px-2 mr-1">
                                <i class="icon-copy bi bi-eye-fill"></i>
                            </button>
                        </a>
            ';
        })         
        ->make(true);
    }
}

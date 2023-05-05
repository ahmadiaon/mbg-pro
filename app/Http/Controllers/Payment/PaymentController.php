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
        $validatedData = $request->all();
        


        if(empty($validatedData['uuid'])){
            $validatedData['uuid'] = $validatedData['date'].'-'.$validatedData['payment_group_uuid'].'-'.ResponseFormatter::toUUID($validatedData['description']);
        }
       
        $store = Payment::updateOrCreate(['uuid' => $validatedData['uuid']], $validatedData);
        return ResponseFormatter::toJson($store, "request");
        
    }

    public function import(Request $request){//used
        $the_file = $request->file('uploaded_file');
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();

        try{
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();

            $abjads = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ','DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DV','DW','DX','DY','DZ'];
        
            // DESCRIPTION

            $month_ =  $sheet->getCell('C3')->getValue();
            $year_ = $sheet->getCell('C4')->getValue();
            $no_employee = 6;
            $employees = [];
            /*
            1. loop all employee
            2.
            EmployeeHourMeterDay::
            */
            // mobililsasi
            $row_data_payment = [];
            $row_data_employee_payment = [];
            $all_row_data_payment = [];
            $all_row_data_employee_payment = [];
            $arr_data_employee_hour_meter_day = EmployeePayment::join('payments','payments.uuid','employee_payments.payment_uuid')
                        ->whereYear('payments.date', $year_)
                        ->whereMonth('payments.date', $month_)
                        ->delete();

            $arr_data_employee_hour_ = Payment::whereYear('date', $year_)
                        ->get();

            // dd($arr_data_employee_hour_);
            while((int)$sheet->getCell( 'A'.$no_employee)->getValue() != null){
                $excelDate= $sheet->getCell( 'E'.$no_employee)->getValue();     
                $date = ResponseFormatter::excelToDate($excelDate);           
                $date_end = $date;

                $payment_group_uuid = ResponseFormatter::toUUID($sheet->getCell( 'F'.$no_employee)->getValue());
                $nik_employee = ResponseFormatter::toUUID($sheet->getCell( 'B'.$no_employee)->getValue());

                PaymentGroup::updateOrCreate(['uuid' => $payment_group_uuid], ['payment_group' => $sheet->getCell( 'F'.$no_employee)->getValue(), 'date_start' => '2022-01-01']);
                
                $row_data_payment = [
                    'uuid' => $date.'-'.ResponseFormatter::toUUID($sheet->getCell( 'G'.$no_employee)->getValue()),
                    'payment_group_uuid' =>$payment_group_uuid,
                    'date' =>  $date,
                    'date_end' =>  $date,
                    'description' => $sheet->getCell( 'G'.$no_employee)->getValue(),
                    'long'  => 1,
                ];

                $all_row_data_payment[] = $row_data_payment;

                $row_data_employee_payment = [
                    'uuid' => $nik_employee.'-'.$row_data_payment['uuid'],
                    'employee_uuid' =>$nik_employee,
                    'payment_uuid' =>  $row_data_payment['uuid'],
                    'value' =>  ResponseFormatter::toNumber($sheet->getCell( 'H'.$no_employee)->getValue()),
                    'link_absen' => 'none',
                ];

                $all_row_data_employee_payment[] = $row_data_employee_payment;

                $data_payment = [
                    'uuid' => $date.'-'.$payment_group_uuid.'-'.ResponseFormatter::toUUID($sheet->getCell( 'G'.$no_employee)->getValue()),
                    'payment_group_uuid' => $payment_group_uuid,
                    'date' => $date,
                    'date_end' => $date_end,
                    'long' => 1,
                    'description' => $sheet->getCell( 'G'.$no_employee)->getValue(),
                ];

                $no_employee++;
            }
            $xy =Payment::insert(
                $all_row_data_payment
            );
            $xyz =EmployeePayment::insert(
                $all_row_data_employee_payment
            );
            // dd($all_row_data_employee_payment);
            return back();
            dd($employees);
        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
    }

    public function export(){//used
        $arr_date_today = (session('year_month'));
        $year_month = $arr_date_today['year'] . '-' . $arr_date_today['month'];
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
        $createSheet->setCellValue('G5', 'Keterangan');
        $createSheet->setCellValue('H5', 'Total (Rp.)');


        $payments = Payment::join('payment_groups','payment_groups.uuid','payments.payment_group_uuid')
        ->join('employee_payments','employee_payments.payment_uuid','payments.uuid')
        ->join('employees','employees.uuid','employee_payments.employee_uuid')
        ->join('user_details','user_details.uuid','employees.user_detail_uuid')
        ->join('positions','positions.uuid','employees.position_uuid')
        ->whereNull('employees.date_end')
        ->whereNull('user_details.date_end')
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
            $createSheet->setCellValue('F'.$employee_row,  $payment->payment_group); 
            $createSheet->setCellValue('G'.$employee_row,  $payment->description); 
            $createSheet->setCellValue('H'.$employee_row,  $payment->value); 

            $employee_row++;
        }

        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/Pembayaran-'.$year_month.'-'.rand(99,9999).'file.xls';
        $crateWriter->save($name);

        return response()->download($name);

        return $year_month;
    }

    public function show($uuid){
        $payment = Payment::where('uuid', $uuid)->get()->first();
        $employee_payments = EmployeePayment::where('payment_uuid', $uuid)->get();

        $employees = Employee::data_employee();
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

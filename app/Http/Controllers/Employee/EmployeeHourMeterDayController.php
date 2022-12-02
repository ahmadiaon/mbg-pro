<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeHourMeterDay;
use App\Models\HourMeterPrice;
use App\Models\Identity;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\Datatables\Datatables;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class EmployeeHourMeterDayController extends Controller
{
    //

    public function anyDataMonth($year_month){
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];

        
        $data = EmployeeHourMeterDay::leftJoin('employees','employees.uuid','employee_hour_meter_days.employee_uuid')
        ->leftJoin('user_details','user_details.uuid','employees.user_detail_uuid')
        ->leftJoin('positions','positions.uuid','employees.position_uuid')
        ->leftJoin('hour_meter_prices','hour_meter_prices.uuid','employee_hour_meter_days.hour_meter_price_uuid')
        ->whereYear('employee_hour_meter_days.date', $year)
        ->whereMonth('employee_hour_meter_days.date', $month)
        ->groupBy(
            'employees.nik_employee',
            'user_details.photo_path',
            // 'hour_meter_prices.value',
            'positions.position',
            'employees.uuid',
            'employees.nik_employee',
            'user_details.name',
           )
        ->select( 
            'user_details.name',
            'user_details.photo_path',
            'positions.position',
            'employees.uuid',
            'employees.nik_employee',
            // 'hour_meter_prices.value as hour_meter_price',
            DB::raw("count(employee_hour_meter_days.value) as count_hour_meter"),
            DB::raw("SUM(employee_hour_meter_days.value) as hour_meter_value"),
            DB::raw("SUM(employee_hour_meter_days.full_value) as hour_meter_full_value"),
        )
        ->get();
        // dd($data);
        return Datatables::of($data)
        ->make(true);
    }

    public function anyDataUuid($hour_meter_uuid){

        $data = EmployeeHourMeterDay::leftJoin('employees','employees.uuid','employee_hour_meter_days.employee_uuid')
        ->leftJoin('user_details','user_details.uuid','employees.user_detail_uuid')
        ->leftJoin('positions','positions.uuid','employees.position_uuid')
        ->leftJoin('hour_meter_prices','hour_meter_prices.uuid','employee_hour_meter_days.hour_meter_price_uuid')
        ->where('employee_hour_meter_days.uuid', $hour_meter_uuid)
        ->groupBy(
            'employee_hour_meter_days.uuid',
            'employee_hour_meter_days.full_value',
            'employee_hour_meter_days.updated_at',
            'employees.nik_employee',
            'user_details.photo_path',
            'hour_meter_prices.value',
            'positions.position',
            'employees.uuid',
            'employees.nik_employee',
            'user_details.name',
            'employee_hour_meter_days.date',
            'employee_hour_meter_days.value')
        ->select( 
            'employee_hour_meter_days.updated_at',
            'employee_hour_meter_days.date',
            'employee_hour_meter_days.uuid as hour_meter_uuid',
            'user_details.name',
            'user_details.photo_path',
            'positions.position',
            'employees.uuid',
            'employees.nik_employee',
            'hour_meter_prices.value as hour_meter_price',
            'employee_hour_meter_days.value as hour_meter_value',
            'employee_hour_meter_days.full_value as hour_meter_full_value',
        )
        ->get();

        return Datatables::of($data)
        ->make(true);
    }

    public function anyDataMonthEmployee($nik_employee, $year_month){

        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];

        $data = EmployeeHourMeterDay::leftJoin('employees','employees.uuid','employee_hour_meter_days.employee_uuid')
        ->leftJoin('user_details','user_details.uuid','employees.user_detail_uuid')
        ->leftJoin('positions','positions.uuid','employees.position_uuid')
        ->leftJoin('hour_meter_prices','hour_meter_prices.uuid','employee_hour_meter_days.hour_meter_price_uuid')
        ->where('employee_hour_meter_days.employee_uuid', $nik_employee)
        ->whereYear('employee_hour_meter_days.date', $year)
        ->whereMonth('employee_hour_meter_days.date', $month)
        ->groupBy(
            'employee_hour_meter_days.uuid',
            'employee_hour_meter_days.full_value',
            'employee_hour_meter_days.updated_at',
            'employees.nik_employee',
            'user_details.photo_path',
            'hour_meter_prices.value',
            'positions.position',
            'employees.uuid',
            'employees.nik_employee',
            'user_details.name',
            'employee_hour_meter_days.date',
            'employee_hour_meter_days.shift',
            'employee_hour_meter_days.value')
        ->select( 
            'employee_hour_meter_days.updated_at',
            'employee_hour_meter_days.date',
            'employee_hour_meter_days.uuid as hour_meter_uuid',
            'user_details.name',
            'user_details.photo_path',
            'positions.position',
            'employee_hour_meter_days.shift',
            'employees.uuid',
            'employees.nik_employee',
            'hour_meter_prices.value as hour_meter_price',
            'employee_hour_meter_days.value as hour_meter_value',
            'employee_hour_meter_days.full_value as hour_meter_full_value',
        )
        ->get();

        return Datatables::of($data)
        ->make(true);
    }

    public function anyDataDay($year_month_day){

        $data = EmployeeHourMeterDay::leftJoin('employees','employees.uuid','employee_hour_meter_days.employee_uuid')
        ->leftJoin('user_details','user_details.uuid','employees.user_detail_uuid')
        ->leftJoin('positions','positions.uuid','employees.position_uuid')
        ->leftJoin('hour_meter_prices','hour_meter_prices.uuid','employee_hour_meter_days.hour_meter_price_uuid')
        ->where('employee_hour_meter_days.date', $year_month_day)
        ->groupBy(
            'employee_hour_meter_days.uuid',
            'employees.nik_employee',
            'user_details.photo_path',
            'hour_meter_prices.value',
            'positions.position',
            'employees.uuid',
            'employees.nik_employee',
            'user_details.name',
            'employee_hour_meter_days.value')
        ->select( 
            'user_details.name',
            'user_details.photo_path',
            'positions.position',
            'employees.uuid',
            'employees.nik_employee',
            'employee_hour_meter_days.uuid as hour_meter_uuid',
            'hour_meter_prices.value as hour_meter_price',
            DB::raw("count(employee_hour_meter_days.value) as count_hour_meter"),
            DB::raw("SUM(employee_hour_meter_days.value) as hour_meter_value"),
            DB::raw("SUM(employee_hour_meter_days.full_value) as hour_meter_full_value"),
        )
        ->get();

        return Datatables::of($data)
        ->make(true);
    }

    public function anyDataAll(){



        $data = EmployeeHourMeterDay::leftJoin('employees','employees.uuid','employee_hour_meter_days.employee_uuid')
        ->leftJoin('user_details','user_details.uuid','employees.user_detail_uuid')
        ->leftJoin('positions','positions.uuid','employees.position_uuid')
        ->leftJoin('hour_meter_prices','hour_meter_prices.uuid','employee_hour_meter_days.hour_meter_price_uuid')
      
        ->get([
                    'user_details.name',
                    'employees.nik_employee',
                    'positions.position',
                    'employee_hour_meter_days.date',
                    'employee_hour_meter_days.value',
                    'employee_hour_meter_days.full_value',
                    'hour_meter_prices.value as hour_meter_price'
        ]);

        // $data = EmployeeHourMeterDay::join('payments', 'payments.uuid' , 'employee_payments.payment_uuid')
        // ->leftJoin('employees','employees.uuid','employee_payments.employee_uuid')
        // ->leftJoin('user_details','user_details.uuid','employees.user_detail_uuid')
        // ->leftJoin('positions','positions.uuid','employees.position_uuid')
        // ->leftJoin('payment_groups','payment_groups.uuid','payments.payment_group_uuid')
        // ->whereYear('payments.date', $year)
        // ->whereMonth('payments.date', $month)
        // ->get([
        //     'user_details.name',
        //     'employees.nik_employee',
        //     'positions.position',
        //     'employee_payments.payment_uuid',
        //     'payments.description',
        //     'payments.date',
        //     'payments.uuid',
        //     'employee_payments.value',
        //     'payment_groups.payment_group'
        // ]);
        dd($data);


        
        
        return Datatables::of($data)
        ->make(true);
    }

    public function create(){
        $employees = Employee::getAll();
        $hour_meter_prices =HourMeterPrice::all();
        // Carbon::today()->isoFormat('Y-M-D');
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employee-hour-meter'
        ];

        return view('employee_hour_meter_day.create', [
            'title'         => 'Hour Meter Day',
            'employees' => $employees,
            'today'        => Carbon::today()->isoFormat('Y-M-D'),
            'hour_meter_prices' => $hour_meter_prices,
            'hour_meter_uuid' => '',
            'year_month' => '',
            'nik_employee' => '',
            'layout'    => $layout
        ]);
    }

    public function export($year_month){
        $abjads = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ','DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DV','DW','DX','DY','DZ'];
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];

        $datetime = Carbon::createFromFormat('Y-m', $year.'-'.$month);
        $day_month = Carbon::parse($datetime)->endOfMonth()->isoFormat('D');

        $employees = Employee::leftJoin('user_details', 'user_details.uuid', 'employees.user_detail_uuid')
        ->leftJoin('employee_salaries', 'employee_salaries.employee_uuid', 'employees.uuid')
        ->leftJoin('positions','positions.uuid', 'employees.position_uuid')
        ->get([
            'user_details.name',
            'employees.nik_employee',
            'employees.uuid',
            'employees.uuid as employee_uuid',
            'employee_salaries.hour_meter_price_uuid',
            'positions.position'
        ]);
        // return view('datatableshow', [ 'data'         => $employees]);
        

        $data_hm_employees = EmployeeHourMeterDay::join('identities','identities.nik_employee', 'employee_hour_meter_days.employee_uuid')
        ->whereYear('date', $year)->whereMonth('date', $month)
        ->whereNull('is_bonus')
        ->get([
            'identities.*',
            'employee_hour_meter_days.*'
        ]);
        // return view('datatableshow', [ 'data'         => $data_hm_employees]);
        // dd($data_hm_employees);

                
        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();
        $createSheet->setCellValue('B1', 'Template HM');
        
        $createSheet->setCellValue('C1', 'Excel');
        $createSheet->setCellValue('B2', 'Perusahaan');
        $createSheet->setCellValue('B3', 'Bulan');
        $createSheet->setCellValue('B4', 'Tahun');

        $createSheet->setCellValue('C3', $month);
        $createSheet->setCellValue('C4', $year);
        $createSheet->setCellValue('A5', 'No');
        $createSheet->setCellValue('B5', 'NIK');
        $createSheet->setCellValue('C5', 'Nama');
        $createSheet->setCellValue('D5', 'Jabatan');
        
        $createSheet->setCellValue('E5', 'Harga HM');

        for($i = 1; $i <= $day_month; $i++){  
            $createSheet->setCellValue($abjads[$i+4].'5', $i);
            $createSheet->setCellValue($abjads[$i+4+$day_month+4].'5', $i);
            $createSheet->setCellValue($abjads[$i+4+$day_month+4+$day_month+4].'5', $i);
        }

        $employee_row = 6;
        $no = 1;

        foreach($employees as $item){
            $createSheet->setCellValue( $abjads[0].$employee_row, $no);
            $createSheet->setCellValue( $abjads[1].$employee_row, $item->nik_employee);
            $createSheet->setCellValue( $abjads[2].$employee_row, $item->name);
            $createSheet->setCellValue( $abjads[3].$employee_row, $item->position);
            $createSheet->setCellValue( $abjads[4].$employee_row, $item->hour_meter_price_uuid);
            // $createSheet->setCellValue( $abjads[4].$employee_row, 'Rp. '.$item->hour_meter_price_uuid);

            $data_hm_employee = EmployeeHourMeterDay::where('employee_uuid', $item->employee_uuid)
            ->whereYear('date', $year)->whereMonth('date', $month)
            ->whereNull('is_bonus')
            ->orderBy('employee_hour_meter_days.date', 'asc')
            ->get();

            $data_hm_employee_bonus = EmployeeHourMeterDay::where('employee_uuid', $item->employee_uuid)
            ->whereYear('date', $year)->whereMonth('date', $month)
            ->where('is_bonus', 'bonus')
            ->orderBy('employee_hour_meter_days.date', 'asc')
            ->groupBy(
                'employee_hour_meter_days.employee_uuid',
                'employee_hour_meter_days.date',
               )
               ->select( 
                'employee_hour_meter_days.date',
                'employee_hour_meter_days.employee_uuid',
                DB::raw("sum(employee_hour_meter_days.full_value) as sum_hour_meter"),
            )
            ->get();
            // dd($data_hm_employee_bonus);
            $column_identity = 4;

            foreach($data_hm_employee_bonus as $item_1){
                $date_explode = explode('-',$item_1->date);
                $item_date = $date_explode[2] + $column_identity;
                $row_bonus = $item_date + $day_month + $column_identity + $day_month + $column_identity;
                $cell_data  = $abjads[$row_bonus].$employee_row;
                $createSheet->setCellValue($cell_data,  $item_1->sum_hour_meter); 
            }

            foreach($data_hm_employee as $item_2){
                $date_explode = explode('-',$item_2->date);
                $item_date = $date_explode[2] + $column_identity;
                $row_bonus = $item_date + $day_month + $column_identity;
                $cell_data  = $abjads[$item_date].$employee_row;
                $createSheet->setCellValue($abjads[$item_date].$employee_row,  $item_2->value); 
            }
            for($i = 1; $i <= $day_month; $i++){  
                
                $cell_data  =$abjads[$i+$column_identity].$employee_row;
                $formula_hm = '=IF('.$cell_data.'>15,'.$cell_data.'*0.5+'.$cell_data.',IF('.$cell_data.'>13,'.$cell_data.'*0.3+'.$cell_data.',IF('.$cell_data.'>9,'.$cell_data.'*0.15+'.$cell_data.','.$cell_data.')))';
                $createSheet->setCellValue($abjads[$i+$column_identity+$day_month+$column_identity].$employee_row, $formula_hm);
            }
           
            $employee_row++;$no++;
        }
       
        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/'.$year_month.'-'.rand(99,9999).'file.xls';
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
            $day_month = Carbon::parse($datetime)->endOfMonth()->isoFormat('D');


            $no_employee = 6;
            $employees = [];
            /*
            1. loop all employee
            2.
            EmployeeHourMeterDay::
            */

            while((int)$sheet->getCell( 'A'.$no_employee)->getValue() != null){
                $date_row = 4;
                (int)$sheet->getCell( 'A'.$no_employee)->getValue();
                $nik_employee= $sheet->getCell( 'B'.$no_employee)->getValue(); //EMPLOYEE_UUID
                $hour_meter_uuid = 'hm-'.$sheet->getCell( 'E'.$no_employee)->getValue(); //hour meter uuid
                for($day =1; $day <= $day_month; $day++){//hm biasa
                    $date = $year_hm.'-'.$month_hm.'-'.$day;
                    if($sheet->getCell( $abjads[$date_row+$day].$no_employee)->getValue() > 0){
                        $employees[$day] = $sheet->getCell( $abjads[$date_row+$day].$no_employee)->getValue(); //hm value,
                        $employees[$day.'bonus'] = $sheet->getCell( $abjads[$date_row+$day+$day_month+4].$no_employee)->getOldCalculatedValue(); //hm value,
                        $employees = [
                            'uuid'  => $year_hm.'-'.$month_hm.'-'.$day.'-'.$nik_employee,
                            'employee_uuid' => $nik_employee,
                            'date' => $date,
                            'value' =>  $sheet->getCell( $abjads[$date_row+$day].$no_employee)->getValue(),
                            'hour_meter_price_uuid' => $hour_meter_uuid,
                            'full_value' => $sheet->getCell( $abjads[$date_row+$day+$day_month+4].$no_employee)->getOldCalculatedValue(),
                        ];
                        $store = EmployeeHourMeterDay::create($employees);
                    }
                    if($sheet->getCell( $abjads[$date_row+$day+$day_month+4+$day_month+4].$no_employee)->getValue() > 0){//hm bonus
                        // $employees[$day.'bonus11'] =$sheet->getCell( $abjads[$date_row+$day+$day_month+4+$day_month+4].$no_employee)->getValue(); //hm value,
                        $employees = [
                            'uuid'  => $year_hm.'-'.$month_hm.'-'.$day.'-'.$nik_employee.rand(99,9999),
                            'employee_uuid' => $nik_employee,
                            'date' => $date,
                            'hour_meter_price_uuid' => $hour_meter_uuid,
                            'value' =>  $sheet->getCell( $abjads[$date_row+$day+$day_month+4+$day_month+4].$no_employee)->getValue(),
                            'full_value' => $sheet->getCell( $abjads[$date_row+$day+$day_month+4+$day_month+4].$no_employee)->getValue(),
                            'is_bonus' => 'bonus',
                        ];
                        $store = EmployeeHourMeterDay::create($employees);
                    }
                }
                $no_employee++;
            }
        } catch (Exception $e) {
            $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
    }

    public function index(){
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employee-hour-meter'
        ];
        return view('employee_hour_meter_day.index', [
            'title'         => 'Hour Meter',
            'year_month'        => Carbon::today()->isoFormat('Y-M'),
            'layout'    => $layout,
            'nik_employee' => ''
        ]);
    }
    public function indexForEmployee($nik_employee){
        $employee = Employee::where('nik_employee',$nik_employee)->get()->first();
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'hour-meter-price-me'
        ];
        return view('employee_hour_meter_day.employee.index', [
            'title'         => 'Tonase',
            'year_month'        => Carbon::today()->isoFormat('Y-M'),
            'layout'    => $layout,
            'nik_employee' => $employee->uuid
        ]);
    }

    public function delete(Request $request){
         $store = EmployeeHourMeterDay::where('uuid',$request->uuid)->delete();
 
         return response()->json(['code'=>200, 'message'=>'Data Deleted','data' => $store], 200);   
    }


    public function showMonth($nik_employee, $year_month){
        
        // dd($data);
        $employees = Employee::getAll();
        $hour_meter_prices =HourMeterPrice::all();
        // Carbon::today()->isoFormat('Y-M-D');
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employee-hour-meter'
        ];

        return view('employee_hour_meter_day.create', [
            'title'         => 'Hour Meter Day',
            'employees' => $employees,
            'today'        => Carbon::today()->isoFormat('Y-M-D'),
            'hour_meter_prices'=>$hour_meter_prices,
            'hour_meter_uuid' => '',
            'nik_employee' => $nik_employee,
            'year_month' => $year_month,
            'layout'    => $layout
        ]);
        return "showMonth :".$nik_employee.'-year month : '.$year_month;


    }
    public function showUuid($hour_meter_uuid){
        
        // dd($data);
        $employees = Employee::getAll();
        $hour_meter_prices =HourMeterPrice::all();
        // Carbon::today()->isoFormat('Y-M-D');
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employee-hour-meter'
        ];
        // return $hour_meter_uuid;
        return view('employee_hour_meter_day.create', [
            'title'         => 'Hour Meter Day',
            'employees' => $employees,
            'today'        => Carbon::today()->isoFormat('Y-M-D'),
            'hour_meter_prices'=>$hour_meter_prices, 
            'hour_meter_uuid' => $hour_meter_uuid,
            'year_month' => '',
            'nik_employee' => '',
            'layout'    => $layout
        ]);


        return "showUuid :".$hour_meter_uuid;

    }

    public function anyData(){
        $data = EmployeeHourMeterDay::join('employees as employee', 'employee.uuid','employee_hour_meter_days.employee_uuid')->join('user_details as ud_employee','ud_employee.uuid','=','employee.user_detail_uuid')
        ->join('positions','positions.uuid','=','employee.position_uuid')->orderBy('employee_hour_meter_days.updated_at', 'asc')
        ->join('hour_meter_prices','hour_meter_prices.uuid','=','employee_hour_meter_days.hour_meter_price_uuid')->orderBy('employee_hour_meter_days.updated_at', 'asc')
        ->get([
            'employee_hour_meter_days.*',
            'ud_employee.name',
            'positions.position',
            'hour_meter_prices.value as hour_meter_value'
        ]);

        $data = EmployeeHourMeterDay::leftJoin('employees','employees.uuid','employee_hour_meter_days.employee_uuid')
        ->leftJoin('user_details','user_details.uuid','employees.user_detail_uuid')
        ->leftJoin('positions','positions.uuid','employees.position_uuid')
        ->leftJoin('hour_meter_prices','hour_meter_prices.uuid','employee_hour_meter_days.hour_meter_price_uuid')
        ->whereDate('employee_hour_meter_days.updated_at', Carbon::today()->isoFormat('Y-M-D'))
        ->groupBy(
            'employee_hour_meter_days.uuid',
            'employee_hour_meter_days.full_value',
            'employee_hour_meter_days.updated_at',
            'employees.nik_employee',
            'user_details.photo_path',
            'hour_meter_prices.value',
            'positions.position',
            'employees.uuid',
            'employees.nik_employee',
            'user_details.name',
            'employee_hour_meter_days.date',
            'employee_hour_meter_days.value')
        ->select( 
            'employee_hour_meter_days.updated_at',
            'employee_hour_meter_days.date',
            'employee_hour_meter_days.uuid as hour_meter_uuid',
            'user_details.name',
            'user_details.photo_path',
            'positions.position',
            'employees.uuid',
            'employees.nik_employee',
            'hour_meter_prices.value as hour_meter_price',
            'employee_hour_meter_days.value as hour_meter_value',
            'employee_hour_meter_days.full_value as hour_meter_full_value',
        )
        ->get();
        
        return Datatables::of($data)
        ->make(true);
    }

    public function anyDataForEmployee($nik_employee, $year_month){
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];

        
        $data = EmployeeHourMeterDay::leftJoin('employees','employees.uuid','employee_hour_meter_days.employee_uuid')
        ->leftJoin('user_details','user_details.uuid','employees.user_detail_uuid')
        ->leftJoin('positions','positions.uuid','employees.position_uuid')
        ->leftJoin('hour_meter_prices','hour_meter_prices.uuid','employee_hour_meter_days.hour_meter_price_uuid')
        ->where('employees.nik_employee', $nik_employee)
        ->whereYear('employee_hour_meter_days.date', $year)
        ->whereMonth('employee_hour_meter_days.date', $month)
        ->groupBy(
            'employees.nik_employee',
            'user_details.photo_path',
            'hour_meter_prices.value',
            'positions.position',
            'employees.uuid',
            'employees.nik_employee',
            'user_details.name',
            // 'MONTH(employee_hour_meter_days.date)'
            // 'new_date'
           )
        ->select( 
            'user_details.name',
            'user_details.photo_path',
            'positions.position',
            'employees.uuid',
            'employees.nik_employee',
            'hour_meter_prices.value as hour_meter_price',
            // DB::raw("(DATE_FORMAT(employee_hour_meter_days.date, '%Y-%m')) as month_year"),
            DB::raw("count(employee_hour_meter_days.value) as count_hour_meter"),
            DB::raw("SUM(employee_hour_meter_days.value) as hour_meter_value"),
            DB::raw("DATE_FORMAT(employee_hour_meter_days.created_at, '%Y-%m') new_date"),  DB::raw('YEAR(employee_hour_meter_days.created_at) as year, MONTH(employee_hour_meter_days.created_at) as month'),
            DB::raw("SUM(employee_hour_meter_days.full_value) as hour_meter_full_value"),
        )
        ->get();
        return view('datatableshow', [ 'data'         => $data]);
        // dd($data);
        return Datatables::of($data)
        ->make(true);
    }


    public function indexPayrol($year_month){
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];

        $employees = Employee::getAll();
        $hour_meter_prices =HourMeterPrice::all();

        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'hour-meter-day'
        ];
        return view('employee_hour_meter_day.payrol.index', [
            'title'         => 'Hour Meter Day',
            'month'     => $year_month,
            'employees' => $employees,
            'hour_meter_prices'=>$hour_meter_prices,
            'layout'    => $layout
        ]);
    }

    public function store(Request $request){
        
        $validatedData = $request->validate([
            'uuid' => '',
            'hour_meter_price_uuid' => '',
            'employee_uuid' => '',
            'employee_checker_uuid' => '',
            'employee_foreman_uuid' => '',
            'employee_supervisor_uuid' => '',
            'date' => '',
            'shift' => '',
            'full_value' => '',            
            'value' => '',
            'is_edit'    => '',

        ]);
        

        if(empty($validatedData['uuid'])){//data baru
            $validatedData['uuid'] = $validatedData['date'].'-'.$validatedData['employee_uuid'];

            $cek_before = EmployeeHourMeterDay::where('date', $validatedData['date'])
            ->where('employee_uuid', $validatedData['employee_uuid'])
            ->count();

            if($cek_before > 0){ //sudah ada ditanggal yg sama
                $validatedData['uuid'] = $validatedData['date'].'-'.$validatedData['employee_uuid'].'-'.rand(99,9999);
                $validatedData['is_bonus'] = 'bonus';
            }
        }


        $employees = Employee::where_employee_uuid($validatedData['employee_uuid']);
        $store = EmployeeHourMeterDay::updateOrCreate(['uuid' => $validatedData['uuid']], $validatedData);

        return ResponseFormatter::toJson($store, 'Data Stored');
    }
    public function show(Request $request){
        
        $validatedData = $request->validate([
            'uuid' => 'required',
        ]);
        
        $data = EmployeeHourMeterDay::where('uuid', $request->uuid)->first();
        return ResponseFormatter::toJson($data, 'Data Stored');
    }



    
    // public function anyData(){
    //     $data = EmployeeHourMeterDay::join('employees as employee', 'employee.uuid','employee_hour_meter_days.employee_uuid')->join('user_details as ud_employee','ud_employee.uuid','=','employee.user_detail_uuid')
    //     ->join('employees as checker', 'checker.uuid','employee_hour_meter_days.employee_checker_uuid')->join('user_details as ud_checker','ud_checker.uuid','=','checker.user_detail_uuid')
    //     ->join('employees as foreman', 'foreman.uuid','employee_hour_meter_days.employee_foreman_uuid')->join('user_details as ud_foreman','ud_foreman.uuid','=','foreman.user_detail_uuid')
    //     ->join('employees as supervisor', 'supervisor.uuid','employee_hour_meter_days.employee_supervisor_uuid')->join('user_details as ud_supervisor','ud_supervisor.uuid','=','supervisor.user_detail_uuid')
    //     ->join('positions','positions.uuid','=','employee.position_uuid')->orderBy('employee_hour_meter_days.updated_at', 'asc')
    //     ->get([
    //         'ud_checker.name as checker_name',
    //         'ud_foreman.name as foreman_name',
    //         'ud_supervisor.name as supervisor_name',
    //     ]);
    //     dd($data);
        
    //     return Datatables::of($data)
    //     ->make(true);;
    // }
}

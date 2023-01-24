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
            // 'hour_meter_prices.hour_meter_value',
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
            // 'hour_meter_prices.hour_meter_value as hour_meter_price',
            DB::raw("count(employee_hour_meter_days.value) as count_hour_meter"),
            DB::raw("SUM(employee_hour_meter_days.value) as hour_meter_value"),
            DB::raw("SUM(employee_hour_meter_days.full_value) as hour_meter_full_value"),
        )
        ->get();
        // dd($data);
        return Datatables::of($data)
        ->make(true);
    }

    // used index
    public function moreAnyData(Request $request){        
        $data = Employee::leftJoin('user_details','user_details.uuid','employees.user_detail_uuid' )
        ->join('employee_hour_meter_days','employee_hour_meter_days.employee_uuid', 'employees.nik_employee' )
        ->join('positions','positions.uuid', 'employees.position_uuid' )->whereNull('employees.date_end')
        ->whereNull('user_details.date_end')
        ->whereYear('employee_hour_meter_days.date', $request->year)
        ->whereMonth('employee_hour_meter_days.date', $request->month);
        if(!empty($request->day)){
            $data = $data->whereDay('employee_hour_meter_days.date', $request->day);
        }
        if(!empty($request->employee_uuid)){
            $data = $data->where('employee_hour_meter_days.employee_uuid', $request->employee_uuid);
        }
        $data =$data
        ->groupBy(
            'employees.nik_employee',
            'user_details.photo_path',
            'positions.position',
            'employees.uuid',
            'employees.nik_employee',
           )
           ->groupBy(
            'user_details.name',
           )
        ->select( 
            'user_details.name',
            'user_details.photo_path',
            'positions.position',
            'employees.uuid',
            'employees.nik_employee',
            DB::raw("count(employee_hour_meter_days.value) as count_hour_meter"),
            DB::raw("SUM(employee_hour_meter_days.value) as hour_meter_value"),
            DB::raw("SUM(employee_hour_meter_days.full_value) as hour_meter_full_value"),
        )
        ->get();
        return Datatables::of($data)
        ->make(true);
        return ResponseFormatter::toJson($data,'bbb');
    }

    //used on create 
    public function AnyDataCreate(Request $request){
       
        // return ResponseFormatter::toJson($request->all(),'bbb');
        $data = Employee::leftJoin('user_details','user_details.uuid','employees.user_detail_uuid' )        
        ->join('positions','positions.uuid', 'employees.position_uuid' )
        ->join('employee_hour_meter_days','employee_hour_meter_days.employee_uuid', 'employees.nik_employee' )
        ->whereNull('employees.date_end')
        ->whereNull('user_details.date_end');

        // return ResponseFormatter::toJson($data,'bbb');
        if(!empty($request->employee_uuid)){
            $data = $data->whereYear('employee_hour_meter_days.date', $request->year)
            ->whereMonth('employee_hour_meter_days.date', (int)$request->month)
            ->where('employee_hour_meter_days.employee_uuid', $request->employee_uuid)
            ->orderBy('employee_hour_meter_days.updated_at', 'desc');
        }else{
            $data = $data->orderBy('employee_hour_meter_days.updated_at','desc')->limit(18);
        }
        
        $data = $data->get();
        return ResponseFormatter::toJson($data,'bbb');
    }
    // used to store 
    public function store(Request $request){
        $validatedData = $request->all();
        // return ResponseFormatter::toJson($validatedData,'store employee-hour-meter-day');
        if(empty($validatedData['uuid'])){
            $validatedData['uuid']  = $validatedData['date'].'-'.$validatedData['employee_uuid'].'-'.rand(99,9999);
        }

        if(empty($validatedData['isBonusAktive'])){
            $validatedData['is_bonus'] = 'bonus';
        }
        $store = EmployeeHourMeterDay::updateOrCreate(['uuid' => $validatedData['uuid']], $validatedData);

        $the_data = Employee::noGet_employeeAll_detail()->join('employee_hour_meter_days','employee_hour_meter_days.employee_uuid', 'employees.nik_employee' )
        ->where('employee_hour_meter_days.uuid', $store->uuid)->get()->first();

        return ResponseFormatter::toJson($the_data,'store employee-hour-meter-day');



  
        
        return ResponseFormatter::toJson($store, 'Data Stored');
    }
    
    public function show(Request $request){        
        
        // return ResponseFormatter::toJson($request->all(), 'Data Stored');
        
        $data = EmployeeHourMeterDay::where('uuid', $request->uuid)->get()->first();
        return ResponseFormatter::toJson($data, 'Data Stored');
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
            'hour_meter_prices.hour_meter_value',
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
            'hour_meter_prices.hour_meter_value as hour_meter_price',
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
            'hour_meter_prices.hour_meter_value',
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
            'hour_meter_prices.hour_meter_value as hour_meter_price',
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
            'hour_meter_prices.hour_meter_value',
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
            'hour_meter_prices.hour_meter_value as hour_meter_price',
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
                    'hour_meter_prices.hour_meter_value as hour_meter_price'
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
        $employees = Employee::get_employee_all_latest();
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
    // done
    public function export($year_month){
        $arr_bonus = [
            [
                'min_hm'    => 16,
                'percent'   => 50,
            ],
            [
                'min_hm'    => 14,
                'percent'   => 30,
            ],
            [
                'min_hm'    => 10,
                'percent'   => 15,
            ],
        ];
        
        

        $arr_hour_meter_price = HourMeterPrice::all();

        $abjads = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ','DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DV','DW','DX','DY','DZ'];
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];

        $day_month = ResponseFormatter::getEndDay($year_month);

        $arr_employee = Employee::noGet_employeeAll_detail()->orderBy('employee_salaries.hour_meter_price_uuid')->get();
        // return view('datatableshow', [ 'data'         => $arr_employee]);

        $employee['nik_employee']['date']['hm-20000'] = [
            'value' => 10,
            'value_bonus'   => 11.5,
        ];

        foreach($arr_hour_meter_price as $item_hour_meter_price){
            // $data = EmployeeHourMeterDay::where('hour_meter_price_uuid', $item_hour_meter_price->uuid)->get();
            // return view('datatableshow', [ 'data'         => $data]);
        }

        $arr_hour_meter_data = EmployeeHourMeterDay::whereYear('date', $year)->whereMonth('date', $month)
        // ->where('employee_hour_meter_days.employee_uuid', 'MBLE-0422003')
        ->get();
        
        foreach($arr_hour_meter_data as $item_hour_meter_data){
            $arr_employee_hour_meter[$item_hour_meter_data->employee_uuid][$item_hour_meter_data->hour_meter_price_uuid][$item_hour_meter_data->date][]=[
                'value' => $item_hour_meter_data->value,
                'full_value' => $item_hour_meter_data->full_value
            ];
        }
      
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
        
        $createSheet->setCellValue('F4', 'HM dislip tanpa Bonus');
        
        $createSheet->setCellValue('E5', 'Harga HM');

        for($i = 1; $i <= $day_month; $i++){  
            $createSheet->setCellValue($abjads[$i+4].'5', $i);
            $createSheet->setCellValue($abjads[$i+4+$day_month+2].'5', $i);
            $createSheet->setCellValue($abjads[$i+4+$day_month+2+$day_month+2].'5', $i);

        }
        $createSheet->setCellValue($abjads[5+$day_month].'5', "Total");
        $createSheet->setCellValue($abjads[5+$day_month+$day_month+2].'5', "Total");
        $createSheet->setCellValue($abjads[5+$day_month+$day_month+$day_month+4].'5', "Total");



        $employee_row = 6;
        $no = 1;
        // each employee
        foreach($arr_employee as $item){
        //    if employee have hm

            $employee_row_old = $employee_row;
            $much_column_data_employee = [];
            if(!empty($arr_employee_hour_meter[$item->employee_uuid])){
                // dd($arr_employee_hour_meter[$item->employee_uuid]);
                $arr_column_employee = [];
                // each hm uuid 
                foreach($arr_employee_hour_meter[$item->employee_uuid] as $index=>$employee_hour_meter){                    
                    $max_arr_each_day = 1;                    
                    //eac day
                    foreach($employee_hour_meter as $day=>$arr_each_day){
                        $the_date = explode('-',$day);
                        $much_arr_each_day = 0;
                        $old ='';
                        foreach($arr_each_day as $each_day){
                            $thecoll = $employee_row+$much_arr_each_day;
                            if($each_day['value'] >= $arr_bonus[2]['min_hm']){                               
                                if($each_day['value'] == $each_day['full_value']){
                                    if($old == 'bonus'){                                        
                                        $much_arr_each_day++;
                                        $thecoll = $employee_row+$much_arr_each_day;
                                    }    
                                    $createSheet->setCellValue( $abjads[4+(int)$the_date[2]+$day_month+$day_month+4].$thecoll, $each_day['value']);                             
                                    $old = 'bonus';
                                }else{
                                    if($old == 'reguler'){                                        
                                        $much_arr_each_day++;
                                        $thecoll = $employee_row+$much_arr_each_day;
                                    }
                                    $old = 'reguler';
                                    $createSheet->setCellValue( $abjads[4+(int)$the_date[2]].$thecoll, $each_day['value']);
                                }
                            }else{
                                if($old == 'reguler'){                                    
                                    $much_arr_each_day++;
                                    $thecoll = $employee_row+$much_arr_each_day;
                                }
                                $old = 'reguler';
                                $createSheet->setCellValue( $abjads[4+(int)$the_date[2]].$thecoll, $each_day['value']);
                            }
                            if($much_arr_each_day+1 > $max_arr_each_day){
                                $max_arr_each_day = $much_arr_each_day+1;
                            }                            
                        }
                    }
                    $employee_row++;
                    $arr_column_employee[] = [
                        'hour_meter_price_uuid' => $index,
                        'much'  => $max_arr_each_day
                    ];
                }
                // dd($arr_column_employee);
                $employee_row = $employee_row_old;
                
                foreach($arr_column_employee as $item_column_employee){
                    // dd( $item->nik_employee);
                    for($i=0; $i< $item_column_employee['much']; $i++){
                        $createSheet->setCellValue( $abjads[0].$employee_row, $no);
                        $createSheet->setCellValue( $abjads[1].$employee_row, $item->nik_employee);
                        $createSheet->setCellValue( $abjads[2].$employee_row, $item->name);
                        $createSheet->setCellValue( $abjads[3].$employee_row, $item->position);
                        $createSheet->setCellValue( $abjads[4].$employee_row, $item_column_employee['hour_meter_price_uuid']);
                        for($j = 1; $j <= $day_month; $j++){  
                            $name_row = $abjads[$j+4].$employee_row;
                            $string_end = '';
                            $the_closer = ')';
                            $formula_add ='';
                            
                            foreach($arr_bonus as $item_bonus){
                                $formula_add = $formula_add.",IF(".$name_row.">=".$item_bonus['min_hm'].",".$name_row. "*".$item_bonus['percent']."%+".$name_row;
                                $string_end = $string_end.$the_closer;
                            }
                            $str = ltrim($formula_add, ',');
                            $the_formula = "=".$str.",".$name_row.$string_end;
                            $createSheet->setCellValue($abjads[$j+4+$day_month+2].$employee_row, $the_formula); 
                        }
                        $employee_row++;
                    }
                }
            }else{
                $createSheet->setCellValue( $abjads[0].$employee_row, $no);
                $createSheet->setCellValue( $abjads[1].$employee_row, $item->nik_employee);
                $createSheet->setCellValue( $abjads[2].$employee_row, $item->name);
                $createSheet->setCellValue( $abjads[3].$employee_row, $item->position);
                $createSheet->setCellValue( $abjads[4].$employee_row, $item->hour_meter_price_uuid);
                for($k = 1; $k <= $day_month; $k++){  
                    $name_row = $abjads[$k+4].$employee_row;
                    $string_end = '';
                    $the_closer = ')';
                    $formula_add ='';                    
                    foreach($arr_bonus as $item_bonus){
                        $formula_add = $formula_add.",IF(".$name_row.">=".$item_bonus['min_hm'].",".$name_row. "*".$item_bonus['percent']."%+".$name_row;
                        $string_end = $string_end.$the_closer;
                    }
                    $str = ltrim($formula_add, ',');
                    $the_formula = "=".$str.",".$name_row.$string_end;
                    // dd($formula_add);
                    $createSheet->setCellValue($abjads[$k+4+$day_month+2].$employee_row, $the_formula); 
                }
                $employee_row++;
            }
            
        }

        $crateWriter = new Xls($createSpreadsheet);
        $name = 'file/absensi/file-hm-bulan-'.$year_month.'-'.rand(99,9999).'file.xls';
        $crateWriter->save($name);

        // return 'aaa';
        return response()->download($name);
    }

    static function  countBonus($hm_value){
        $arr_bonus = [
            [
                'min_hm'    => 16,
                'percent'   => 50,
            ],
            [
                'min_hm'    => 14,
                'percent'   => 30,
            ],
            [
                'min_hm'    => 10,
                'percent'   => 15,
            ],


        ];
        foreach($arr_bonus as $item_bonus){
            if($hm_value >= $item_bonus['min_hm']){
                return $hm_value_full = $hm_value * $item_bonus['percent']/100 + $hm_value;
            }
        }
    }

    public function import(Request $request){
        $arr_bonus = [
            [
                'min_hm'    => 16,
                'percent'   => 50,
            ],
            [
                'min_hm'    => 14,
                'percent'   => 30,
            ],
            [
                'min_hm'    => 10,
                'percent'   => 15,
            ],


        ];
        // return 'ahmadi';
        $the_file = $request->file('uploaded_file');

        $createSpreadsheet = new spreadsheet();
        $createSheet = $createSpreadsheet->getActiveSheet();

        try{
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();

           

            $abjads = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ','DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DV','DW','DX','DY','DZ'];
        
            // DESCRIPTION
            $month_hm =  $sheet->getCell( 'C3')->getValue();
            $year_hm = $sheet->getCell( 'C4')->getValue();

            $year_month = $year_hm.'-'.$month_hm;
            $day_month = ResponseFormatter::getEndDay($year_month);
            $arr_data_employee_hour_meter_day = EmployeeHourMeterDay::whereYear('date', $year_hm)
            ->whereMonth('date', $month_hm)
            // ->where('employee_hour_meter_days.employee_uuid', 'MBLE-0422003')
            ->get();

            $arr_data_employee_hour_meter_day = $arr_data_employee_hour_meter_day->keyBy(function ($item) {
                return strval($item->employee_uuid);
            });


            $no_employee = 6;
            $employees = [];
            /*
            1. loop all employee
            2.
            EmployeeHourMeterDay::
            */
            $arr_data = [];
            while((int)$sheet->getCell( 'A'.$no_employee)->getValue() != null){
                $nik_employee= ResponseFormatter::toUUID($sheet->getCell( 'B'.$no_employee)->getValue()); //EMPLOYEE_UUID
                $hm_uuid= ResponseFormatter::toUuidLower($sheet->getCell( 'E'.$no_employee)->getValue());
                $date_row = 4;
                for($day =1; $day <= $day_month; $day++){
                    //reguler
                    $hm_value = $sheet->getCell( $abjads[$date_row+$day].$no_employee)->getValue();
                    if(!empty($hm_value)){
                        if($hm_value >= $arr_bonus[2]['min_hm']){
                           $hm_value_full =  EmployeeHourMeterDayController::countBonus($hm_value);                            
                        }else{
                            $hm_value_full = $hm_value;
                        }                        
                        $arr_data[$nik_employee][$hm_uuid][$day][]= [
                            'value' => $hm_value,
                            'full_value'    => round($hm_value_full, 2)
                        ];
                    }
                    //bonus
                    $hm_value_bonus = $sheet->getCell( $abjads[$date_row+$day+$day_month+2+$day_month+2].$no_employee)->getValue();
                    if(!empty($hm_value_bonus)){          
                        $hm_value_full = $hm_value_bonus;                                               
                        $arr_data[$nik_employee][$hm_uuid][$day][]= [
                            'value' => $hm_value_bonus,
                            'full_value'    => round($hm_value_full, 2),
                            'is_bonus'  => 'bonus',
                            'row'   => $abjads[$date_row+$day+$day_month+2+$day_month+2].$no_employee
                        ];
                    }
                }
                $no_employee++;
            }
            foreach($arr_data as $employee_uuid=>$arr_hm_uuid ){     

                foreach($arr_hm_uuid as $hm_uuid=>$arr_day){

                    foreach($arr_day as $day=>$arr_each_data){
                        $date_each_data = $year_month.'-'.$day;
                        if(!empty($arr_data_employee_hour_meter_day[$employee_uuid])){
                            $delete = EmployeeHourMeterDay::whereYear('date', $year_hm)
                            ->whereMonth('date', $month_hm)
                            ->whereDay('date', $day)
                            ->where('employee_uuid', $employee_uuid)->delete();
                        }
                        foreach($arr_each_data as $index=>$each_data){
                            $each_data['uuid']  = $date_each_data.'-'.$employee_uuid.'-'.$index;
                            $each_data['employee_uuid']  = $employee_uuid;
                            $each_data['date']  = $date_each_data;
                            $each_data['hour_meter_price_uuid']  = $hm_uuid;
                            $store = EmployeeHourMeterDay::create($each_data);
                            // dd($store);
                        }
                    }
                    
                }
            }

            // var_dump($arr_data);die;
            

            
            return back();
        } catch (Exception $e) {
            // dd($e);
            $error_code = $e;
            return back()->with('messageErr', 'file eror!');
        }
    }
    //used
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
            'nik_employee' => $nik_employee
        ]);
    }

    public function delete(Request $request){
         $store = EmployeeHourMeterDay::where('uuid',$request->uuid)->delete();
 
         return response()->json(['code'=>200, 'message'=>'Data Deleted','data' => $store], 200);   
    }


    public function showMonth($nik_employee, $year_month){
        
        // dd($data);
        $employees = Employee::get_employee_all_latest();
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
        $employees = Employee::noGet_employeeAll_detail()->get();

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
            'hour_meter_prices.hour_meter_value as hour_meter_value'
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
            'hour_meter_prices.hour_meter_value',
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
            'hour_meter_prices.hour_meter_value as hour_meter_price',
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
            'hour_meter_prices.hour_meter_value',
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
            'hour_meter_prices.hour_meter_value as hour_meter_price',
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

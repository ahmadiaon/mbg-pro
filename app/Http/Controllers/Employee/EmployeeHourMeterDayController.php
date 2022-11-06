<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeHourMeterDay;
use App\Models\HourMeterPrice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\Datatables\Datatables;

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
            'hour_meter_prices.value',
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
            'hour_meter_prices.value as hour_meter_price',
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
        ]);
        if(empty($validatedData['uuid'])){
            $validatedData['uuid'] = "hm-".$validatedData['date'].'-'.$validatedData['shift'].'-'.$validatedData['employee_uuid'].'-'.rand(99,999);
        }
        $employees = Employee::where_employee_uuid($validatedData['employee_uuid']);
        $store = EmployeeHourMeterDay::updateOrCreate(['uuid' => $validatedData['uuid']], $validatedData);
        // $data = [
        //     'employees' => $employees,
        //     'hm'            => $store
        // ];
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

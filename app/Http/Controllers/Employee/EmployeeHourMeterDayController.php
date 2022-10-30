<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeHourMeterDay;
use App\Models\HourMeterPrice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\Datatables\Datatables;

class EmployeeHourMeterDayController extends Controller
{
    //
    public function create(){
        $employees = Employee::getAll();
        $hour_meter_prices =HourMeterPrice::all();
        Carbon::today()->isoFormat('Y-M-D');
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
            'today'        => Carbon::today()->isoFormat('Y-m-D'),
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
}

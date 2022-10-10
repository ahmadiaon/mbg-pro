<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeHourMeterDay;
use App\Models\HourMeterPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EmployeeHourMeterDayController extends Controller
{
    //
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

    public function storePayrol(Request $request){
        
        $validatedData = $request->validate([
            'uuid' => '',
            'hour_meter_price_uuid' => '',
            'employee_uuid' => '',
            'date' => '',
            'full_value' => '',            
            'value' => '',
        ]);
        if(!$validatedData['uuid']){
            $validatedData['uuid'] = "hm-day-".Str::uuid();
        }
        $employees = Employee::where_employee_uuid($validatedData['employee_uuid']);
        $store = EmployeeHourMeterDay::updateOrCreate(['uuid' => $validatedData['uuid']], $validatedData);
        $data = [
            'employees' => $employees,
            'hm'            => $store
        ];
        return ResponseFormatter::toJson($data, 'Data Stored');
    }
}

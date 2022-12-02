<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeAbsen;
use App\Models\Employee\EmployeeHourMeterDay;
use App\Models\Employee\EmployeePayment;
use App\Models\Employee\EmployeeTonase;
use App\Models\HourMeterPrice;
use App\Models\Identity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class AllowanceController extends Controller
{
    public function index(){
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => false,
            'active'                        => 'employee-allowance'
        ];
        return view('allowance.index', [
            'title'         => 'Pendapatan Karyawan',
            'year_month'        => Carbon::today()->isoFormat('Y-M'),
            'hour_meter_prices'        => HourMeterPrice::all(),
            'layout'    => $layout,
        ]);
    }

    public function indexPayrol($year_month){
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];

        $employees = Identity::join('employees', 'employees.uuid', 'identities.employee_uuid')
        ->leftJoin('employee_absen_totals', 'employee_absen_totals.nik_employee', 'employees.nik_employee')
        ->where('employee_absen_totals.year_month', $year.'-'.$month)
        ->get([
            'identities.id',
            'identities.name',
            // 'employees.nik_employee',
            'employees.date_start_contract',
            // 'employee_absen_totals.pay',
            // 'employee_absen_totals.*',
            // 'employees.*',
            'employees.uuid as employee_uuid',
            'employees.file_path as hm',
        ]);


        $employee_hm =  Identity::join('employees', 'employees.uuid', 'identities.employee_uuid')
        ->leftJoin('employee_hour_meter_days', 'employee_hour_meter_days.employee_uuid', 'employees.uuid')
        ->whereYear('employee_hour_meter_days.date', $year)
        ->whereMonth('employee_hour_meter_days.date', $month)
        ->groupBy(
            'identities.id',
            'identities.name',
            'employee_hour_meter_days.employee_uuid',

        )
        ->select( 
            'identities.id',
            'identities.name',
            'employee_hour_meter_days.employee_uuid',
            DB::raw("SUM(employee_hour_meter_days.value) as hour_meter_value"),
           
        )
        ->get();

        $hms = array();
        foreach($employee_hm as $hm){
            $hms[$hm->employee_uuid] = $hm;
        }
        
     
        dd($hms['MBLE-0219120106']->hour_meter_value);

        return view('datatableshow', [ 'data'         => $hms]);

        return $year;
    }

    public function anyData(Request $request){
        $date = explode("-", $request->year_month);
        $year = $date[0];
        $month = $date[1];

        $hour_meter_prices = HourMeterPrice::all();

        $data_hm =[];

        foreach($hour_meter_prices as $item){
            $employee_hm =  Identity::join('employees', 'employees.uuid', 'identities.employee_uuid')
            ->leftJoin('employee_hour_meter_days', 'employee_hour_meter_days.employee_uuid', 'employees.uuid')
            ->where('hour_meter_price_uuid', $item->uuid)
            ->whereYear('employee_hour_meter_days.date', $year)
            ->whereMonth('employee_hour_meter_days.date', $month)
            ->groupBy(
                'identities.id',
                'identities.name',
                'employee_hour_meter_days.employee_uuid',

            )
            ->select( 
                'identities.id',
                'identities.name',
                'employee_hour_meter_days.employee_uuid',
                DB::raw("SUM(employee_hour_meter_days.value) as hour_meter_value")
            )
            ->get();
            
            $data = $employee_hm->keyBy(function ($item) {
                return strval($item->employee_uuid);
            });

            $data_hm[$item->uuid] = $data;
        }
        
        // return ResponseFormatter::getEndDay($year_month);

        $employees = Identity::join('employees', 'employees.uuid', 'identities.employee_uuid')
        ->leftJoin('employee_absen_totals', 'employee_absen_totals.nik_employee', 'employees.nik_employee')
        ->leftJoin('employee_salaries', 'employee_salaries.employee_uuid', 'employees.uuid')
        ->where('employee_absen_totals.year_month', $year.'-'.$month)
        ->get([
            'identities.*',
            'employees.nik_employee',
            'employees.date_start_contract',
            'employee_absen_totals.pay',
            'employee_absen_totals.*',
            'employees.*',
            'employee_salaries.salary'
        ]);

        $data = [];
        foreach( $employees as $employee){
            foreach($hour_meter_prices as $item){
                $name =$item->uuid;
                if(empty($data_hm[$item->uuid][$employee->uuid]->hour_meter_value)){
                    $employee->$name = null;
                }else{
                    $employee->$name = $data_hm[$item->uuid][$employee->uuid]->hour_meter_value;
                }
            }
            $data[] = $employee;
        }

        return Datatables::of($employees)
        ->make(true);
    }

    public function moreAnyData($year_month){
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];
        $hour_meter_prices = HourMeterPrice::all();

        $data_hm =[];

        foreach($hour_meter_prices as $item){
            $employee_hm =  Identity::join('employees', 'employees.uuid', 'identities.employee_uuid')
            ->leftJoin('employee_hour_meter_days', 'employee_hour_meter_days.employee_uuid', 'employees.uuid')
            ->where('hour_meter_price_uuid', $item->uuid)
            ->whereYear('employee_hour_meter_days.date', $year)
            ->whereMonth('employee_hour_meter_days.date', $month)
            ->groupBy(
                'identities.id',
                'identities.name',
                'employee_hour_meter_days.employee_uuid',

            )
            ->select( 
                'identities.id',
                'identities.name',
                'employee_hour_meter_days.employee_uuid',
                DB::raw("SUM(employee_hour_meter_days.value) as hour_meter_value")
            )
            ->get();
            
            $data = $employee_hm->keyBy(function ($item) {
                return strval($item->employee_uuid);
            });

            $data_hm[$item->uuid] = $data;
        }
        
        // return ResponseFormatter::getEndDay($year_month);

        $employees = Identity::join('employees', 'employees.uuid', 'identities.employee_uuid')
        ->leftJoin('employee_absen_totals', 'employee_absen_totals.nik_employee', 'employees.nik_employee')
        ->leftJoin('employee_salaries', 'employee_salaries.employee_uuid', 'employees.uuid')
        ->where('employee_absen_totals.year_month', $year.'-'.$month)
        ->get([
            'identities.*',
            'employees.nik_employee',
            'employees.date_start_contract',
            'employee_absen_totals.pay',
            'employee_absen_totals.*',
            'employees.*',
            'employee_salaries.salary'
        ]);

        $data = [];
        foreach( $employees as $employee){
            foreach($hour_meter_prices as $item){
                $name =$item->uuid;
                if(empty($data_hm[$item->uuid][$employee->uuid]->hour_meter_value)){
                    $employee->$name = null;
                }else{
                    $employee->$name = $data_hm[$item->uuid][$employee->uuid]->hour_meter_value;
                }
            }
            $data[] = $employee;
        }

        return Datatables::of($employees)
        ->make(true);
    }
}

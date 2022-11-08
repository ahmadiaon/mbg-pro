<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeAbsen;
use App\Models\Employee\EmployeeHourMeterDay;
use App\Models\Employee\EmployeePayment;
use App\Models\Employee\EmployeeTonase;
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
            'layout'    => $layout,
        ]);
    }

    public function anyData(Request $request){
        $date = explode("-", $request->year_month);
        $year = $date[0];
        $month = $date[1];

        

        $employees = Employee::leftJoin('user_details','user_details.uuid','employees.user_detail_uuid')
                                                ->leftJoin('positions','positions.uuid','employees.position_uuid')
                                                ->get([
                                                    'employees.user_detail_uuid',
                                                    'employees.nik_employee',
                                                    'user_details.photo_path',
                                                    'user_details.name',
                                                    'positions.position',
                                                    'employees.machine_id',                                                    
                                                    'employees.uuid as employee_uuid'
                                                ]);

        foreach ($employees as $employee) {
            # code...
            $employee->amount_pay = EmployeeAbsen::leftJoin('status_absens','status_absens.uuid','employee_absens.status_absen_uuid')
                ->where('status_absens.math', 'pay')
                ->where('employee_absens.employee_uuid', $employee->machine_id)
                ->count();
            $employee->amount_cut = EmployeeAbsen::leftJoin('status_absens','status_absens.uuid','employee_absens.status_absen_uuid')
            ->where('status_absens.math', 'cut')
            ->where('employee_absens.employee_uuid', $employee->machine_id)
            ->count();
            
            // hm
            $hm = EmployeeHourMeterDay::whereYear('employee_hour_meter_days.date', $year)
                ->whereMonth('employee_hour_meter_days.date', $month)
                ->where('employee_hour_meter_days.employee_uuid', $employee->employee_uuid)
                
                ->select( 
                    DB::raw("SUM(employee_hour_meter_days.full_value) as hour_meter_full_value"),
                )
                ->get()->first();

            $tonase =EmployeeTonase::whereYear('employee_tonases.date', $year)
                ->whereMonth('employee_tonases.date', $month)
                ->where('employee_tonases.employee_uuid', $employee->employee_uuid)    
                ->select( 
                    DB::raw("SUM(employee_tonases.tonase_full_value) as tonase_full_value"),
                    DB::raw("count(employee_tonases.tonase_full_value) as count_tonase_full_value"),
                )
                ->get()->first();

            $payment = EmployeePayment::join('payments','payments.uuid', 'employee_payments.payment_uuid')
            ->whereYear('payments.date', $year)
            ->whereMonth('payments.date', $month)
            ->where('employee_payments.employee_uuid',  $employee->employee_uuid)
            ->select( 
                DB::raw("SUM(employee_payments.value) as amount_value_payment"),
                DB::raw("count(employee_payments.value) as count_value_payment"),
            )
            ->get()->first();

            $employee->amount_hm = $hm->hour_meter_full_value;
            $employee->amount_tonase = $tonase->tonase_full_value;
            $employee->count_tonase_full_value = $tonase->count_tonase_full_value;

            
            $employee->amount_value_payment = $payment->amount_value_payment;
            $employee->count_value_payment = $payment->count_value_payment;
        }    
        return Datatables::of($employees)
        ->make(true);
        return ResponseFormatter::toJson($employees, 'date');
        return view('datatableshow', [ 'data'         => $employees]);
    }
}

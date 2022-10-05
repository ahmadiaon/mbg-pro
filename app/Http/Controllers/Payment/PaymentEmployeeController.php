<?php

namespace App\Http\Controllers\Payment;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\Payment\PaymentEmployee;
use App\Models\Payment\PaymentGroup;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;

class PaymentEmployeeController extends Controller
{
    public function indexPayrol($year_month){
        $date = explode("-", $year_month);
        $year = $date[0];
        $month = $date[1];
        

        $employees = Employee::getAll();

        // dd($employees);
        // return $employees;
        $payment_employes = PaymentEmployee::join('payments', 'payments.uuid', 'payment_employees.payment_uuid')
        ->join('employees','employees.uuid','payment_employees.employee_uuid')
        ->join('user_details','user_details.uuid', 'employees.user_detail_uuid')
        ->join('positions','positions.uuid', 'employees.position_uuid')
        ->whereYear('payments.date', $year)
        ->whereMonth('payments.date', $month)
        ->groupBy('employees.uuid', 'user_details.name','positions.position', 'employees.nik_employee')
        ->selectRaw( 'count(employees.uuid)as count, user_details.name, sum(payment_employees.vall) as value, positions.position, employees.nik_employee')->get();
        // dd($payment_employes);
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'payment-employee'
        ];
        return view('payment_employee.payrol.index', [
            'title'         => 'Pembayaran Karyawan',
            'payment_employes' => $payment_employes,
            'month'     => $year.'-'.$month,
            'layout'    => $layout
        ]);
   }
   
    public function storePayrol(Request $request){

        $validatedData = $request->validate([
            'uuid' => '',
            'payment_uuid' => '',
            'employee_uuid' => '',
            'value' => '',
        ]);
        if(!$validatedData['uuid']){
            $validatedData['uuid'] = "pe-".Str::uuid();
        }

        $store = PaymentEmployee::updateOrCreate(['uuid' => $validatedData['uuid']], $validatedData);
        return ResponseFormatter::toJson($store, 'Data Payment Employee');
    }
    public function showEmployeePayrol(Request $request){
        $data = PaymentEmployee::where('payment_uuid', $request->payment_uuid)->get();
        return ResponseFormatter::toJson($data, 'Data Payment Employee');
    }
}

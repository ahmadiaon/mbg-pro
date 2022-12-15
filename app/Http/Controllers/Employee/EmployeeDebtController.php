<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\PaymentOther;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeeDebtController extends Controller
{
    public function index(){
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employee-debt'
        ];
        $payment_others = PaymentOther::all();
        $employees = Employee::getAll();
        return view('employee_debt.index', [
            'title'         => 'Hutang',
            'layout'    => $layout,
            'employees' => $employees,
            'payment_others'    => $payment_others,
            'year_month'        => Carbon::today()->isoFormat('Y-M')
        ]);
    }
}

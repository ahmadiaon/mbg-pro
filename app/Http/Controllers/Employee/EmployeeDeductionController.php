<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeDeductionController extends Controller
{
    public function index(){
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employee-deduction'
        ];
        return view('employee_deduction.index', [
            'title'         => 'Pengurang Pendapatan',
            'layout'    => $layout,
        ]);
    }
}

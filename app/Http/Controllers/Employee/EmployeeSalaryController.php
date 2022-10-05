<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;

class EmployeeSalaryController extends Controller
{
   public function indexPayrol(){
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employee-list'
        ];
        return view('payrol.absensi.index', [
            'title'         => 'Add People',
            'layout'    => $layout
        ]);
   }
}

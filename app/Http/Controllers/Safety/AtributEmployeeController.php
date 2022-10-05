<?php

namespace App\Http\Controllers\Safety;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AtributEmployeeController extends Controller
{
    public function index(){
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employee-list'
        ];
        return view('safety.employee.index', [
            'title'         => 'Employee',
            'layout'    => $layout
        ]);
    }
}

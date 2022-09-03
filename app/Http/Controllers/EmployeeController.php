<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Position;
use App\Models\Religion;
use App\Models\Department;

class EmployeeController extends Controller
{
    public function createEmployee(){
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => false,
            'javascript_datatable'  => false,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'listEmployee'
        ];

        $religions = Religion::all();
        $departments = Department::all();
        $positions = Position::all();
        
        return view('hr.create', [
            'title'         => 'Add People',
            'religions' => $religions,
            'departments' => $departments,
            'positions' => $positions,
            'layout'    => $layout
        ]);

        return view('hr.createEmployee');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShiftController extends Controller
{
    public function indexShift(){
        $employees = Employee::join('people', 'people.id', '=', 'employees.people_id')
        ->join('positions', 'positions.id', '=', 'employees.position_id')
        ->join('employee_contracts', 'employee_contracts.employee_id', '=', 'employees.id')
        ->get([
            'people.name',
            'employees.id as  employee_id',
            'employees.NIK_employee',
            'positions.position',
            'employee_contracts.*'
        ]);
        
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'        => 'listEmployee'
        ];

        return view('foreman.shift.index', [
            'title'         => 'Shift',
            'layout'       => $layout,
            'employees'     => $employees,
        ]);
    }
    public function manageCheckerShift(){
        $employees = Employee::join('people', 'people.id', '=', 'employees.people_id')
        ->join('positions', 'positions.id', '=', 'employees.position_id')
        ->join('employee_contracts', 'employee_contracts.employee_id', '=', 'employees.id')
        ->get([
            'people.name',
            'employees.id as  employee_id',
            'employees.NIK_employee',
            'positions.position',
            'employee_contracts.*'
        ]);


        $checkerList = DB::table('shifts')
        ->join('employees','employees.id','=', 'shifts.checker_id')
        // ->join('employees','employees.id','=', 'shifts.checker_id')
        ->join('people','people.id','=', 'employees.people_id')
        ->get(['employees.NIK_employee','people.name','shifts.*']);

        // dd($checkerList);
        
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'        => 'listEmployee'
        ];

        return view('foreman.shift.manage_checker', [
            'title'         => 'Shift',
            'layout'       => $layout,
            'employees'     => $employees,
            'shift_time'    => 'Siang',
            'checkers'      => $checkerList
        ]);
    }

    public function storeManageCheckerShift(Request $request){
        $validatedData = $request->validate([
            'checker_id'      => 'required',
            'shift_date_start'      => 'required',
            'shift_date_end'      => 'required',
            'shift_time'      => 'required'
        ]);

        $validatedData['foreman_id']= session('dataUser')->employee_id;
        $date_start = explode(" ", $validatedData['shift_date_start']);
        $date_end = explode(" ", $validatedData['shift_date_end']);
        $months = ["","Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $monthStartOnNumber =  array_search($date_start[1], $months);
        $monthEndOnNumber =  array_search($date_end[1], $months);

        $validatedData['shift_date_start'] = $date_start[2].'-'.$monthStartOnNumber.'-'.$date_start[0];
        $validatedData['shift_date_end'] = $date_end[2].'-'.$monthEndOnNumber.'-'.$date_end[0];

        $created = Shift::create($validatedData);
        return redirect('/foreman/manage-checker')->with('success', 'Checker Inserted!');

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\EmployeeContract;
use Illuminate\Support\Facades\DB;

class ShiftController extends Controller
{

    public function index(){
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'        => 'foreman-index'
        ];

        return view('foreman.shift.index', [
            'title'         => 'Shift',
            'layout'       => $layout,
        ]);
    }

    public function create(){
        $employees = EmployeeContract::getEmployee();
        
        // dd($employees);

        $shifts = DB::table('shifts')
        ->join('employee_contracts','employee_contracts.uuid','=', 'shifts.checker_uuid')
        ->join('employees','employees.uuid','=', 'employee_contracts.employee_uuid')
        ->join('people','people.uuid','=', 'employees.people_uuid')
        ->get(['employees.nik_employee','people.name','shifts.*']);

        
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'        => 'manage-checker'
        ];

        return view('foreman.shift.create', [
            'title'         => 'Shift',
            'layout'       => $layout,
            'employees'     => $employees,
            'shift_time'    => 'Siang',
            'checkers'      => $shifts
        ]);
    }

    public function store(Request $request){
        // dd($request);
        $validatedData = $request->validate([
            'checker_uuid'      => 'required',
            'shift_date_start'      => 'required',
            'shift_date_end'      => 'required',
            'shift_time'      => 'required'
        ]);

        $validatedData['foreman_uuid']= session('dataUser')->employee_contract_uuid;
        $validatedData['uuid']= 'shift-uuid-'.Str::uuid();
        $date_start = explode(" ", $validatedData['shift_date_start']);
        $date_end = explode(" ", $validatedData['shift_date_end']);
        $months = ["","Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $monthStartOnNumber =  array_search($date_start[1], $months);
        $monthEndOnNumber =  array_search($date_end[1], $months);

        $validatedData['shift_date_start'] = $date_start[2].'-'.$monthStartOnNumber.'-'.$date_start[0];
        $validatedData['shift_date_end'] = $date_end[2].'-'.$monthEndOnNumber.'-'.$date_end[0];

        // dd($validatedData);
        $store = Shift::create($validatedData);
        return redirect('/foreman/shifts/create')->with('success', 'Checker Inserted!');

    }
}

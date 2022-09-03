<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\ShiftList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ShiftListController extends Controller
{
    public function indexProses($idShift){
        // dd($idShift);
        $checker = DB::table('shifts')
        ->join('employees','employees.id','=', 'shifts.checker_id')
        // ->join('employees','employees.id','=', 'shifts.checker_id')
        ->join('people','people.id','=', 'employees.people_id')
        ->where('shifts.id',$idShift)
        ->get(['employees.NIK_employee','people.name','shifts.*'])
        ->first();

        $shiftLists = DB::table('shift_lists')
        ->join('shifts', 'shifts.id', '=', 'shift_lists.shift_id')
        ->join('employees', 'employees.id', '=', 'shift_lists.employee_id')
        ->join('people', 'people.id', '=', 'employees.people_id')
        ->join('positions', 'positions.id', '=', 'employees.position_id')
        ->where('shifts.id', $idShift)
        ->get(['people.name', 'positions.position', 'shift_lists.*', 'employees.NIK_employee']);

        // dd($shiftLists);


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
        $data =  [
            'title'         => 'Shift',
            'layout'       => $layout,
            'employees'     => $employees,
            'checker'      => $checker,
            'shiftLists'    => $shiftLists
        ];
        return $data;
    }
    public function index(Request $request){
        return  view('foreman.shift_list.index', $this->indexProses($request->id));
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'shift_id'      => 'required',
            'employee_id'      => 'required',
        ]);

        $created = ShiftList::create($validatedData);
        return  view('foreman.shift_list.index', $this->indexProses($request->shift_id));
    }
}

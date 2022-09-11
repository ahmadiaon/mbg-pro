<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\ShiftList;
use Illuminate\Http\Request;
use App\Models\EmployeeContract;
use Illuminate\Support\Facades\DB;


class ShiftListController extends Controller
{
    public function indexProses($idShift){
    
        $checker = DB::table('shifts')
        ->join('employee_contracts', 'employee_contracts.uuid', '=', 'shifts.checker_uuid')
        ->join('employees','employees.uuid','=', 'employee_contracts.employee_uuid')
        ->join('people','people.uuid','=', 'employees.people_uuid')
        ->where('shifts.id',$idShift)
        ->get(['employees.NIK_employee','people.name','shifts.*'])
        ->first();

        $shiftLists = DB::table('shift_lists')
        ->join('shifts', 'shifts.uuid', '=', 'shift_lists.shift_uuid')
        ->join('employee_contracts', 'employee_contracts.uuid', '=', 'shift_lists.contract_employee_uuid')
        ->join('employees','employees.uuid','=', 'employee_contracts.employee_uuid')
        ->join('people', 'people.uuid', '=', 'employees.people_uuid')
        ->join('positions', 'positions.uuid', '=', 'employee_contracts.position_uuid')
        ->where('shifts.id', $idShift)
        ->get(['people.name', 'positions.position', 'shift_lists.*', 'employees.NIK_employee']);


        $employees = EmployeeContract::getEmployee();

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
            'shift_uuid'      => 'required',
            'contract_employee_uuid'      => 'required',
        ]);

        $created = ShiftList::create($validatedData);
        return  view('foreman.shift_list.index', $this->indexProses($request->shift_id));
    }
}

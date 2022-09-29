<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\SafetyEmployee;
use App\Models\EmployeeContract;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreSafetyEmployeeRequest;
use App\Http\Requests\UpdateSafetyEmployeeRequest;

class SafetyEmployeeController extends Controller
{
    
    public function anyData()
    {
        $employees = DB::table('employee_contracts')
        ->join('employees', 'employees.uuid', '=', 'employee_contracts.employee_uuid')
        ->join('people', 'people.uuid', '=', 'employees.people_uuid')
        ->join('positions', 'positions.uuid', '=', 'employee_contracts.position_uuid')
        ->join('safety_employees','safety_employees.employee_contract_uuid', '=', 'employee_contracts.uuid')
        ->get([ 
            'people.name',
            'employees.nik_employee',
            'safety_employees.*',
            'positions.position',
        ]);

        // dd($employees);


        return Datatables::of($employees)
        ->addColumn('action', function ($model) {
            return '<a class="text-decoration-none" href="/safety/' . $model->nik_employee . '/show">
                            <button class="btn btn-secondary py-1 px-2 mr-1">
                                <i class="icon-copy bi bi-eye-fill"></i>
                            </button>
                        </a>';
        })
        ->make(true);
            
    }
    public function index(){
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'safety'
        ];
        return view('safety.employee.index', [
            'title'         => 'Add People',
            'layout'    => $layout
        ]);
    }

    public function show($nik_employee){
        $employee = DB::table('employee_contracts')
        ->join('employees', 'employees.uuid', '=', 'employee_contracts.employee_uuid')
        ->join('departments', 'departments.uuid', '=', 'employee_contracts.department_uuid')
        ->join('people', 'people.uuid', '=', 'employees.people_uuid')
        ->join('positions', 'positions.uuid', '=', 'employee_contracts.position_uuid')
        ->join('safety_employees','safety_employees.employee_contract_uuid', '=', 'employee_contracts.uuid')
        ->where('employees.nik_employee', $nik_employee )
        ->get([ 
            'people.name',
            'employee_contracts.uuid as employee_contract_uuid',
            'departments.department',
            'employees.nik_employee',
            'safety_employees.*',
            'positions.position',
        ])
        ->first();
        // dd($employee);
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => false,
            'javascript_datatable'  => false,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'safety'
        ];
        return view('safety.employee.edit', [
            'title'         => 'Add People',
            'employee'  => $employee,
            'layout'    => $layout
        ]);
    }

    public function store(Request $request, $nik_employee){
        $validateData = $request->validate([
            'employee_contract_uuid' => '',

            'rompi_status' => '',
            'helm_color' => '',
             'boots_size' => '',

           'orange_size' => '',
            'blue_size' => '',
           'shirt_size' => '',

           'no_reg' => 'required'
        ]);

        $safety = SafetyEmployee::where('uuid', $request->uuid)->first();

        if($validateData['rompi_status'] != $safety->rompi_status){
            $validateData['rompi_date'] = Carbon::today()->isoFormat('Y-M-D');
        }
        if($validateData['helm_color'] != $safety->helm_color){
            $validateData['helm_date'] = Carbon::today()->isoFormat('Y-M-D');
        }
        if($validateData['blue_size'] != $safety->blue_size){
            $validateData['blue_date'] = Carbon::today()->isoFormat('Y-M-D');
        }
        if($validateData['orange_size'] != $safety->orange_size){
            $validateData['orange_date'] = Carbon::today()->isoFormat('Y-M-D');
        }
        if($validateData['shirt_size'] != $safety->shirt_size){
            $validateData['shirt_date'] = Carbon::today()->isoFormat('Y-M-D');
        }
        if($validateData['boots_size'] != $safety->boots_size){
            $validateData['boots_date'] = Carbon::today()->isoFormat('Y-M-D');
        }

        // dd($validateData);


        // $from = Carbon::today()->isoFormat('Y-M-D');
        // 'uuid'  => Str::uuid(),
        // $storeSafety = SafetyEmployee::update($validateDataSafety);
        $storeSafety = SafetyEmployee::where('uuid', $request->uuid )
        ->update($validateData);

        return redirect()->intended('/safety');

    }
}





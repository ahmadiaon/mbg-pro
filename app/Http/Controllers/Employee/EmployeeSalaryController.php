<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee\EmployeePremi;
use App\Models\Employee\EmployeeSalary;
use App\Models\Premi;
use Illuminate\Http\Request;

class EmployeeSalaryController extends Controller
{
    public function store(Request $request){

        
        // dd($request);
        $premis = Premi::all();
        $validateData = $request->all();

        if($validateData['uuid'] == null){
            $validateData['uuid'] = $validateData['employee_uuid'];
        }

        foreach($premis as $premi){
            if($validateData[$premi->uuid]!=null){
                EmployeePremi::updateOrCreate(['uuid'   => $validateData['employee_uuid'].'-'.$premi->uuid], [
                    'employee_uuid' => $validateData['employee_uuid'],
                    'premi_uuid'    => $premi->uuid,
                    'premi_value'   => $validateData[$premi->uuid],
                    'date_start'    => $validateData['date_start']
                ]);
            }
           
        }

        $storeEmployeeSalary = EmployeeSalary::updateOrCreate(['uuid'   => $validateData['uuid']], $validateData);
        return ResponseFormatter::toJson($validateData, 'Data Store User Education');
        $store = EmployeeSalary::updateOrCreate(['uuid' => $validateData['uuid']], $validateData );

        return ResponseFormatter::toJson($store, 'Data Store User Education');
    }

    public function anyDataOne($uuid){
        $data = EmployeeSalary::where('uuid', $uuid)->first();
        $employee_premis = EmployeePremi::where('employee_uuid', $uuid)->get();

        foreach($employee_premis as $employee_premi){
            $col_name =$employee_premi->premi_uuid;

            $data->$col_name = $employee_premi->premi_value;
        }
        return ResponseFormatter::toJson($data, 'data employee-salary');
    }
}

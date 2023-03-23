<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeePremi;
use App\Models\Employee\EmployeeSalary;
use App\Models\HourMeterPrice;
use App\Models\Premi;
use Illuminate\Http\Request;

class EmployeeSalaryController extends Controller
{
    public function create($nik_employee = null, $is_edit = null){
        $layout = [
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'employee-salary',
        ];
        
        $hour_meter_prices = HourMeterPrice::all();        
        $premis = Premi::all();
   

        if($is_edit != null){
            $is_edit = true;
        }
        
        
        return view('employee.salary.create', [
            'title'         => 'Tambah Karyawan',            
            'hour_meter_prices' => $hour_meter_prices,   
            'premis' => $premis,
            'layout'    => $layout
        ]);
    }

    public function store(Request $request){
        $premis = Premi::all();      
        $validateData = $request->all();
        $data = session('recruitment-user');

        // if($validateData['uuid'] == null){
            $validateData['employee_uuid'] = $validateData['uuid'];
        // }

        
        foreach($premis as $premi){
            if(!empty($validateData[$premi->uuid])){
                EmployeePremi::updateOrCreate(['uuid'   => $validateData['employee_uuid'].'-'.$premi->uuid], [
                    'employee_uuid' => $validateData['employee_uuid'],
                    'premi_uuid'    => $premi->uuid,
                    'premi_value'   => $validateData[$premi->uuid],
                    'date_start'    => $validateData['date_start']
                ]);
            }
           
        }

        $storeEmployeeSalary = EmployeeSalary::updateOrCreate(['uuid'   => $validateData['uuid']], $validateData);
       
        // $store = EmployeeSalary::updateOrCreate(['uuid' => $validateData['uuid']], $validateData );

        $data_store = Employee::showWhereNik_employee($validateData['uuid']);
        $data['detail'] = $data_store;
        session()->put('recruitment-user', $data);   
        return ResponseFormatter::toJson($validateData, 'Data Store User Salary');
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

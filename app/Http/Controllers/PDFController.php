<?php

namespace App\Http\Controllers;

use PDF;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PDFController extends Controller
{
    //
    public function generatePDF()
    {
        $data = DB::table('employees')
        ->join('people', 'people.id', '=', 'employees.people_id')
        ->join('employee_contracts', 'employee_contracts.employee_id', '=', 'employees.id')
        ->join('positions', 'positions.id', '=', 'employees.position_id')
        ->join('departments', 'departments.id', '=', 'employees.department_id')
        ->join('religions', 'religions.id', '=', 'people.religion_id')
        ->where('employees.id', 1)
        ->get([
            'people.*',
            'employees.id as  employee_id',
            'employees.*',
            'employee_contracts.*',
            'positions.position',
            'religions.religion',
            'departments.department'
            ])->first();
            // return $data;
          $data1 = [
           'name'=> $data->name,
           'nik_number'=> $data->nik_number,
           'phone_number'=> $data->phone_number,
           'salary'=> $data->salary,
           'position'=> $data->position,
           'department'=> $data->department,
           'nik_employee'=> $data->nik_employee,

           'date_start_contract'=> $data->date_start_contract,
           'date_start_contract'=> $data->date_start_contract,
           'long_contract'=> $data->long_contract,
           'employee_status'=> $data->employee_status,
           'department'=> $data->department,
           
          ];
        //   return $data1;
        $pdf = PDF::loadView('pdf.pkwtPdf', $data1);
    
        return $pdf->download('itsolutionsff.pdf');
    }

    public function showPDF(){
        $data = DB::table('employees')
        ->join('people', 'people.id', '=', 'employees.people_id')
        ->join('employee_contracts', 'employee_contracts.employee_id', '=', 'employees.id')
        ->join('positions', 'positions.id', '=', 'employees.position_id')
        ->join('departments', 'departments.id', '=', 'employees.department_id')
        ->join('religions', 'religions.id', '=', 'people.religion_id')
        ->where('employees.id', 1)
        ->get([
            'people.*',
            'employees.id as  employee_id',
            'employees.*',
            'employee_contracts.*',
            'positions.position',
            'religions.religion',
            'departments.department'
            ])->first();
            // return $data;
          $data1 = [
           'name'=> $data->name,
           'nik_number'=> $data->nik_number,
           'phone_number'=> $data->phone_number,
           'salary'=> $data->salary,
           'position'=> $data->position,
           'department'=> $data->department,
           'nik_employee'=> $data->nik_employee,

           'date_start_contract'=> $data->date_start_contract,
           'date_start_contract'=> $data->date_start_contract,
           'long_contract'=> $data->long_contract,
           'employee_status'=> $data->employee_status,
           'department'=> $data->department,
           
          ];

          return view(
            'pdf.pkwtPdf', $data1
          );
    }
}
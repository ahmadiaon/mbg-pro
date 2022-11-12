<?php

namespace App\Http\Controllers\Safety;

use App\Helpers\ResponseFormatter;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployeeContract;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreSafetyEmployeeRequest;
use App\Http\Requests\UpdateSafetyEmployeeRequest;
use App\Models\Employee\Employee;
use App\Models\Safety\AtributSize;
use App\Models\Safety\SafetyEmployee;
use App\Models\UserDetail\UserDetail;
use App\Models\UserDetail\UserHealth;
use App\Models\UserDetail\UserLicense;

class SafetyEmployeeController extends Controller
{
    
    public function anyData()
    {
        $employees = Employee::join('user_details','user_details.uuid','=','employees.user_detail_uuid')
        ->leftJoin('user_licenses','user_licenses.user_detail_uuid','=','user_details.uuid')
        ->leftJoin('user_healths','user_healths.user_detail_uuid','=','user_details.uuid')
        ->leftJoin('positions','positions.uuid','=','employees.position_uuid')
        ->leftJoin('safety_employees','safety_employees.employee_uuid','=','employees.nik_employee')
        
        ->get([
            'user_details.name',
            'user_details.photo_path',
            'positions.position',
            'employees.employee_status',
            'employees.uuid',
            'employees.machine_id',
            'employees.nik_employee',
            'safety_employees.*'
        ]);

     

        // return view('datatableshow', [ 'data'         => $employees]);
        


        return Datatables::of($employees)
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
            'active'                        => 'safety-index'
        ];
        return view('safety.index', [
            'title'         => 'Employee',
            'layout'    => $layout
        ]);
    }


    public function edit($nik_employee){
        $no_reg = 1;
        $data = Employee::leftJoin('user_details','user_details.uuid','=','employees.user_detail_uuid')
        ->leftJoin('user_licenses','user_licenses.user_detail_uuid','=','user_details.uuid')
        ->leftJoin('user_healths','user_healths.user_detail_uuid','=','user_details.uuid')
        ->leftJoin('positions','positions.uuid','=','employees.position_uuid')
        ->leftJoin('employee_companies','employee_companies.employee_uuid','=','employees.uuid')
        ->leftJoin('safety_employees','safety_employees.employee_uuid','=','employees.nik_employee')
        ->where('employees.nik_employee', $nik_employee)
        ->get([
            'user_details.name',
            'employee_companies.company_uuid',
            'user_details.photo_path',
            'positions.position',
            'employees.employee_status',
            'employees.uuid',
            'employees.machine_id',
            'employees.nik_employee',
            'safety_employees.*'
        ])
        ->first();
        $unit_huruf = AtributSize::where('size', 'huruf')->get();
        $unit_angka = AtributSize::where('size', 'angka')->get();
        $unit_warna = AtributSize::where('size', 'warna')->get();
        $employee = SafetyEmployee::where('no_reg', '!=',null)->latest()->first();
        // dd($employee);
        if($employee != null){
            // return $employee;
            $no_reg = $employee->no_reg;
          
            $no_reg_suggest = $no_reg+1;
        }else{
            $no_reg_suggest = 1;
        }
        $m = Carbon::today('Asia/Jakarta')->isoFormat('M');
        $y = Carbon::today('Asia/Jakarta')->isoFormat('Y');

        
        // dd($unit_angka);
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'safety-index'
        ];
        return view('safety.show', [
            'title'         => 'Employee',
            'data'          => $data,
            'no_reg'    => $no_reg_suggest,
            'year_month'    => $m.$y[2].$y[3],
            'unit_huruf' => $unit_huruf,
            'unit_warna' => $unit_warna,
            'unit_angka' => $unit_angka,
            'layout'    => $layout
        ]);
    }

    public function store(Request $request){
        $data = Employee::leftJoin('user_details','user_details.uuid','=','employees.user_detail_uuid')
     
        ->where('employees.nik_employee',$request->nik_employee)
        ->get([
            'user_details.uuid as user_detail_uuid',
          
        ])
        ->first();
        if($request->userpic){

            
            $img = $request->userpic;
            $folderPath = "file/image/user/"; //path location
            
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath . $request->nik_employee . '.'.$image_type;
            if(file_exists($file)){
               unlink($file);
            }
            file_put_contents($file, $image_base64);
            $store = UserDetail::updateOrCreate(['uuid'=> $data->user_detail_uuid],['photo_path' => $file]);
            return ResponseFormatter::toJson($store, 'da');

        }
        $validateData = $request->validate([
            'nik_employee' => '',

            'no_reg' => '',

            // foreign key
            'employee_uuid' => '',
            'date' => '',
            'end_date' => '',

            'rompi_status' => '',
            'rompi_date' => '',

            'helm_color' => '',
            'helm_date' => '',

            'orange_size' => '',
            'orange_date' => '',

            'blue_size' => '',
            'blue_date' => '',

            'shirt_size' => '',
            'shirt_date' => '',

            'boots_size' => '',
            'boots_date' => '',

            'mekanik_size' => '',
            'mekanik_date' => '',
            
            'id_card_date' => '',
        ]);

        $validateData['no_reg_full'] = $validateData['no_reg'];
        $no_regs = explode('-', $validateData['no_reg']);
        $no_reg = $no_regs[2];
        $validateData['no_reg'] = $no_reg;
        $validateData['uuid'] = $validateData['nik_employee'];
        $validateData['employee_uuid'] = $validateData['nik_employee'];
        $store = SafetyEmployee::updateOrCreate(['uuid'=> $validateData['uuid']],$validateData);

        return redirect()->intended('/safety/edit/'.$validateData['nik_employee'])->with('success', 'data stored');
    }
}





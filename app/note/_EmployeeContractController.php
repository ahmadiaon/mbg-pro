<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Health;
use App\Models\people;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Religion;
use App\Models\Dependent;
use App\Models\Education;
use App\Models\Department;
use App\Models\Experience;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SafetyEmployee;
use App\Models\EmployeeContract;
use Yajra\Datatables\Datatables;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;




class EmployeeContractController extends Controller
{

    public function anyData()
    {
        $dataAny =  Employee::join('people', 'people.uuid', '=', 'employees.people_uuid')
        ->join('employee_contracts', 'employee_contracts.employee_uuid', '=', 'employees.uuid')
        ->join('positions', 'positions.uuid', '=', 'employee_contracts.position_uuid')
       
        ->get([
            'people.name',
            'employees.uuid as  employee_uuid',
            'employees.nik_employee',
            'positions.position',
            'employee_contracts.*'
        ]);

        return Datatables::of($dataAny)
        ->addColumn('action', function ($model) {
            $url = "/admin/vehicle/";
            $url_edit = "'".$url.$model->uuid."'";
            $url_delete = "'".$url."delete/'";
            return '<a class="text-decoration-none" href="/admin-hr/employees/contract/show/' . $model->nik_employee . '"><button class="btn btn-secondary py-1 px-2 mr-1"><i class="icon-copy bi bi-eye-fill"></i></button></a><input type="hidden" value="'. $model->nik_employee .'"><button id="'.$model->nik_employee .'" onclick="runEditVehicle(' . $model->nik_employee . ','.$url_edit.')"  class="btn btn-warning py-1 px-2 mr-1"><i class="icon-copy dw dw-pencil"></i></button>
            <button onclick="isDeletevehicle(' . $model->nik_employee . ','.$url_delete.')"  type="button" class="btn btn-danger  py-1 px-2"><i class="icon-copy dw dw-trash"></i></button>';
        })
        ->addColumn('days_left', function ($model) {

            $to = new Carbon($model->date_year_end_contract.'-'.$model->date_month_end_contract.'-'.$model->date_date_end_contract);
            $from = Carbon::today()->isoFormat('Y-M-D');
            $left =  $to->diffInDays($from);
            return $left.' Hari';
        })
        ->addColumn('date_start_contract', function ($model) {
            return $model->date_year_start_contract.'-'.$model->date_month_start_contract.'-'.$model->date_date_start_contract;
        })
        ->addColumn('date_end_contract', function ($model) {
            return $model->date_year_end_contract.'-'.$model->date_month_end_contract.'-'.$model->date_date_end_contract;
        })


        ->make(true);
            
    }

    public function show($employee)
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

        return view('admin.employee_contract.show', [
            'title'         => 'Setup',
            'employee'      => $data
        ]);
    }

    public function showEmployeeContract($nik_employee){
        $data = DB::table('employees')
        ->join('people', 'people.id', '=', 'employees.people_id')
        ->join('employee_contracts', 'employee_contracts.employee_id', '=', 'employees.id')
        ->join('positions', 'positions.id', '=', 'employees.position_id')
        ->join('departments', 'departments.id', '=', 'employees.department_id')
        ->join('religions', 'religions.id', '=', 'people.religion_id')
        ->where('employees.nik_employee', $nik_employee)
        ->get([
            'people.id as people_id',
            'employees.id as  employee_id',
            'employees.*',
            'employee_contracts.*',
            'positions.position',
            'religions.religion',
            'departments.department'
            ])->first();


            // people
            $identitas = DB::table('employees')
            ->join('people', 'people.id', '=', 'employees.people_id')
            ->join('religions', 'religions.id', '=', 'people.religion_id')
            ->where('employees.nik_employee', $nik_employee)
            ->get(['people.*', 'religions.religion'])
            ->first();

            // experiences
             $experiences = DB::table('employees')
            ->join('people', 'people.id', '=', 'employees.people_id')
            ->join('experiences', 'experiences.people_id', '=', 'people.id')
            ->where('experiences.people_id', $data->people_id )
            ->get(['experiences.*']);

            // educations
            $education = DB::table('employees')
            ->join('people', 'people.id', '=', 'employees.people_id')
            ->join('education', 'education.people_id', '=', 'people.id')
            ->where('education.people_id', $data->people_id )
            ->get(['education.*'])
            ->first();

            // dependents
            $dependents = DB::table('employees')
            ->join('people', 'people.id', '=', 'employees.people_id')
            ->join('dependents', 'dependents.people_id', '=', 'people.id')
            ->where('dependents.people_id', $data->people_id )
            ->get(['dependents.*'])
            ->first();
            // dd($identitas);


            $employeeData = [
                'identity'    => $identitas,
                'experiences' => $experiences,
                'education' => $education,
                'dependents' => $dependents,
                'employees'     => $data
            ];
            // dd($employeeData);

            $layout = [
                'head_core'            => true,
                'javascript_core'       => true,
                'head_datatable'        => true,
                'javascript_datatable'  => true,
                'head_form'             => false,
                'javascript_form'       => false,
                'active'                        => 'listEmployee'
            ];

        return view('admin.employee_contract.show', [
            'title'         => 'Setup',
            'employeeData'      => $employeeData,
            'layout'    => $layout
        ]);
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'employee_uuid' => '',
            'position_uuid' => '',
            'department_uuid' => '',
           'contract_number' => '',
            'contract_status' => '',//pkwt-pkwtt

           'date_start_contract' => '',
           'date_end_contract' => '',
            
           'long_contract' => '',
            'employee_status' => '',  
        ]);
        // return $validateData;
        $date_date_start_contract = ResponseFormatter::toDate($request->date_start_contract);
        $date_start = explode("-", $date_date_start_contract);

        $date_date_end_contract = ResponseFormatter::toDate($request->date_end_contract);
        $date_end = explode("-", $date_date_end_contract);

        
        $validateData['date_date_start_contract'] =$date_start[2] ;
        $validateData['date_month_start_contract'] =$date_start[1] ;
        $validateData['date_year_start_contract'] =$date_start[0] ;

        $validateData['date_date_end_contract'] =$date_end[2] ;
        $validateData['date_month_end_contract'] =$date_end[1] ;
        $validateData['date_year_end_contract'] =$date_end[0] ;

        $validateData['date_dokument_contract'] =Carbon::today('Asia/Jakarta')->isoFormat('Y-M-D'); 
        $validateData['uuid'] ='EmployeeContract-'.Str::uuid();
        $store = EmployeeContract::create($validateData);

        $validateDataSafety = [
            'uuid'  => Str::uuid(),
            'employee_contract_uuid' => $store->uuid,
        ];
        $storeSafety = SafetyEmployee::create($validateDataSafety);


        return redirect()->intended('/admin-hr/monitoring');
    }

    public function index(){
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'admin-hr-employees-monitoring'
        ];
        return view('hr.employee.index', [
            'title'         => 'Add People',
            'layout'    => $layout
        ]);
    }



}

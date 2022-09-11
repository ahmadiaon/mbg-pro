<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Health;
use App\Models\people;
use App\Models\License;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Religion;
use App\Models\Dependent;
use App\Models\Education;
use App\Models\Department;
use App\Models\Experience;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function indexHR(){
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => false,
            'javascript_datatable'  => false,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'admin-hr-employees'
        ];
        return view('hr.employee.index', [
            'title'         => 'Add People',
            'layout'    => $layout
        ]);
    }
    public function employeesData()
    {
        $data = DB::table('employees')
        ->get();

        dd($data);
        // $model =  Employee::join('people', 'people.id', '=', 'employees.people_id')
        // ->join('positions', 'positions.id', '=', 'employees.position_id')
        // ->join('employee_contracts', 'employee_contracts.employee_id', '=', 'employees.id')
        // ->get([
        //     'people.name',
        //     'employees.id as  employee_id',
        //     'employees.NIK_employee',
        //     'positions.position',
        //     'employee_contracts.*'
        // ]);

        // dd($model);


        //     $date_end = explode(" ", $model->date_end_contract);
           
        //     $months = ["","Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        //     // 
        //     $date_to = $date_end[2]."-".array_search($date_end[1], $months)."-".$date_end[0];
        //     $to = Carbon::createFromFormat('Y-m-d', $date_to);
        //     $from = Carbon::today()->isoFormat('Y-M-d');
        //   return  $left =  $to->diffInDays($from)-10;
        $dataAny =  Employee::join('people', 'people.id', '=', 'employees.people_id')
        ->join('positions', 'positions.id', '=', 'employees.position_id')
        ->join('employee_contracts', 'employee_contracts.employee_id', '=', 'employees.id')
        ->get([
            'people.name',
            'employees.id as  employee_id',
            'employees.NIK_employee',
            'positions.position',
            'employee_contracts.*'
        ]);

        return Datatables::of($dataAny)
        ->addColumn('action', function ($model) {
            $url = "/admin/vehicle/";
            $url_edit = "'".$url.$model->id."'";
            $url_delete = "'".$url."delete/'";
            return '<a class="text-decoration-none" href="/admin-hr/employees/contract/show/' . $model->NIK_employee . '"><button class="btn btn-secondary py-1 px-2 mr-1"><i class="icon-copy bi bi-eye-fill"></i></button></a><input type="hidden" value="'. $model->NIK_employee .'"><button id="'.$model->NIK_employee .'" onclick="runEditVehicle(' . $model->NIK_employee . ','.$url_edit.')"  class="btn btn-warning py-1 px-2 mr-1"><i class="icon-copy dw dw-pencil"></i></button>
            <button onclick="isDeletevehicle(' . $model->NIK_employee . ','.$url_delete.')"  type="button" class="btn btn-danger  py-1 px-2"><i class="icon-copy dw dw-trash"></i></button>';
        })
        ->addColumn('days_left', function ($model) {

            $date_end = explode(" ", $model->date_end_contract);
           
            $months = ["","Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            // 
            $date_to = $date_end[2]."-".array_search($date_end[1], $months)."-".$date_end[0];
            $to = Carbon::createFromFormat('Y-m-d', $date_to);
            $from = Carbon::today()->isoFormat('Y-M-D');
            $left =  $to->diffInDays($from);
            return $left.' Hari';
        })


        ->make(true);
            
    }
    public function create(){
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => false,
            'javascript_datatable'  => false,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'                        => 'admin-hr-employees'
        ];

        $religions = Religion::all();
        $departments = Department::all();
        $positions = Position::all();
        
        return view('hr.create', [
            'title'         => 'Add People',
            'religions' => $religions,
            'departments' => $departments,
            'positions' => $positions,
            'layout'    => $layout
        ]);

        return view('hr.employee.create');
    }
    
    public function store(Request $request){
        $d = Carbon::today('Asia/Jakarta')->isoFormat('D');
        $m = Carbon::today('Asia/Jakarta')->isoFormat('M');
        $y = Carbon::today('Asia/Jakarta')->isoFormat('Y');

        $date_now = $d.' '.ResponseFormatter::getMonthName($m).' '.$y;

        $d = Carbon::today()->addDays(90)->isoFormat('D');
        $m = Carbon::today()->addDays(90)->isoFormat('M');
        $y = Carbon::today()->addDays(90)->isoFormat('Y');
        $date_sub = $d.' '.ResponseFormatter::getMonthName($m).' '.$y;

        $validateDataPeople = $request->validate([
            'name'         => 'required|max:255',
            'citizenship'         => 'required|max:255',
            'religion_uuid'         => 'required|max:255',
            'license_uuid' => '',
            'religion_uuid' => '', 

            'name' => 'required',
            'NIK_number' => 'required',
            'KK_number' => 'required',
            'citizenship' => 'required',
            'gender' => 'required',

            'place_of_birth' => 'required',
            'date_of_birth' => 'required',

            'blood_group' => 'required',
            'status' => 'required',
            'address' => 'required',

            'financial_number' => '',
            'bpjs_ketenagakerjaan' => '',
            'bpjs_kesehatan' => '',
            
            'group_poh' => 'required',
            'poh_place' => 'required',

            'phone_number' => 'required',
            'photo_path' => '',
        ]);

        $validateDataLicence = $request->validate([
            'sim_A' => '',
            'sim_B1' => '',
            'sim_B2' => '',
            'sim_C' => '',
            'sim_D' => '',
            'sim_A_UMUM' => '',
            'sim_B1_UMUM' => '',
            'SIM_B2_UMUM' => '',
        ]);
        $validateDataEducation = $request->validate([
            'sd_name'         => '',
            'sd_place'         => '',
            'sd_year'         => '',

            'smp_name'         => '',
            'smp_place'         => '',
            'smp_year'         => '',

            'sma_name'         => '',
            'sma_place'         => '',
            'sma_jurusan'         => '',
            'sma_year'         => '',
            
            'ptn_place'         => '',
            'ptn_name'         => '',
            'ptn_jurusan'         => '',
            'ptn_year'         => '',

            'dll_name'         => '',
            'dll_place'         => '',
            'dll_jurusan'         => '',
            'dll_year'         => '',
        ]);

        $validateDataExperience = $request->validate([
            'exp_1_name'         => '',
            'exp_1_position'         => '',
            'exp_1_date_start'         => '',
            'exp_1_date_end'         => '',
            'exp_1_reason'         => '',

            'exp_2_name'         => '',
            'exp_2_position'         => '',
            'exp_2_date_start'         => '',
            'exp_2_date_end'         => '',
            'exp_2_reason'         => '',

            'exp_3_name'         => '',
            'exp_3_position'         => '',
            'exp_3_date_start'         => '',
            'exp_3_date_end'         => '',
            'exp_3_reason'         => '',

            'exp_4_name'         => '',
            'exp_4_position'         => '',
            'exp_4_date_start'         => '',
            'exp_4_date_end'         => '',
            'exp_4_reason'         => '',
        ]);

        $validateDataDependent = $request->validate([
            'mother_name'         => 'required',
            'mother_gender'         => 'required',
            'mother_education'         => 'required',
            'mother_place_birth'         => 'required',
            'mother_date_birth'         => 'required',

            'father_name'         => 'required',
            'father_gender'         => 'required',
            'father_education'         => 'required',
            'father_place_birth'         => 'required',
            'father_date_birth'         => 'required',

            'mother_in_law_name'         => '',
            'mother_in_law_gender'         => '',
            'mother_in_law_education'         => '',
            'mother_in_law_place_birth'         => '',
            'mother_in_law_date_birth'         => '',

            'father_in_law_name'         => '',
            'father_in_law_gender'         => '',
            'father_in_law_education'         => '',
            'father_in_law_place_birth'         => '',
            'father_in_law_date_birth'         => '',

            'couple_name'         => '',
            'couple_gender'         => '',
            'couple_education'         => '',
            'couple_place_birth'         => '',
            'couple_date_birth'         => '',
            
            'child1_name'         => '',
            'child1_gender'         => '',
            'child1_education'         => '',
            'child1_place_birth'         => '',
            'child1_date_birth'         => '',

            'child2_name'         => '',
            'child2_gender'         => '',
            'child2_education'         => '',
            'child2_place_birth'         => '',
            'child2_date_birth'         => '',

            'child3_name'         => '',
            'child3_gender'         => '',
            'child3_education'         => '',
            'child3_place_birth'         => '',
            'child3_date_birth'         => '',
        ]);

        $validateDataHealth = $request->validate([
            'name_health'         => '',
            'status_health'         => '',
            'long'         => '',
            'health_care_place'         => '',
            'year_health'         => '',
        ]);

        $validateDataEmployee = $request->validate([
                'people_uuid' => '',
                'license_uuid' => '',

                'NIK_employee' => '',
                'salary' => '',
                'insentif' => '',
                'premi_bk' => '',
                'premi_nbk' => '',
                'premi_kayu' => '',
                'premi_mb' => '',
                'premi_rj' => '',
        ]);

        //add licence
        $validateDataLicence['uuid'] = 'license-'.Str::uuid();
        $storeLicense = License::create(
            $validateDataLicence
        );

        // add people
        $validateDataPeople['date_of_birth'] = ResponseFormatter::toDate($validateDataPeople['date_of_birth']);
        $validateDataPeople['uuid'] = 'people-'.Str::uuid();
        $validateDataPeople['license_uuid'] = $storeLicense->uuid;
        $storePeople = People::create(
            $validateDataPeople
        );

        //add education
        $validateDataEducation['uuid'] = 'education-'.Str::uuid();
        $storeEducation = Education::create(
            $validateDataEducation
        );

        //add experience
        $validateDataExperience['uuid'] = 'Experience-'.Str::uuid();
        $storeExperience = Experience::create(
            $validateDataExperience
        );

        //add Dependent
        $validateDataDependent['uuid'] = 'Dependent-'.Str::uuid();
        $storeDependent = Dependent::create(
            $validateDataDependent
        );

        //add Health
        $validateDataHealth['uuid'] = 'Health-'.Str::uuid();
        $validateDataHealth['employee_uuid'] = 'Health-'.Str::uuid();
        $storeHealth = Health::create(
            $validateDataHealth
        );

        //add Employee
        $validateDataEmployee['uuid'] = 'Employee-'.Str::uuid();
        $validateDataEmployee['people_uuid'] = $storePeople->uuid;
        $storeEmployee = Employee::create(
            $validateDataEmployee
        );
        $storeEmployee->name= $storePeople->name;

        //add user
        $validateDataUser['uuid'] = 'User-'.Str::uuid();
        $validateDataUser['employee_uuid'] =  $storeEmployee->uuid;
        $validateDataUser['role'] = 'employee';
        $validateDataUser['NIK_employee'] = $validateDataEmployee['NIK_employee'];;
        $validateDataUser['password'] = Hash::make('password');
        $storeUser = User::create(
            $validateDataUser
        );
        

        $layout = [
                'head_core'            => true,
                'javascript_core'       => true,
                'head_datatable'        => false,
                'javascript_datatable'  => false,
                'head_form'             => true,
                'javascript_form'       => true,
                'active'        => 'admin-hr-employees'
            ];
        // dd($storeEmployee);
        
        return view('hr.contract.create', [
            'title'         => 'Employee Contract',
            'employee'      => $storeEmployee,
            'date_now'      => $date_now,
            'long'          => 90,
            'departments' =>Department::all(),
            'positions' => Position::all(),
            'date_sub'      => $date_sub,
            'layout'        => $layout
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Health;
use App\Models\People;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Religion;
use App\Models\Dependent;
use App\Models\Education;
use App\Models\Department;
use App\Models\Experience;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PeopleController extends Controller
{
    public function anyData()
    {
        return Datatables::of(People::query())
        ->addColumn('action', function ($model) {
            return '<a class="text-decoration-none" href="/admin/people/' . $model->NIK_number . '"><button class="btn btn-secondary py-1 px-2 mr-1"><i class="icon-copy bi bi-eye-fill"></i></button></a>
            <a class="text-decoration-none" href="/admin/' . $model->id . '/edit"><button class="btn btn-warning py-1 px-2 mr-1"><i class="icon-copy dw dw-pencil"></i></button></a>
            <button onclick="myFunction(' . $model->id . ')"  type="button" class="btn btn-danger  py-1 px-2"><i class="icon-copy dw dw-trash"></i></button>';
        })
        ->addColumn('name', function ($model) {
            return '<div class="name-avatar d-flex align-items-center">
            <div class="avatar mr-2 flex-shrink-0">
                <img src="http://mb-center.test/vendors/images/photo8.jpg" class="border-radius-100 shadow" width="40" height="40" alt="">
            </div>
            <div class="txt">
                <div class="weight-600">'.$model->name.'</div>
            </div>
        </div>';
        })
        ->escapeColumns('name')
        ->make(true);
            
    }

    public function index()
    {
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true
        ];
        return view('admin.people.index', [
            'title'         => 'People',
            'layout'    => $layout
        ]);
    }

    public function create()
    {
        $religions = Religion::all();
        $departments = Department::all();
        $positions = Position::all();
        return view('admin.people.create', [
            'title'         => 'Add People',
            'religions' => $religions,
            'departments' => $departments,
            'positions' => $positions
        ]);
    }


    public function store(Request $request)
    {
        // return $request;
        $validateData = $request->validate([
            'name'         => 'required|max:255',
            'citizenship'         => 'required|max:255',
            'religion_id'         => 'required|max:255',
            'place_of_birth'         => 'required',
            'date_of_birth'         => 'required',
            'blood_group'         => 'required',
            'status'         => 'required',
            'KK_number'         => 'required',
            'NIK_number'         => 'required',
            'address'         => 'required',
            
            'financial_number'         => 'required',
            'group_license'         => 'required',
            'license_number'         => 'required',
            'bpjs_ketenagakerjaan'         => 'required',
            'bpjs_kesehatan'         => 'required',
            'group_poh'         => 'required',
            'poh_place'         => 'required',
            'phone_number'         => 'required',
           
            
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

            'name_health'         => '',
            'status_health'         => '',
            'long'         => '',
            'health_care_place'         => '',
            'year_health'         => '',

            'NIK_employee'         => 'required',
            'salary'         => '',
            'insentif'         => '',
            'premi_bk'         => '',
            'premi_nbk'         => '',
            'premi_kayu'         => '',
            'premi_mb'         => '',
            'premi_rj'         => '',
        ]);

        $people = People::updateOrCreate([
            'id' => $request->id], 
            [
            'name' => $request->name,
            'NIK_number' => $request->NIK_number,
            
            'KK_number' => $request->KK_number,
            'citizenship' => $request->citizenship,
            'religion_id' => $request->religion_id,
            'gender' => $request->gender,
            'place_of_birth' => $request->place_of_birth,
            'date_of_birth' => $request->date_of_birth,
            'blood_group' => $request->blood_group,
            'status' => $request->status,
            'address' => $request->address,
            'financial_number' => $request->financial_number,
            'group_license' => $request->group_license,
            'license_number' => $request->license_number,
            'bpjs_ketenagakerjaan' => $request->bpjs_ketenagakerjaan,
            'bpjs_kesehatan' => $request->bpjs_kesehatan,
            'group_poh' => $request->group_poh,
            'poh_place' => $request->poh_place,
            'phone_number' => $request->phone_number
          ]);


        //   education
          if($request->sd_name){
            $educations = [
                'sd_name' =>$request->sd_name,
                'sd_place' =>$request->sd_place,
                'sd_year' =>$request->sd_year
            ];
          }

          if($request->smp_name){
            $educations['smp_name'] =$request->smp_name;
            $educations['smp_place'] =$request->smp_place;
            $educations['smp_year'] =$request->smp_year;
          }
          if($request->sma_name){
            $educations['sma_name'] =$request->sma_name;
            $educations['sma_place'] =$request->sma_place;
            $educations['sma_jurusan'] =$request->sma_jurusan;
            $educations['sma_jurusan'] =$request->sma_jurusan;
          }
          if($request->ptn_name){
            $educations['ptn_name'] =$request->ptn_name;
            $educations['ptn_place'] =$request->ptn_place;
            $educations['ptn_jurusan'] =$request->ptn_jurusan;
            $educations['ptn_year'] =$request->ptn_year;
          }
          if($request->dll_name){
            $educations['dll_name'] =$request->dll_name;
            $educations['dll_place'] =$request->dll_place;
            $educations['dll_jurusan'] =$request->dll_jurusan;
            $educations['dll_year'] =$request->dll_year;
          }
          $educations['people_id'] =$people->id;

          $education = Education::updateOrCreate(['id' => $request->id], $educations );

        //   experience
        if($request->exp_1_name){
            $experiences = [
                'experience_place_name' =>$request->exp_1_name,
                'experience_position' =>$request->exp_1_position,
                'experience_date_start' =>$request->exp_1_date_start,
                'experience_date_end' =>$request->exp_1_date_end,
                'experience_reason' =>$request->exp_1_reason
            ];

            $experiences['people_id'] =$people->id;
            $experience = Experience::updateOrCreate(['id' => $request->id], $experiences );

          }
          if($request->exp_2_name){
            $experiences_2 = [
                'experience_place_name' =>$request->exp_2_name,
                'experience_position' =>$request->exp_2_position,
                'experience_date_start' =>$request->exp_2_date_start,
                'experience_date_end' =>$request->exp_2_date_end,
                'experience_reason' =>$request->exp_2_reason
            ];

            $experiences_2['people_id'] =$people->id;
            $experience_2 = Experience::updateOrCreate(['id' => $request->id], $experiences_2 );

          }
          if($request->exp_3_name){
            $experiences_3 = [
                'experience_place_name' =>$request->exp_3_name,
                'experience_position' =>$request->exp_3_position,
                'experience_date_start' =>$request->exp_3_date_start,
                'experience_date_end' =>$request->exp_3_date_end,
                'experience_reason' =>$request->exp_3_reason
            ];

            $experiences_3['people_id'] =$people->id;
            $experience_3 = Experience::updateOrCreate(['id' => $request->id], $experiences_3 );

          }
          if($request->exp_4_name){
            $experiences_4 = [
                'experience_place_name' =>$request->exp_4_name,
                'experience_position' =>$request->exp_4_position,
                'experience_date_start' =>$request->exp_4_date_start,
                'experience_date_end' =>$request->exp_4_date_end,
                'experience_reason' =>$request->exp_4_reason
            ];

            $experiences_4['people_id'] =$people->id;
            $experience_4 = Experience::updateOrCreate(['id' => $request->id], $experiences_4 );

          }

        //  dependents
        $dependents = [
            'mother_name' =>  $request->mother_name,
            'mother_gender' =>  $request->mother_gender,
            'mother_education' =>  $request->mother_education,
            'mother_place_birth' =>  $request->mother_place_birth,
            'mother_date_birth' =>  $request->mother_date_birth,

            'father_name' =>  $request->father_name,
            'father_gender' =>  $request->father_gender,
            'father_education' =>  $request->father_education,
            'father_place_birth' =>  $request->father_place_birth,
            'father_date_birth' =>  $request->father_date_birth
        ];

        if($request->mother_name){
            $dependents['mother_in_law_name'] = $request->mother_in_law_name;
            $dependents['mother_in_law_gender'] = $request->mother_in_law_gender;
            $dependents['mother_in_law_place_birth'] = $request->mother_in_law_place_birth;
            $dependents['mother_in_law_date_birth'] = $request->mother_in_law_date_birth;
            $dependents['mother_in_law_education'] = $request->mother_in_law_education;

            $dependents['father_in_law_name'] = $request->father_in_law_name;
            $dependents['father_in_law_gender'] = $request->father_in_law_gender;
            $dependents['father_in_law_place_birth'] = $request->father_in_law_place_birth;
            $dependents['father_in_law_date_birth'] = $request->father_in_law_date_birth;
            $dependents['father_in_law_education'] = $request->father_in_law_education;
        }

        if($request->couple_name){
            $dependents['couple_name'] = $request->couple_name;
            $dependents['couple_gender'] = $request->couple_gender;
            $dependents['couple_place_birth'] = $request->couple_place_birth;
            $dependents['couple_date_birth'] = $request->couple_date_birth;
            $dependents['couple_education'] = $request->couple_education;
        }

        if($request->child1_name){
            $dependents['child1_name'] = $request->child1_name;
            $dependents['child1_gender'] = $request->child1_gender;
            $dependents['child1_place_birth'] = $request->child1_place_birth;
            $dependents['child1_date_birth'] = $request->child1_date_birth;
            $dependents['child1_education'] = $request->child1_education;
        }
        if($request->child2_name){
            $dependents['child2_name'] = $request->child2_name;
            $dependents['child2_gender'] = $request->child2_gender;
            $dependents['child2_place_birth'] = $request->child2_place_birth;
            $dependents['child2_date_birth'] = $request->child2_date_birth;
            $dependents['child2_education'] = $request->child2_education;
        }
        if($request->child3_name){
            $dependents['child3_name'] = $request->child3_name;
            $dependents['child3_gender'] = $request->child3_gender;
            $dependents['child3_place_birth'] = $request->child3_place_birth;
            $dependents['child3_date_birth'] = $request->child3_date_birth;
            $dependents['child3_education'] = $request->child3_education;
        }

        $dependents['people_id'] =$people->id;
        
        $dependent = Dependent::updateOrCreate(['id' => $request->id], $dependents );


        // health
        if($request->name_health){
            $healths = [
                'name_health' =>$request->name_health,
                'year' =>$request->year,
                'health_care_place' =>$request->health_care_place,
                'status_health' =>$request->status_health,
                'long' =>$request->long
            ];

            $healths['people_id'] =$people->id;
            $health = Health::updateOrCreate(['id' => $request->id], $healths );

          }

           // employee
        if($request->salary){
            $employees = [
                'NIK_employee' =>$request->NIK_employee,
                'salary' =>$request->salary,
                'insentif' =>$request->insentif,
                'premi_bk' =>$request->premi_bk,
                'premi_nbk' =>$request->premi_nbk,
                'premi_kayu' =>$request->premi_kayu,
                'premi_mb' =>$request->premi_mb,
                'premi_rj' =>$request->premi_rj,

                'department_id' =>$request->department_id,
                'position_id' =>$request->position_id
            ];

            $employees['people_id'] =$people->id;
            $employee = Employee::updateOrCreate(['id' => $request->id], $employees );

          }
          $isUser = User::where('NIK_employee',$request->NIK_employee)->first();
          
          if($isUser){
            User::updateOrCreate(['id' => $isUser->id], [
                'NIK_employee' => $request->NIK_employee,
                'name' => $request->name,
                'password' => Hash::make($people->NIK_number),
                'group'     => 'employee'
            ] );
          }else{
            User::create([
                'NIK_employee' => $request->NIK_employee,
                'name' => $request->name,
                'password' => Hash::make($request->NIK_number),
                'group'     => 'employee'
            ]);
          }
          
          $date_now = Carbon::today()->isoFormat('D MMMM Y');
          $date_sub = Carbon::today()->addDays(90)->isoFormat('D MMMM Y');
          $dt = Carbon::now();
          $peoples =   DB::table('employees')
            ->join('people', 'people.id', '=', 'employees.people_id')
            ->where('employees.id',$employee->id)
            ->get(['people.name','employees.id as  employee_id','employees.NIK_employee'])
            ->first();
        // return $peoples;
            $layout = [
                'head_core'            => true,
                'javascript_core'       => true,
                'head_datatable'        => true,
                'javascript_datatable'  => true,
                'head_form'             => true,
                'javascript_form'       => true
            ];
       
            return view('admin.employee_contract.createa', [
                'title'         => 'Employee Contract',
                'employee'      => $peoples,
                'date_now'      => $date_now,
                'long'          => 90,
                'date_sub'      => $date_sub,
                'layout'        => $layout
                
            ]);
          
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\people  $people
     * @return \Illuminate\Http\Response
     */
    public function show($nik)
    {
        
        $people = DB::table('employees')
        ->join('positions', 'employees.position_id', '=', 'positions.id')
        ->join('people', 'employees.people_id', '=', 'people.id')
        ->join('departments', 'employees.department_id', '=', 'departments.id')
        ->where('people.NIK_number', $nik)
        ->get()
        ->first();

        return view('admin.people.show', [
            'title'         => 'People',
            'people'=> $people
        ]);

        return $people;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\people  $people
     * @return \Illuminate\Http\Response
     */
    public function edit(people $people)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepeopleRequest  $request
     * @param  \App\Models\people  $people
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, people $people)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\people  $people
     * @return \Illuminate\Http\Response
     */
    public function destroy(people $people)
    {
        //
    }
}

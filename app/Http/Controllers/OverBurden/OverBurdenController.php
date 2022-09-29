<?php

namespace App\Http\Controllers\OverBurden;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Shift;
use App\Models\Vehicle\Vehicle;
use App\Models\Employee\Employee;
use App\Models\OverBurden\OverBurden;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\OverBurden\OverBurdenNote;
use Yajra\Datatables\Datatables;
use App\Models\OverBurden\OverBurdenOperator;
use Illuminate\Support\Facades\DB;

class OverBurdenController extends Controller
{
    public static function getOverBurden(){
        if(session('dataUser')->role == 'admin-ob'){
            $employee_uuid = session('dataUser')->employee_uuid;
            $over_burdens = DB::table('over_burdens')
            ->where('checker_employee_uuid', $employee_uuid)
            ->latest()
            ->get();
             return $over_burdens;
        }else if(session('dataUser')->role == 'foreman'){
            $employee_uuid = session('dataUser')->employee_uuid;
            $over_burdens = DB::table('over_burdens')
            ->join('employees as checker', 'checker.uuid', '=', 'over_burdens.checker_employee_uuid')
            ->join('user_details', 'user_details.uuid', '=', 'checker.user_detail_uuid')
            ->where('foreman_employee_uuid', $employee_uuid)
            ->latest()
            ->get([
                'checker.nik_employee',
                'user_details.name',
                'over_burdens.*'
            ]);
            return $over_burdens;
        }else if(session('dataUser')->role == 'engineer'){
            $employee_uuid = session('dataUser')->employee_uuid;
            $over_burdens = DB::table('over_burdens')
            ->join('employees as checker', 'checker.uuid', '=', 'over_burdens.checker_employee_uuid')
            ->join('user_details', 'user_details.uuid', '=', 'checker.user_detail_uuid')
            ->latest()
            ->get([
                'checker.nik_employee',
                'user_details.name',
                'over_burdens.*'
            ]);
            return $over_burdens;
        }
    }

    public function create(){
        $dateToday = Carbon::today('Asia/Jakarta')->isoFormat('D-M-Y');
        $timeNow = Carbon::now('Asia/Jakarta')->isoFormat('h');

        $checkerId = session('dataUser')->employee_uuid;

        $id= null;
        $note = null;
        $foremanId =  null;
        $supervisorId = null;
        $distance = null;
        $material = null;
        $id_note = null;

        $shifts =($timeNow > 16)?'Malam': 'Siang';
        
        // all need this
        $employees = Employee::getAll();
        $vehicles =  Vehicle::getVehicle();

        $pits = DB::table('pits')->get();


        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => false,
            'javascript_datatable'  => false,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'        => 'admin-ob'
        ];


        $data =  [
            'title'         => 'Over Burden',
            'checker_employee_uuid'   => $checkerId,
            'today'     => $dateToday,
            'employees'     => $employees,
            'vehicles'      => $vehicles,
            'pits'          => $pits,
            'layout'        => $layout
        ];
        // dd($dateToday);
        return view('ob.create', $data);
    }

    public function show($over_burden_uuid){
        $overBurden = OverBurden::OverBurdenShow($over_burden_uuid);

        // dd($overBurden);
        
        $date_start = explode("-", $overBurden->date);
        $dateToday = $date_start[2].'-'.$date_start[1].'-'.$date_start[0];

        // $supervisorId = $overBurden->supervisor_employee_uuid;
        // $foremanId = $overBurden->foreman_employee_uuid;
        // $distance = $overBurden->distance;
        // $material = $overBurden->material;
        // $id = $overBurden->id;
        // $note = $overBurden->note;
        // $shifts = $overBurden->shift;
        // $supervisorId  = $overBurden->supervisor_employee_uuid;
        // $checkerId = $overBurden->checker_employee_uuid;
        // $foremanId = $overBurden->foreman_employee_uuid;
        // $id_note = $overBurden->id_note;
       
        // all need this
        $employees = Employee::getAll();
  
        $pits = DB::table('pits')
        ->get();


        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => false,
            'javascript_datatable'  => false,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'        => 'admin-ob'
        ];


        $data =  [
            'title'         => 'Over Burden',
            'today'     => $dateToday,
            'pits'          => $pits,
            'employees'     => $employees,
            'over_burden'  => $overBurden,
            'layout'        => $layout
        ];
        // dd($dateToday);
        return view('ob.show', $data);
    }
    public function showForeman($over_burden_uuid){
        $over_burden_flit_operator_lists =  DB::table('over_burdens')
        ->join('over_burden_operators', 'over_burden_operators.over_burden_uuid', '=', 'over_burdens.uuid')
        ->join('hour_meters', 'hour_meters.over_burden_operator_uuid', '=', 'over_burden_operators.uuid')
        ->where('over_burdens.uuid', $over_burden_uuid)
        ->get([
            'over_burdens.*',
            'hour_meters.*',
            'over_burden_operators.*'
        ]);
        dd($over_burden_flit_operator_lists);
        $overBurden = DB::table('over_burdens')
        ->join('over_burden_notes', 'over_burden_notes.over_burden_uuid', '=', 'over_burdens.uuid')
        ->where('over_burdens.uuid', $over_burden_uuid)
        ->get([
            'over_burdens.*',
            'over_burden_notes.id as id_note',
            'over_burden_notes.note'
        ])
        ->first();

        // dd($overBurden);
        
        $date_start = explode("-", $overBurden->date);
        $dateToday = $date_start[2].'-'.$date_start[1].'-'.$date_start[0];
       
        // all need this
        $employees = Employee::getAll();
  
        $pits = DB::table('pits')
        ->get();


        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => false,
            'javascript_datatable'  => false,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'        => 'admin-ob'
        ];


        $data =  [
            'title'         => 'Over Burden',
            'today'     => $dateToday,
            'pits'          => $pits,
            'employees'     => $employees,
            'over_burden'  => $overBurden,
            'layout'        => $layout
        ];
        // dd($dateToday);
        return view('ob.show', $data);
    }
    
    public function index()
    {   
        $dateToday = Carbon::today('Asia/Jakarta')->isoFormat('D-M-Y');
        
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'        => 'admin-ob'
        ];
        $data =  [
            'title'         => 'Over Burden',
            'layout'       => $layout,
            'today'     => $dateToday
        ];
        return view('ob.index', $data);
    }

    public function indexEngineer()
    {   
        // return 'engineer' ;
        $dateToday = Carbon::today('Asia/Jakarta')->isoFormat('D-M-Y');
        
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'        => 'engineer'
        ];
        $data =  [
            'title'         => 'Over Burden',
            'layout'       => $layout,
            'today'     => $dateToday
        ];
        return view('engineer.ob.index', $data);
    }

    public function indexForeman()
    {   
        $dateToday = Carbon::today('Asia/Jakarta')->isoFormat('D-M-Y');
        
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'        => 'foreman'
        ];
        $data =  [
            'title'         => 'Over Burden',
            'layout'       => $layout,
            'today'     => $dateToday
        ];
        return view('foreman.ob.index', $data);
    }

    public function store(Request $request){
        // dd($request);
        $validatedDataOB = $request->validate([
            'foreman_employee_uuid'      => 'required',
            'checker_employee_uuid'      => 'required',
            'supervisor_employee_uuid'      => 'required',
            'pit_uuid'      => 'required',
            'distance'      => 'required',
            'date'          =>'required',
            'material'      => 'required',
            'shift' => 'required',
        ]);


        $validatedDataNote = $request->validate([
            'id_note'   => '',
            'note'          => ''
        ]);


        $date_start = explode("-", $validatedDataOB['date']);
        $date = $date_start[2].'-'.$date_start[1].'-'.$date_start[0];

        $validatedDataOB['date'] = $date;
        $validatedDataOB['uuid'] = 'over-burden-'.$date.'-'.Str::uuid();

        $storeOB = OverBurden::updateOrCreate(['id'=> $request->id],$validatedDataOB);


        $validatedDataNote['uuid'] = 'over-burden-note-'.Str::uuid();
        $validatedDataNote['over_burden_uuid'] = $storeOB->uuid;
        $storeNote = OverBurdenNote::updateOrCreate(['id'=> $request->id_note],$validatedDataNote);


        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => false,
            'javascript_datatable'  => false,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'        => 'listEmployee'
        ];

        $with = [
            'success' => 'Setup done'
        ];
        return redirect('/admin-ob/'.$storeOB->uuid.'/show')->with($with);
    }

    public function dataOverBurden()
    {
       
        $over_burdens = OverBurdenController::getOverBurden();
       

        return Datatables::of($over_burdens)
        ->addColumn('action', function ($model) {
            $isToday = '';

            $date_now = Carbon::today('Asia/Jakarta')->format('Y-m-d');
            if($date_now == $model->date){
                 $isToday = 'today';
            }
            if(session('dataUser')->role == 'admin-ob'){
                $url = '/admin-ob/' . $model->uuid . '/show';
                $ritase = '';
            }else if(session('dataUser')->role == 'foreman'){
                $url = '/foreman/ritase/'. $model->uuid;
                $ritase = ' <button class="btn btn-primary py-1 px-2 mr-1">
                Ritase
               </button>';
            }else if(session('dataUser')->role == 'engineer'){
                $url = '/engineer/ritase/'. $model->uuid;
                $ritase = ' <button class="btn btn-primary py-1 px-2 mr-1">
                Ritase
               </button>';
            }
            return ' <a class="text-decoration-none" href="'.$url.'">
                <button class="btn btn-secondary py-1 px-2 mr-1">
                    HM
                   </button>'.$ritase.'
            </a>'.$isToday;
        })
        ->make(true);
            
    }

























    public function setup()
    {
        $id_employee = session('dataUser')->employee_id;
        if(Carbon::now('Asia/Jakarta')->format('H') < 6){
            $date_now = Carbon::yesterday('Asia/Jakarta')->isoFormat('D-M-Y');
        }else{
            $date_now = Carbon::today('Asia/Jakarta')->isoFormat('D-M-Y');
        }
       
        $data = array();

        $over_burden = OverBurden::where('checker_employee_id', $id_employee)
        ->where('date', $date_now)
        ->first();
        
        

        $employees = Employee::join('people', 'people.id', '=', 'employees.people_id')
        ->join('positions', 'positions.id', '=', 'employees.position_id')
        ->join('employee_contracts', 'employee_contracts.employee_id', '=', 'employees.id')
        ->get([
            'people.name',
            'employees.id as  employee_id',
            'employees.nik_employee',
            'positions.position',
            'employee_contracts.*'
        ]);
        // return $employees;
        // return "admin-ob";
        $vehicles =  Vehicle::join('vehicle_groups', 'vehicle_groups.id', '=', 'vehicles.vehicle_group_id')
        ->join('unit_groups', 'vehicle_groups.unit_group_id', '=', 'unit_groups.id')
        ->get(['vehicle_groups.vehicle_group','vehicle_groups.vehicle_code', 'vehicles.*', 'unit_groups.unit_group']);
    

        $pits = DB::table('pits')
        ->get();
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'        => 'listEmployee'
        ];

        $data = [
            'title'         => 'Over Burden',
            'pits'          => $pits,
            'employees'     => $employees,
            'vehicles'      => $vehicles,
            'layout'        => $layout
        ];

        //check over_burden setup
        if($over_burden){
            $data['over_burden'] = $over_burden;

            $over_burden_operator  = DB::table('over_burden_operators')
            ->join('employees', 'employees.id', '=', 'over_burden_operators.operator_employee_id' )
            ->join('people', 'people.id', '=', 'employees.people_id' )
            ->join('vehicles', 'vehicles.id', '=', 'over_burden_operators.vehicle_id' )
            ->join('vehicle_groups', 'vehicle_groups.id', '=', 'vehicles.vehicle_group_id' )
            ->where('over_burden_operators.over_burden_id', $over_burden->id)
            ->get([
                'over_burden_operators.id',
                'over_burden_operators.capacity',
                'employees.nik_employee',
                'people.name',
                'vehicles.number',
                'vehicle_groups.vehicle_code',
                'vehicle_groups.vehicle_group'
            ]);
            if($over_burden_operator){
                $data['over_burden_operators'] = $over_burden_operator;
            }
        }else{
            $over_burden = [
                'id' => 0,
                'checker_employee_id' => 0,
                'foreman_employee_id' => 0,
                'supervisor_employee_id' => 0,
                'pit_id' => 0,
                'distance' => '',
                'material' => ''
            ];
            $over_burdens =  (object)    $over_burden;
            $data['over_burden'] = $over_burdens;
            $data['over_burden_operators'] = 0;
        }
        return view('ob.create', $data );
    }

    public function anyData()
    {

        $checkerId = session('dataUser')->employee_id;
        
        $over_burdens = DB::table('over_burdens')
        ->where('checker_employee_id', $checkerId)
        ->latest()
        ->get();

        return Datatables::of($over_burdens)
        ->addColumn('action', function ($model) {
            return ' <a class="text-decoration-none" href="/admin-ob/' . $model->id . '">
                <button class="btn btn-secondary py-1 px-2 mr-1">
                    <i class="icon-copy bi bi-eye-fill"></i>
                   </button>
            </a>';
        })
        ->make(true);
            
    }


    public function dataOverBurdenForeman($checkerId)
    {

        $over_burdens = DB::table('over_burdens')
        ->where('checker_employee_id', $checkerId)
        ->latest()
        ->get();

        return Datatables::of($over_burdens)
        ->addColumn('action', function ($model) {
            return ' <a class="text-decoration-none" href="/foreman/over-burden/' . $model->uuid . '/show">
                <button class="btn btn-secondary py-1 px-2 mr-1">
                    <i class="icon-copy bi bi-eye-fill"></i>
                   </button>
            </a>';
        })
        ->make(true);
            
    }

  

    public function createOb(Request $request)
    {
        
        $validatedData = $request->validate([
            'foreman_employee_id'      => 'required',
            'checker_employee_id'      => 'required',
            'supervisor_employee_id'      => 'required',
            'pit_id'      => 'required',
            'distance'      => 'required',
            'material'      => 'required'
        ]);

        return $validatedData['date'] = Carbon::today('Asia/Jakarta')->isoFormat('D-M-Y');
        $created = OverBurden::create($validatedData);

        // return $created;
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => false,
            'javascript_datatable'  => false,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'        => 'listEmployee'
        ];

        $with = [
            'success' => 'Setup done'
        ];
        return redirect('/ob/setup')->with($with);
    }

 

    public function forForemanOB(Request $request){
        $shift = Shift::where('id', $request->id)->get()->first();
        $checkerId = session('dataUser')->employee_id;
        
        $over_burdens = DB::table('over_burdens')
        ->where('checker_employee_id', $checkerId)
        ->latest()
        ->get();

        $supervisorId = 4;
   
        $dateToday = Carbon::today('Asia/Jakarta')->isoFormat('D-M-Y');
        $date_now = Carbon::today('Asia/Jakarta')->isoFormat('D-M-Y');

        $over_burdens = DB::table('over_burdens')
                                        ->join('employees', 'employees.id', '=', 'over_burdens.checker_employee_id')
                                        ->where('over_burdens.checker_employee_id', $shift->checker_id)
                                        ->where('date', '>=', $shift->shift_date_start)
                                        ->where('date', '<=', $shift->shift_date_end)
                                        ->get(['employees.nik_employee', 'over_burdens.*']);

        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'        => 'admin-ob'
        ];

        $data =  [
            'title'         => 'Over Burden',
            'layout'       => $layout,
            'checker_id'    => $shift->checker_id,
            'over_burden'     => $over_burdens,
            'today'     => $dateToday
        ];
        return view('foreman.ob.index', $data);
    }
}

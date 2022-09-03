<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Shift;
use App\Models\People;
use App\Models\Vehicle;
use App\Models\Employee;
use App\Models\OverBurden;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\OverBurdenOperator;
use Illuminate\Support\Facades\DB;

class OverBurdenController extends Controller
{
    public function create(){
        $dateToday = Carbon::today('Asia/Jakarta')->isoFormat('Y-M-D');
        $timeNow = Carbon::now('Asia/Jakarta')->isoFormat('h');

        $checkerId = session('dataUser')->employee_id;
        $data = array();

        $isSetup = DB::table('over_burdens')
        ->latest()
        ->where('checker_employee_id', $checkerId)
        ->get()
        ->first();


        if($isSetup){
            $supervisorId = $isSetup->supervisor_employee_id;
            $foremanId = $isSetup->foreman_employee_id;
            $distance = $isSetup->distance;
            $material = $isSetup->material;
            $id = $isSetup->id;
            $note = $isSetup->note;
            $shifts = $isSetup->shift;
            $date_start = explode("-", $isSetup->date);
            $dateToday = $date_start[2].'-'.$date_start[1].'-'.$date_start[0];
            $distance = 0;
            $material = '';
            $id= null;
            $note = null;
        }else{
              //disini ada bug checker terakhir dimasukan atau di setu[ tidak peduli tanggal]
            $supervisorId = 4;
            $shift = DB::table('shifts')
            ->where('shifts.checker_id', $checkerId)
            ->latest()
            ->get(['shifts.foreman_id'])
            ->first();
            $distance = 0;
            $material = '';
            $id= null;
            $note = null;
            $date_start = explode("-", $dateToday);
            
            
            $dateToday = $date_start[2].'-'.$date_start[1].'-'.$date_start[0];
            $shifts =($timeNow > 16)?'Malam': 'Siang';
            $foremanId = $shift->foreman_id;
        }

          
        
        // all need this
        $employees = Employee::join('people', 'people.id', '=', 'employees.people_id')
        ->join('positions', 'positions.id', '=', 'employees.position_id')
        ->join('employee_contracts', 'employee_contracts.employee_id', '=', 'employees.id')
        ->get([
            'people.name',
            'employees.id as  employee_id',
            'employees.NIK_employee',
            'positions.position',
            'employee_contracts.*'
        ]);

        $vehicles =  Vehicle::join('vehicle_groups', 'vehicle_groups.id', '=', 'vehicles.vehicle_group_id')
        ->join('unit_groups', 'vehicle_groups.unit_group_id', '=', 'unit_groups.id')
        ->get(['vehicle_groups.vehicle_group','vehicle_groups.vehicle_code', 'vehicles.*', 'unit_groups.unit_group']);
    

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
            'id'            => $id,
            'note'  => $note,
            'checker'   => $checkerId,
            'foreman'   => $foremanId,
            'supervisor'    => $supervisorId,
            'today'     => $dateToday,
            'pits'          => $pits,
            'distance'      =>$distance,
            'material'      => $material,
            'employees'     => $employees,
            'vehicles'      => $vehicles,
            'shifts'    => $shifts,
            'layout'        => $layout
        ];
        // dd($dateToday);
        return view('ob.create', $data);
    }

    public function show($idOB){
 
        $isSetup = DB::table('over_burdens')
        ->where('id', $idOB)
        ->first();
        // dd($isSetup);
        $date_start = explode("-", $isSetup->date);
        $dateToday = $date_start[2].'-'.$date_start[1].'-'.$date_start[0];

        $supervisorId = $isSetup->supervisor_employee_id;
        $foremanId = $isSetup->foreman_employee_id;
        $distance = $isSetup->distance;
        $material = $isSetup->material;
        $id = $isSetup->id;
        $note = $isSetup->note;
        $shifts = $isSetup->shift;
        $supervisorId  = $isSetup->supervisor_employee_id;
        $checkerId = $isSetup->checker_employee_id;
        $foremanId = $isSetup->foreman_employee_id;
       
        // all need this
        $employees = Employee::join('people', 'people.id', '=', 'employees.people_id')
        ->join('positions', 'positions.id', '=', 'employees.position_id')
        ->join('employee_contracts', 'employee_contracts.employee_id', '=', 'employees.id')
        ->get([
            'people.name',
            'employees.id as  employee_id',
            'employees.NIK_employee',
            'positions.position',
            'employee_contracts.*'
        ]);

  
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
            'id'            => $id,
            'note'  => $note,
            'checker'   => $checkerId,
            'foreman'   => $foremanId,
            'supervisor'    => $supervisorId,
            'today'     => $dateToday,
            'pits'          => $pits,
            'distance'      =>$distance,
            'material'      => $material,
            'employees'     => $employees,
            'shifts'    => $shifts,
            'layout'        => $layout
        ];
        // dd($dateToday);
        return view('ob.create', $data);
    }
    

    public function index()
    {
        $checkerId = session('dataUser')->employee_id;
        
        $over_burdens = DB::table('over_burdens')
        ->where('checker_employee_id', $checkerId)
        ->latest()
        ->get();

        $supervisorId = 4;
   
        $dateToday = Carbon::today('Asia/Jakarta')->isoFormat('D-M-Y');
        $date_now = Carbon::today('Asia/Jakarta')->isoFormat('D-M-Y');
        
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
            'over_burden'     => $over_burdens,
            'today'     => $dateToday
        ];
        return view('ob.index', $data);
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
            'employees.NIK_employee',
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
                'employees.NIK_employee',
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

    public function dataOverBurden()
    {
        $checkerId = session('dataUser')->employee_id;
        
        $over_burdens = DB::table('over_burdens')
        ->where('checker_employee_id', $checkerId)
        ->latest()
        ->get();

        return Datatables::of($over_burdens)
        ->addColumn('action', function ($model) {
            return ' <a class="text-decoration-none" href="/admin-ob/' . $model->id . '/show">
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
            return ' <a class="text-decoration-none" href="/foreman/over-burden/' . $model->id . '/show">
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

    public function store(Request $request){
        
        $validatedData = $request->validate([
            'foreman_employee_id'      => 'required',
            'checker_employee_id'      => 'required',
            'supervisor_employee_id'      => 'required',
            'pit_id'      => 'required',
            'distance'      => 'required',
            'date'          =>'required',
            'material'      => 'required',
            'shift' => 'required',
            'note'          => ''
        ]);
        $date_start = explode("-", $validatedData['date']);
        
        $date = $date_start[2].'-'.$date_start[1].'-'.$date_start[0];
        // dd($date);
        $validatedData['date'] = $date;
        $created = OverBurden::updateOrCreate(['id'=> $request->id],$validatedData);
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
        return redirect('/admin-ob/'.$created->id.'/show')->with($with);
        // return $validatedData;

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
                                        ->get(['employees.NIK_employee', 'over_burdens.*']);

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

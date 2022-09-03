<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Vehicle;
use App\Models\Employee;
use App\Models\HourMeter;
use App\Models\OverBurden;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\VehicleTrackController;

class HourMeterController extends Controller
{
    public function index($idOB){
        $id_employee = session('dataUser')->employee_id;
        $date_now = Carbon::today()->isoFormat('Y-M-D');
        $data = array();

        $over_burden = OverBurden::where('checker_employee_id', $id_employee)
        ->join('shifts', 'shifts.checker_id', '=', 'over_burdens.checker_employee_id')
        ->where('date', $date_now)
        ->get(['shifts.shift_time', 'over_burdens.*'])
        ->first();
        if($over_burden->shift_time == "Malam"){
            $time_start = "18:00";
            $time_stop = "5:00";
        }else{
            $time_start = "6:00";
            $time_stop = "17:00";
        }
        $over_burden->time_start = $time_start;
        $over_burden->time_stop = $time_stop;

        $excavators = DB::table('vehicles')
                                                ->join('vehicle_groups', 'vehicle_groups.id', '=', 'vehicles.vehicle_group_id')
                                                ->where('vehicle_groups.vehicle_group', 'Excavator')
                                                ->get(['vehicle_groups.*', 'vehicles.*']);
        // flit
        $flits = DB::table('over_burden_flits')
                            ->join('vehicles', 'vehicles.id', '=','over_burden_flits.excavator_vehicle_id' )
                            ->join('vehicle_groups', 'vehicle_groups.id', '=', 'vehicles.vehicle_group_id')
                            ->where('over_burden_flits.over_burden_id', $idOB)
                            ->get(['vehicle_groups.vehicle_code', 'vehicles.number','over_burden_flits.id']);
        // dd($flits);

     // ga pake
        $over_burden_lists = DB::table('over_burden_lists')
        ->join('over_burden_operators', 'over_burden_operators.id', '=', 'over_burden_lists.over_burden_operator_id' )
        ->join('employees', 'employees.id', '=', 'over_burden_operators.operator_employee_id' )
        ->join('people', 'people.id', '=', 'employees.people_id' )
        ->join('vehicles', 'vehicles.id', '=', 'over_burden_operators.vehicle_id' )
        ->join('vehicle_groups', 'vehicle_groups.id', '=', 'vehicles.vehicle_group_id' )
        ->where('over_burden_operators.over_burden_id', $idOB)
        ->get([
            'over_burden_operators.id',
            'over_burden_operators.capacity',
            'employees.NIK_employee',
            'people.name',
            'vehicles.number',
            'vehicle_groups.vehicle_code',
            'vehicle_groups.vehicle_group',
            'over_burden_lists.over_burden_time'
        ]);
        // dd($over_burden_lists);
        
        // pake
        $over_burden_operator  = DB::table('over_burden_operators')
            ->join('employees', 'employees.id', '=', 'over_burden_operators.operator_employee_id' )
            ->join('over_burdens', 'over_burdens.id', '=', 'over_burden_operators.over_burden_id' )
            ->join('positions', 'positions.id', '=', 'employees.position_id' )
            ->join('people', 'people.id', '=', 'employees.people_id' )
            ->join('hour_meters', 'hour_meters.id', '=', 'over_burden_operators.id' )
            ->join('vehicles', 'vehicles.id', '=', 'over_burden_operators.vehicle_id' )
            ->join('vehicle_groups', 'vehicle_groups.id', '=', 'vehicles.vehicle_group_id' )
            ->join('vehicle_tracks', 'vehicle_tracks.vehicle_id', '=', 'over_burden_operators.vehicle_id')
            ->join('over_burden_flits', 'over_burden_flits.id', '=', 'over_burden_operators.over_burden_flit_id')
            ->where('over_burden_operators.over_burden_id','=', $idOB)
            ->where('vehicle_tracks.last','=', 1 )
            
            ->get([
                'over_burden_operators.id',
                'over_burden_operators.capacity',
                'employees.NIK_employee',
                'people.name',
                'vehicles.number',
                'vehicles.id as vehicle_id',
                'vehicle_groups.vehicle_code',
                'vehicle_groups.vehicle_group',
                'positions.position',
                'hour_meters.*',
                'hour_meters.id as hm_id',
                'vehicle_tracks.hour_meter',
                'over_burden_flits.id as over_burden_flit_id'
            ]);
        
        // dd($over_burden_operator);
        //global needed
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
        $pits = DB::table('pits')->get();

        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => false,
            'javascript_datatable'  => false,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'        => 'listEmployee'
        ];
        $data = [
            'title'         => 'Over Burden',
            'pits'          => $pits,
            'flits'         => $flits,
            'layout'        => $layout,
            'employees'     => $employees,
            'vehicles'      => $vehicles,
            'idOB'          => $idOB,
            'excavators'    => $excavators,
            'over_burden'   => $over_burden,
            'over_burden_operators' => $over_burden_operator,
            'over_burden_lists' => $over_burden_lists
        ];
        return view('ob.hour_meter.index', $data);
    }

    public function indexHR($month){
        $months = ["","Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        // 
        // $monthInt =array_search($month, $months);
        $monthInt = $month;
        $month_name = $months[$month];
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => false,
            'javascript_form'       => false,
            'active'                        => 'admin-hr-absensi'
        ];
        // dd(\Carbon\Carbon::now()->locale('IDN')->isoFormat('M'));
        return view('hr.hour_meter.index', [
            'title'         => 'Beranda HR',
            'month'     => $monthInt,
            'month_name'    => $month_name,
            'layout'        => $layout
        ]);
    }

    public function hourMeterData($months){
        $employees = DB::table('employees')
        ->join('people', 'people.id',  '=', 'employees.people_id')
        ->join('positions', 'positions.id',  '=', 'employees.position_id')->get(['people.name','positions.position','employees.*']);

        foreach($employees as $employee){
            $hour_meter = DB::table('hour_meters')
            ->join('over_burden_operators', 'over_burden_operators.id', '=' ,'hour_meters.operator_employee_id')
            ->where('over_burden_operators.operator_employee_id', $employee->id)
            ->get([
                'hour_meters.*',
                'over_burden_operators.operator_employee_id as operator_id'
            ]);
            $E_hour_meter = 0;
            $hour_meters[]=$hour_meter;
        }
        
        

        dd($hour_meters);die;
       
      

        return Datatables::of($employees)
        ->addColumn('action', function ($model) {
            return '<a class="text-decoration-none" href="/admin-hr/absensi-show/'.$model->month.'/' . $model->NIK_employee . '">
                            <button class="btn btn-secondary py-1 px-2 mr-1">
                                <i class="icon-copy bi bi-eye-fill"></i>
                            </button>
                        </a>';
        })
        
        ->make(true);  
    }

    public function store(Request $request){
        // return $request;
        $validatedData = $request->validate([
            'hm_start'      => 'required',
            'hm_stop'      => '',
            'hm_value'      => '',
            'hm_pay'      => '',
            'time_start'      => 'required',
            'time_stop'      => 'required'
        ]);
        // dd($validatedData);
        if($request->hm_stop != null){
            $updateTrack = app('App\Http\Controllers\VehicleTrackController')->updatessss($request->vehicle_id,$request->hm_stop);
        }
        
        $update = HourMeter::where('id', $request->id)->update($validatedData);
        return redirect('/admin-ob/hour-meter/'.$request->idOB)->with('operator_added', 'Operator added!');
    }
    
    public function listHMforForeman(Request $request){
            $idOB = $request->idOb;
            $over_burden_operator  = DB::table('over_burden_operators')
            ->join('employees', 'employees.id', '=', 'over_burden_operators.operator_employee_id' )
            ->join('positions', 'positions.id', '=', 'employees.position_id' )
            ->join('people', 'people.id', '=', 'employees.people_id' )
            ->join('hour_meters', 'hour_meters.operator_employee_id', '=', 'over_burden_operators.id' )
            ->join('vehicles', 'vehicles.id', '=', 'over_burden_operators.vehicle_id' )
            ->join('vehicle_groups', 'vehicle_groups.id', '=', 'vehicles.vehicle_group_id' )
            ->join('vehicle_tracks', 'vehicle_tracks.vehicle_id', '=', 'over_burden_operators.vehicle_id')
            ->where('vehicle_tracks.last', 1 )
            ->where('over_burden_operators.over_burden_id', $idOB)
            ->get([
                'over_burden_operators.id',
                'over_burden_operators.capacity',
                'employees.NIK_employee',
                'people.name',
                'vehicles.number',
                'vehicles.id as vehicle_id',
                'vehicle_groups.vehicle_code',
                'vehicle_groups.vehicle_group',
                'positions.position',
                'hour_meters.*',
                'vehicle_tracks.hour_meter'
            ]);
            return $over_burden_operator;
    }
}

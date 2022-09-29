<?php

namespace App\Http\Controllers\OverBurden;

use Carbon\Carbon;
use App\Models\OverBurden\HourMeter;
use App\Http\Controllers\Controller;
use App\Models\OverBurden\OverBurden;
use App\Models\Vehicle\Vehicle;
use App\Models\Vehicle\VehicleTrack;
use Illuminate\Http\Request;
use App\Models\OverBurden\OverBurdenFlit;
use App\Models\Employee\Employee;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class HourMeterController extends Controller
{
   
    public function index($idOB){
        $idOB; 
        $overBurden = OverBurden::getOverBurdenUuid($idOB);
        $excavators = Vehicle::getVehicleGroup();
        $employees = Employee::getAll();
        $vehicles =  Vehicle::getVehicle();

        $date_now = Carbon::today()->isoFormat('Y-M-D');

        if($overBurden->shift_time == "Malam"){
            $time_start = "18:00";
            $time_stop = "5:00";
        }else{
            $time_start = "6:00";
            $time_stop = "17:00";
        }
        $overBurden->time_start = $time_start;
        $overBurden->time_stop = $time_stop;
     
         // flit
        $over_burden_flits =OverBurdenFlit::getFlits($overBurden->uuid);
        $over_burden_operator  = HourMeter::getOperator($overBurden->uuid);
        $over_burden_operator_supports  = HourMeter::getOperatorSupport($overBurden->uuid);

        //    dd($over_burden_operator);

        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => false,
            'javascript_datatable'  => false,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'        => 'today-hm'
        ];
        $data = [
            'title'         => 'Over Burden',
            'over_burden_flits'         => $over_burden_flits,
            'layout'        => $layout,
            'employees'     => $employees,
            'vehicles'      => $vehicles,
            'excavators'    => $excavators,
            'over_burden'   => $overBurden,
            'over_burden_operators' => $over_burden_operator,
            'over_burden_operator_supports' => $over_burden_operator_supports,
        ];
        return view('ob.hour_meter.index', $data);
    }
    public function indexForeman($over_burden_uuid){
        $over_burden_flit_operator_lists =  DB::table('over_burdens')
        ->join('over_burden_operators', 'over_burden_operators.over_burden_uuid', '=', 'over_burdens.uuid')
        ->join('hour_meters', 'hour_meters.over_burden_operator_uuid', '=', 'over_burden_operators.uuid')
        ->where('over_burdens.uuid', $over_burden_uuid)
        ->get([
            'over_burdens.*',
            'hour_meters.*',
            'over_burden_operators.*'
        ]);
        // dd($over_burden_flit_operator_lists);


        $overBurden = OverBurden::getOverBurdenUuid($over_burden_uuid);
        $excavators = Vehicle::getVehicleGroup();
        $employees = Employee::getAll();
        $vehicles =  Vehicle::getVehicle();

        $date_now = Carbon::today()->isoFormat('Y-M-D');

       
     
         // flit
        $over_burden_flits =OverBurdenFlit::getFlits($overBurden->uuid);
        $over_burden_operator  = HourMeter::getOperator($overBurden->uuid);
        $over_burden_operator_supports  = HourMeter::getOperatorSupport($overBurden->uuid);

        //    dd($over_burden_operator);

        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => false,
            'javascript_datatable'  => false,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'        => 'hour-meter'
        ];
        $data = [
            'title'         => 'Over Burden',
            'over_burden_flits'         => $over_burden_flits,
            'layout'        => $layout,
            'employees'     => $employees,
            'vehicles'      => $vehicles,
            'excavators'    => $excavators,
            'over_burden'   => $overBurden,
            'over_burden_operators' => $over_burden_operator,
            'over_burden_operator_supports' => $over_burden_operator_supports,
        ];
        // dd($dateToday);
        return view('foreman.ob.hour_meter.index', $data);
    }

    public function store(Request $request){
        // return $request;
        $validatedData = $request->validate([
            'hm_start'      => '',
            'hm_stop'      => '',
            'hm_value'      => '',
            'hm_pay'      => '',
            'time_start'      => '',
            'over_burden_operator_uuid'      => '',
            'uuid'      => '',
            'time_stop'      => ''
        ]);
        if(session('dataUser')->role == 'admin-ob'){
            $validatedData['datetime_checker_approve'] = Carbon::now('Asia/Jakarta');
            $url = '/admin-ob';
        }else if(session('dataUser')->role == 'foreman'){
            $url = '/foreman';
            $validatedData['datetime_foreman_approve'] = Carbon::now('Asia/Jakarta');
        }
        // dd($validatedData);
        $vehicle = VehicleTrack::findUuid($request->vehicle_uuid);
        if(($request->hm_stop == null) && ($request->hm_start != null) && ($request->hm_start != $vehicle->hm)){
            $updateTrack = VehicleTrack::updateTrack($request->vehicle_uuid, $request->hm_start);
        }if(($request->hm_stop != null) && ($request->hm_stop != $vehicle->hm)){
            $updateTrack = VehicleTrack::updateTrack($request->vehicle_uuid, $request->hm_stop);
        }

        // dd($validatedData);
       $update = HourMeter::where('uuid', $request->uuid)->update($validatedData);
        return redirect($url.'/hour-meter/'.$request->over_burden_uuid)->with('operator_added', 'Operator added!');
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
            return '<a class="text-decoration-none" href="/admin-hr/absensi-show/'.$model->month.'/' . $model->nik_employee . '">
                            <button class="btn btn-secondary py-1 px-2 mr-1">
                                <i class="icon-copy bi bi-eye-fill"></i>
                            </button>
                        </a>';
        })
        
        ->make(true);  
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
                'employees.nik_employee',
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

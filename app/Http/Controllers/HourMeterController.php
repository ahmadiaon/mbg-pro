<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Vehicle;
use App\Models\Employee;
use App\Models\HourMeter;
use App\Models\OverBurden;
use App\Models\VehicleTrack;
use Illuminate\Http\Request;
use App\Models\OverBurdenFlit;
use App\Models\OverBurdenList;
use App\Models\EmployeeContract;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\VehicleTrackController;

class HourMeterController extends Controller
{
   
    public function index($idOB){
        $idOB; $overBurden = OverBurden::getOverBurden($idOB);
        $excavators = Vehicle::vehicleGroup('Excavator');
        $employees = EmployeeContract::getEmployee();
        $vehicles =  Vehicle::getAll();
        $pits = DB::table('pits')->get();

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
        $flits =OverBurdenFlit::getFlits($overBurden->uuid);
        $over_burden_lists = OverBurdenList::getList($overBurden->uuid);
        $over_burden_operator  = HourMeter::getOperator($overBurden->uuid);
        $over_burden_operator_supports  = HourMeter::getOperatorSupport($overBurden->uuid);

    //    dd($idOB);

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
            'pits'          => $pits,
            'flits'         => $flits,
            'layout'        => $layout,
            'employees'     => $employees,
            'vehicles'      => $vehicles,
            'idOB'          => $idOB,
            'ob_id'          => $idOB,
            'excavators'    => $excavators,
            'over_burden'   => $overBurden,
            'over_burden_operators' => $over_burden_operator,
            'over_burden_operator_supports' => $over_burden_operator_supports,
            'over_burden_lists' => $over_burden_lists
        ];
        return view('ob.hour_meter.index', $data);
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
            $updateTrack = VehicleTrack::updateHM($request->vehicle_uuid,$request->hm_stop);
        }
        
        $update = HourMeter::where('uuid', $request->uuid)->update($validatedData);
        return redirect('/admin-ob/hour-meter/'.$request->idOB)->with('operator_added', 'Operator added!');
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
            ->where('over_burden_operators.operator_employee_id', $emplyee->id)
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

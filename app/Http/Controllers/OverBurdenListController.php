<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Vehicle;
use App\Models\Employee;
use App\Models\HourMeter;
use App\Models\OverBurden;
use Illuminate\Http\Request;
use App\Models\OverBurdenList;
use Illuminate\Support\Facades\DB;

class OverBurdenListController extends Controller
{
    public function index($idOB){

        $id_employee = session('dataUser')->employee_id;
        $date_now = Carbon::today()->isoFormat('D-M-Y');
        $data = array();

        $over_burden = OverBurden::where('checker_employee_id', $id_employee)
        ->where('date', $date_now)
        ->first();


        $over_burden_lists = DB::table('over_burden_lists')
        ->join('over_burden_operators', 'over_burden_operators.id', '=', 'over_burden_lists.over_burden_operator_id' )
        ->join('employees', 'employees.id', '=', 'over_burden_operators.operator_employee_id' )
        ->join('people', 'people.id', '=', 'employees.people_id' )
        ->join('over_burden_flits', 'over_burden_flits.id', '=', 'over_burden_lists.over_burden_flit_id' )
        ->join('vehicles as v', 'v.id', '=', 'over_burden_operators.vehicle_id' )
        ->join('vehicle_groups as vg', 'vg.id', '=', 'v.vehicle_group_id' )
        ->join('vehicles as ve', 've.id', '=','over_burden_flits.excavator_vehicle_id' )
        ->join('vehicle_groups as vg2', 'vg2.id', '=', 've.vehicle_group_id')
        
        ->where('over_burden_operators.over_burden_id', $idOB)
        ->get([
            'over_burden_operators.id',
            'over_burden_operators.capacity',
            'employees.NIK_employee',
            'people.name',
            'v.number',
            'vg.vehicle_code',
            'vg.vehicle_group',
            've.number as number_excavator',
            'vg2.vehicle_code as vehicle_code_excavator',
            'vg2.vehicle_group as vehicle_group_excavator',
            'over_burden_lists.over_burden_time',
        ]);
        // dd($over_burden_lists);


        $over_burden_operator  = DB::table('over_burden_operators')
            ->join('employees', 'employees.id', '=', 'over_burden_operators.operator_employee_id' )
            ->join('people', 'people.id', '=', 'employees.people_id' )
            ->join('vehicles', 'vehicles.id', '=', 'over_burden_operators.vehicle_id' )
            ->join('vehicle_groups', 'vehicle_groups.id', '=', 'vehicles.vehicle_group_id' )
            ->where('over_burden_operators.over_burden_id', $idOB)
            ->get([
                'over_burden_operators.id',
                'over_burden_operators.capacity',
                'over_burden_operators.over_burden_flit_id',
                'employees.NIK_employee',
                'people.name',
                'vehicles.number',
                'vehicle_groups.vehicle_code',
                'vehicle_groups.vehicle_group'
            ]);
            // dd($over_burden_operator);
        
            $flits = DB::table('over_burden_flits')
            ->join('vehicles', 'vehicles.id', '=','over_burden_flits.excavator_vehicle_id' )
            ->join('vehicle_groups', 'vehicle_groups.id', '=', 'vehicles.vehicle_group_id')
            ->where('over_burden_flits.over_burden_id', $idOB)
            ->get(['vehicle_groups.vehicle_code', 'vehicles.number','over_burden_flits.id']);
            // dd($flits);
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
            'employees'     => $employees,
            'vehicles'      => $vehicles,
            'flits'     => $flits,
            'layout'        => $layout,
            'idOB'          => $idOB,
            'over_burden_operators' => $over_burden_operator,
            'over_burden_lists' => $over_burden_lists
        ];

        return view('ob.list.index', $data);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'over_burden_id'      => 'required',
            'over_burden_flit_id'      => 'required',
            'over_burden_operator_id'      => 'required',
            'over_burden_capacity'      => 'required'
        ]);
        
        $validatedData['over_burden_time'] = Carbon::now('Asia/Jakarta')->format('H:i:s');
        $created = OverBurdenList::create($validatedData);
        
        return redirect('/admin-ob/ritasi/'.$request->over_burden_id)->with('success', 'Ritasi Added!');
    }


    public function addListOBList(Request $request){
        // return $request;
        $validatedData = $request->validate([
            'over_burden_id'      => 'required',
            'over_burden_operator_id'      => 'required',
            'over_burden_capacity'      => 'required'
        ]);
        
        $validatedData['over_burden_time'] = Carbon::now('Asia/Jakarta')->format('H:i:m');
        $created = OverBurdenList::create($validatedData);
        return redirect('/ob/setup')->with('success', 'New Post Inserted!');
    }

    public function listOBforForeman($idOB){
        $ob_operators = DB::table('over_burden_operators')
                                                ->where('over_burden_id', $idOB)
                                                ->get();
        
        $ob_flits = DB::table('over_burden_flits')
                                    ->join('vehicles','vehicles.id','=', 'over_burden_flits.excavator_vehicle_id')
                                    ->join('vehicle_groups','vehicle_groups.id','=', 'vehicles.vehicle_group_id')
                                    ->join('unit_groups','unit_groups.id','=', 'vehicle_groups.unit_group_id')
                                    ->where('over_burden_id', $idOB)
                                    ->get([
                                        'over_burden_flits.*',
                                        'vehicles.number',
                                        'vehicle_groups.vehicle_group',
                                        'unit_groups.capacity'
                                    ]);

        // var_dump($ob_flits);
        // die;

        // dd($ob_operators);
        // sekali kaut exca itu apa bucket atau apa, maksud di kertas ob dt 3 bucket itu apa,
        foreach($ob_operators as $ob_operator){
            foreach($ob_flits as $ob_flit){
                $over_burden_list_flit = DB::table('over_burden_lists')
                ->where('over_burden_id', $idOB)
                ->where('over_burden_operator_id', $ob_operator->id)
                ->where('over_burden_flit_id', $ob_flit->id)
                ->get();
            }

            $over_burden_list = DB::table('over_burden_lists')
                                                    ->where('over_burden_id', $idOB)
                                                    ->where('over_burden_operator_id', $ob_operator->id)
                                                    ->get();

            
            $over_burden_lists[]=$over_burden_list;
        
        }
        var_dump($over_burden_lists);
        die;
        dd($over_burden_lists);

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
        dd($over_burden_lists);
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'        => 'foreman'
        ];

        $data = [
            'title'         => 'Over Burden',
            'layout'        => $layout,
            'over_burden_lists' => $over_burden_lists
        ];

        return view('foreman.ob.index', $data);
      
    }
    
}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Vehicle;
use App\Models\Employee;
use App\Models\HourMeter;
use App\Models\OverBurden;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\OverBurdenFlit;
use App\Models\OverBurdenList;
use App\Models\EmployeeContract;
use Illuminate\Support\Facades\DB;

class OverBurdenListController extends Controller
{
    public function index($idOB){
        $overBurden = OverBurden::getOverBurden($idOB);
        $date_now = Carbon::today()->isoFormat('D-M-Y');
        $overBurden_uuid = $overBurden->uuid;        
        $over_burden_lists = OverBurdenList::getListFlit($overBurden_uuid);
        $over_burden_operator  = HourMeter::getOperator($overBurden->uuid);
        $flits =OverBurdenFlit::getFlits($overBurden->uuid);
        $employees = EmployeeContract::getEmployee();
        $vehicles =  Vehicle::getAll();
        

        
        $layout = [
            'head_core'            => true,
            'javascript_core'       => true,
            'head_datatable'        => true,
            'javascript_datatable'  => true,
            'head_form'             => true,
            'javascript_form'       => true,
            'active'        => 'today-ob'
        ];

        $data = [
            'title'         => 'Over Burden',
            'employees'     => $employees,
            'vehicles'      => $vehicles,
            'flits'     => $flits,
            'layout'        => $layout,
            'idOB'          => $idOB,
            'ob_id'          => $idOB,
            'over_burden'          => $overBurden,
            'over_burden_operators' => $over_burden_operator,
            'over_burden_lists' => $over_burden_lists
        ];

        return view('ob.list.index', $data);
    }

    public function store(Request $request){
        // return $request;
        $validatedData = $request->validate([
            'over_burden_uuid'      => 'required',
            'over_burden_flit_uuid'      => 'required',
            'over_burden_operator_uuid'      => 'required',
            'over_burden_capacity'      => 'required'
        ]);
        
        $validatedData['over_burden_time'] = Carbon::now('Asia/Jakarta')->format('H:i:s');
        $validatedData['uuid'] = Str::uuid();
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

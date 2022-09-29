<?php

namespace App\Http\Controllers\OverBurden;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OverBurden\HourMeter;
use App\Models\OverBurden\OverBurden;
use Illuminate\Support\Str;
use App\Models\OverBurden\OverBurdenFlit;
use App\Models\OverBurden\OverBurdenOperator;
use App\Models\Vehicle\VehicleTrack;

class OverBurdenFlitController extends Controller
{
    public function store(Request $request){
        // return $request;
        $validatedData = $request->validate([
            'over_burden_uuid'      => 'required',
            'operator_employee_uuid'      => 'required',
            'excavator_vehicle_uuid'      => 'required',
            'ex_capacity'      => 'required'
        ]);
        $validatedData['capacity'] = $request->ex_capacity;
        $validatedData['uuid'] = 'flits-'.Str::uuid();
        $created = OverBurdenFlit::create($validatedData);
        $overBurden = OverBurden::where('uuid', $request->over_burden_uuid)->get()->first();
        

        $validatedData = [
            'over_burden_uuid'      => $request->over_burden_uuid,
            'operator_employee_uuid'      => $request->operator_employee_uuid,
            'over_burden_flit_uuid'      => $created->uuid,
            'capacity'      =>  $request->ex_capacity,
            'group'      => 'Excavator',
            'vehicle_uuid'      => $request->excavator_vehicle_uuid
        ];
        
        $validatedData['uuid'] = 'operator-Exca-'.Str::uuid();

        $created = OverBurdenOperator::create($validatedData);

        if($overBurden->shift_time == "Malam"){
            $time_start = "18:00";
            $time_stop = "5:00";
        }else{
            $time_start = "6:00";
            $time_stop = "17:00";
        }
        $hour_meter = [
            'uuid'  => 'hour-meter-'.Str::uuid(),
            'over_burden_uuid' =>  $validatedData['over_burden_uuid'],
            'over_burden_operator_uuid' =>  $created->uuid,
            'time_start'    => $time_start,
            'time_stop'      => $time_stop,
            'hm_start'    => $request->hm_start
        ];
        $updateTrack = VehicleTrack::updateTrack($request->excavator_vehicle_uuid, $request->hm_start);

        $created = HourMeter::create($hour_meter);





        return redirect('/admin-ob/hour-meter/'.$request->over_burden_uuid)->with('success', 'Flit Added!');
    }
}

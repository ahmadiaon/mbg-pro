<?php

namespace App\Http\Controllers\OverBurden;


use App\Models\OverBurden\OverBurden;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\OverBurden\OverBurdenOperator;
use App\Http\Controllers\Controller;
use App\Models\OverBurden\HourMeter;
use App\Models\Vehicle\VehicleTrack;

class OverBurdenOperatorController extends Controller
{
    public function store(Request $request){
        // return $request;
        $validatedData = $request->validate([
            'over_burden_uuid'      => 'required',
            'operator_employee_uuid'      => 'required',
            'over_burden_flit_uuid'      => 'required',
            'capacity'      => 'required',
            'group'      => 'required',
            'vehicle_uuid'      => 'required'
        ]);
        
        $validatedData['uuid'] = 'operator-OB-'.Str::uuid();

        $created = OverBurdenOperator::create($validatedData);

        if($request->shift_time == "Malam"){
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
        $updateTrack = VehicleTrack::updateTrack($request->vehicle_uuid, $request->hm_start);

        $created = HourMeter::create($hour_meter);
        return redirect('/admin-ob/hour-meter/'.$request->over_burden_uuid)->with('success', 'Flit Added!');

    }
    public function addOperatorOB(Request $request){
        $validatedData = $request->validate([
            'over_burden_id'      => 'required',
            'operator_employee_id'      => 'required',
            'capacity'      => 'required',
            'vehicle_id'      => 'required'
        ]);

        $stored = OverBurdenOperator::create($validatedData);

        return redirect('/ob/setup')->with('operator_added', 'Operator added!');

    }
    
}

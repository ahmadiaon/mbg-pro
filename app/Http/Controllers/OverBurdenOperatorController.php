<?php

namespace App\Http\Controllers;

use App\Models\HourMeter;
use App\Models\OverBurden;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\OverBurdenOperator;

class OverBurdenOperatorController extends Controller
{
    public function store(Request $request){
        // return $request;
        $validatedData = $request->validate([
            'over_burden_uuid'      => 'required',
            'operator_employee_uuid'      => 'required',
            'over_burden_flit_uuid'      => 'required',
            'capacity'      => 'required',
            'vehicle_uuid'      => 'required'
        ]);
        // dd($validatedData);
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
            'operator_employee_uuid' =>  $created->uuid,
            'time_start'    => $time_start,
            'time_stop'      => $time_stop,
        ];
        // dd($hour_meter);
        $created = HourMeter::create($hour_meter);
        // dd($created);

        return redirect('/admin-ob/hour-meter/'.$request->ob_uuid)->with('operator_added', 'Operator added!');

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

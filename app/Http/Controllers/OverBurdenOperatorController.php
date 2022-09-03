<?php

namespace App\Http\Controllers;

use App\Models\HourMeter;
use App\Models\OverBurden;
use Illuminate\Http\Request;
use App\Models\OverBurdenOperator;

class OverBurdenOperatorController extends Controller
{
    public function store(Request $request){
        // return $request;
        $validatedData = $request->validate([
            'over_burden_id'      => 'required',
            'operator_employee_id'      => 'required',
            'over_burden_flit_id'      => 'required',
            'capacity'      => 'required',
            'vehicle_id'      => 'required'
        ]);
        // dd($validatedData);
        $created = OverBurdenOperator::create($validatedData);
        
        $over_burden = OverBurden::where('over_burdens.id', $request->over_burden_id)
        ->join('shifts', 'shifts.checker_id', '=', 'over_burdens.checker_employee_id')
        ->get(['shifts.shift_time', 'over_burdens.*'])
        ->first();
        if($over_burden->shift_time == "Malam"){
            $time_start = "18:00";
            $time_stop = "5:00";
        }else{
            $time_start = "6:00";
            $time_stop = "17:00";
        }
        $hour_meter = [
            'id' => $created->id,
            'over_burden_id' =>  $validatedData['over_burden_id'],
            'operator_employee_id' =>  $created->id,
            'time_start'    => $time_start,
            'time_stop'      => $time_stop,
        ];
        // dd($hour_meter);
        $created = HourMeter::create($hour_meter);

        return redirect('/admin-ob/hour-meter/'.$request->over_burden_id)->with('operator_added', 'Operator added!');

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
